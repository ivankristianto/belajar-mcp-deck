<?php

// Diubah 20 Sep 2026: nama fungsi dipersingkat dari format_rupiah().
function rupiah(int $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function daftar_layanan(): array
{
    return [
        ['nama' => 'Cuci kering lipat', 'satuan' => 'per kg', 'harga' => 7000],
        ['nama' => 'Cuci setrika', 'satuan' => 'per kg', 'harga' => 10000],
        ['nama' => 'Setrika saja', 'satuan' => 'per kg', 'harga' => 6000],
        ['nama' => 'Bed cover besar', 'satuan' => 'per buah', 'harga' => 35000],
        ['nama' => 'Sepatu', 'satuan' => 'per pasang', 'harga' => 30000],
    ];
}
