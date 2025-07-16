<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(array $rekapData)
    {
        $this->data = $rekapData;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Tipe',
            'Tanggal',
            'Nama Produk',
            'Jumlah',
            'Harga Satuan',
            'Total',
            'Keterangan'
        ];
    }
}
