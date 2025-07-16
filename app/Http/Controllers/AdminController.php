<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// rekap penjualan
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapExport;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin.
     */
    public function dashboard()
    {
        $role = strtolower(session('role'));

        if ($role !== 'admin') {
            return view('admin.blocked');
        }

        $token = session('token');

        try {
            // Ambil semua data dari endpoint Django
            $userResponse       = Http::withToken($token)->get(env('API_BASE_URL') . '/user/');
            $produkResponse     = Http::withToken($token)->get(env('API_BASE_URL') . '/produk/');
            $promoResponse      = Http::withToken($token)->get(env('API_BASE_URL') . '/promo/');
            $transaksiKasirResp = Http::withToken($token)->get(env('API_BASE_URL') . '/transaksi-h/');
            $transaksiShopResp  = Http::withToken($token)->get(env('API_BASE_URL') . '/shop-transaksi/');
            $stokMasukResponse  = Http::withToken($token)->get(env('API_BASE_URL') . '/stok-masuk/');

            // Cek dan parse responsenya
            $user       = $userResponse->successful() ? $userResponse->json() : [];
            $produk     = $produkResponse->successful() ? $produkResponse->json() : [];
            $promo      = $promoResponse->successful() ? $promoResponse->json() : [];
            $transaksi  = $transaksiKasirResp->successful() ? $transaksiKasirResp->json() : [];
            $shop       = $transaksiShopResp->successful() ? $transaksiShopResp->json() : [];
            $stokMasuk  = $stokMasukResponse->successful() ? $stokMasukResponse->json() : [];

            return view('admin.dashboard', compact(
                'user', 'produk', 'promo', 'transaksi', 'shop', 'stokMasuk'
            ));
        } catch (\Exception $e) {
            return view('error', [
                'message' => 'Gagal mengambil data dari API Django: ' . $e->getMessage()
            ]);
        }
    }


    /**
     * Tampilkan form register akun baru.
     */
    public function registerAkunForm()
    {
        return view('admin.register_akun');
    }

    /**
     * Proses pendaftaran akun baru ke Django API.
     */
    public function registerAkun(Request $request)
    {
        $token = session('token');

        $data = [
            'username' => $request->input('nama'),
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'role'     => $request->input('role'),
        ];

        $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/account/register/', $data);

        if ($response->successful()) {
            return redirect()->route('admin.register.form')->with('success', 'Akun berhasil didaftarkan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mendaftar akun.');
        }
    }

    /**
     * Tampilkan halaman daftar produk.
     */
    public function kelolaProduk()
    {
        $token = session('token');

        $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/produk/');

        $produk = $response->successful() ? $response->json() : [];

        return view('admin.kelola_produk', compact('produk'));
    }


    /**
     * Tampilkan form tambah produk.
     */


    public function tambahProdukForm()
    {
        // Ambil data kategori dan promo dari API Django
        $token = session('token'); // pastikan token JWT disimpan di session saat login
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $kategori = Http::withHeaders($headers)->get('http://127.0.0.1:8000/api/kategori/')->json();
        $promo = Http::withHeaders($headers)->get('http://127.0.0.1:8000/api/promo/')->json();

        return view('admin.tambah_produk', [
            'kategoriList' => $kategori,
            'promoList' => $promo,
        ]);
    }


        /**
         * Simpan produk baru.
         */

    public function simpanProduk(Request $request)
    {
        $token = session('token');

            $data = [
        ['name' => 'nama', 'contents' => $request->input('nama')],
        ['name' => 'deskripsi', 'contents' => $request->input('deskripsi')],
        ['name' => 'harga', 'contents' => $request->input('harga')],
        ['name' => 'stok', 'contents' => $request->input('stok')], 
        ['name' => 'kategori_id', 'contents' => $request->input('kategori')],
    ];

    // Tambahkan promo jika ada
    if ($request->filled('promo')) {
        $data[] = ['name' => 'promo_id', 'contents' => (int) $request->input('promo')];
    }

    // Tambah gambar jika diupload
    if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
        $gambar = $request->file('gambar');
        $data[] = [
            'name'     => 'gambar',
            'contents' => fopen($gambar->getRealPath(), 'r'),
            'filename' => $gambar->getClientOriginalName(),
        ];
    }


        $response = Http::withToken($token)
            ->asMultipart()
            ->post('http://127.0.0.1:8000/api/produk/', $data);

        if ($response->successful()) {
            return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan!');
        } else {
                // Debug detail error dari Django
            dd([
                'status' => $response->status(),
                'json'   => $response->json(),
                'raw'    => $response->body(),
            ]);
        }
    }



    /**
     * Update data produk.
     */
    public function updateProduk(Request $request, $id)
    {
        $token = session('token');

        $data = [
            'nama'      => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga'     => $request->input('harga'),
            'kategori'  => $request->input('kategori'),
            'promo'     => $request->input('promo') ?? null,
        ];

        $response = Http::withToken($token)->put("http://127.0.0.1:8000/api/produk/{$id}/", $data);

        if ($response->successful()) {
            return redirect()->route('admin.produk')->with('success', 'Produk berhasil diupdate!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal update produk.');
        }
    }

    /**
     * Hapus produk.
     */
    public function hapusProduk($id)
    {
        $token = session('token');

        $response = Http::withToken($token)->delete("http://127.0.0.1:8000/api/produk/{$id}/");

        if ($response->successful()) {
            return redirect()->route('admin.produk')->with('success', 'Produk berhasil dihapus!');
        } else {
            return redirect()->route('admin.produk')->with('error', 'Gagal menghapus produk.');
        }
    }

    public function formEditProduk($id)
    {
        $token = session('token');

        // Ambil data produk dari Django
        $produkResponse = Http::withToken($token)->get("http://127.0.0.1:8000/api/produk/{$id}/");
        $kategoriResponse = Http::withToken($token)->get("http://127.0.0.1:8000/api/kategori/");
        $promoResponse = Http::withToken($token)->get("http://127.0.0.1:8000/api/promo/");

        if (!$produkResponse->successful() || !$kategoriResponse->successful()) {
            return redirect()->back()->with('error', 'Gagal mengambil data produk/kategori dari server.');
        }

        $produk = $produkResponse->json();
        $kategoriList = $kategoriResponse->json();
        $promoList = $promoResponse->successful() ? $promoResponse->json() : [];

        return view('admin.edit_produk', [
            'produk' => $produk,
            'kategoriList' => $kategoriList,
            'promoList' => $promoList,
        ]);
    }


    public function verifikasiPembayaran()
    {
        $token = session('token');

        $response = Http::withToken($token)->get('http://127.0.0.1:8000/api/shop-transaksi/');

        $transaksi = $response->successful() ? $response->json() : [];

        $pending = array_filter($transaksi, fn($t) => $t['status_pembayaran'] === 'pending');
        $terverifikasi = array_filter($transaksi, fn($t) => $t['status_pembayaran'] === 'terverifikasi');

        return view('admin.verifikasi_pembayaran', [
            'pending' => $pending,
            'terverifikasi' => $terverifikasi,
        ]);
    }

        public function verifikasiPembayaranProses($id)
    {
        $token = session('token');

        $response = Http::withToken($token)
            ->patch("http://127.0.0.1:8000/api/shop-transaksi/{$id}/", [
                'status_pembayaran' => 'terverifikasi',
            ]);

        if ($response->successful()) {
            return redirect()->route('admin.verifikasi_pembayaran')->with('success', 'Pembayaran berhasil diverifikasi.');
        } else {
            return redirect()->back()->with('error', 'Gagal memverifikasi pembayaran.');
        }
    }



    public function rekapPenjualan()
    {
        $token = session('token');

        $shop = Http::withToken($token)->get('http://127.0.0.1:8000/api/shop-transaksi/')->json();
        $kasir = Http::withToken($token)->get('http://127.0.0.1:8000/api/transaksi-h/')->json();
        $stok = Http::withToken($token)->get('http://127.0.0.1:8000/api/stok-masuk/')->json();

        $data = [];

        foreach ($shop as $item) {
            if ($item['status_pembayaran'] === 'terverifikasi') {
                $data[] = [
                    'tanggal' => $item['tanggal'],
                    'tipe' => 'Pemasukan (Shop)',
                    'produk' => $item['produk'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['total_harga'] / $item['jumlah'],
                    'total' => $item['total_harga'],
                    'sumber' => $item['metode_pembayaran']
                ];
            }
        }

        foreach ($kasir as $item) {
            foreach ($item['detail'] ?? [] as $d) {
                $data[] = [
                    'tanggal' => $item['tanggal'],
                    'tipe' => 'Pemasukan (Kasir)',
                    'produk' => $d['produk'],
                    'jumlah' => $d['jumlah'],
                    'harga' => $d['total'] / $d['jumlah'],
                    'total' => $d['total'],
                    'sumber' => 'Kasir'
                ];
            }
        }

        foreach ($stok as $item) {
            $data[] = [
                'tanggal' => $item['tanggal_masuk'],
                'tipe' => 'Pengeluaran (Stok Masuk)',
                'produk' => $item['nama_produk'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga_satuan'],
                'total' => $item['subtotal'],
                'sumber' => $item['nama_suplayer']
            ];
        }

        // Urutkan berdasarkan tanggal
        usort($data, fn($a, $b) => strtotime($a['tanggal']) <=> strtotime($b['tanggal']));

        return view('admin.rekap_penjualan', ['rekap' => $data]);
    }

    public function exportRekapPDF()
    {
        $data = $this->getRekapData(); // data gabungan dari shop + kasir + stok
        $token = session('token');

        // ambil data mentah untuk ditampilkan di bagian "Kasir" & "Stok Masuk"
        $kasir = Http::withToken($token)->get('http://127.0.0.1:8000/api/transaksi-h/')->json();
        $stok = Http::withToken($token)->get('http://127.0.0.1:8000/api/stok-masuk/')->json();

        $pdf = Pdf::loadView('admin.rekap_pdf', [
            'rekap' => $data,
            'transaksi' => $kasir,
            'stokMasuk' => $stok,
        ]);

        return $pdf->download('rekap-penjualan.pdf');
    }




    public function exportRekapExcel()
    {
        $data = $this->getRekapData();
        return Excel::download(new RekapExport($data), 'rekap-penjualan.xlsx');
    }

    private function getRekapData()
    {
        $token = session('token');

        $shop = Http::withToken($token)->get('http://127.0.0.1:8000/api/shop-transaksi/')->json();
        $kasir = Http::withToken($token)->get('http://127.0.0.1:8000/api/transaksi-h/')->json();
        $stok = Http::withToken($token)->get('http://127.0.0.1:8000/api/stok-masuk/')->json();

        $data = [];

        foreach ($shop as $item) {
            if ($item['status_pembayaran'] === 'terverifikasi') {
                $data[] = [
                    'tanggal' => $item['tanggal'],
                    'tipe' => 'Pemasukan (Shop)',
                    'produk' => $item['produk'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['total_harga'] / $item['jumlah'],
                    'total' => $item['total_harga'],
                    'sumber' => $item['metode_pembayaran']
                ];
            }
        }

        foreach ($kasir as $item) {
            foreach ($item['detail'] ?? [] as $d) {
                $data[] = [
                    'tanggal' => $item['tanggal'],
                    'tipe' => 'Pemasukan (Kasir)',
                    'produk' => $d['produk'],
                    'jumlah' => $d['jumlah'],
                    'harga' => $d['total'] / $d['jumlah'],
                    'total' => $d['total'],
                    'sumber' => 'Kasir'
                ];
            }
        }

        foreach ($stok as $item) {
            $data[] = [
                'tanggal' => $item['tanggal_masuk'],
                'tipe' => 'Pengeluaran (Stok Masuk)',
                'produk' => $item['nama_produk'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga_satuan'],
                'total' => $item['subtotal'],
                'sumber' => $item['nama_suplayer']
            ];
        }

        usort($data, fn($a, $b) => strtotime($a['tanggal']) <=> strtotime($b['tanggal']));

        return $data;
    }


}
