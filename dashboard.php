<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// ===========================
//  Data Barang (Manual)
// ===========================
$produk = [
    ["kode" => "K001", "nama" => "Teh Pucuk", "harga" => 3000]
];

// Data pembelian (contoh seperti gambar)
$pembelian = [
    [
        "kode"   => "K001",
        "nama"   => "Teh Pucuk",
        "harga"  => 3000,
        "jumlah" => 1,
        "total"  => 3000
    ]
];

$totalBelanja = 3000;
$diskon = $totalBelanja * 0.05;
$totalBayar = $totalBelanja - $diskon;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard - POLGAN MART</title>

<!-- GOOGLE FONT + TAILWIND -->
<script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100">

<!-- HEADER -->
<div class="flex justify-between px-10 py-6">
    <div class="flex gap-3 items-center">
        <div class="bg-blue-600 text-white p-4 rounded-xl font-bold">PM</div>
        <div>
            <h1 class="font-bold text-xl">--POLGAN MART--</h1>
            <p class="text-sm text-gray-500 -mt-1">Sistem Penjualan Sederhana</p>
        </div>
    </div>

    <div class="text-right">
        <p>Selamat datang, <b>admin!</b></p>
        <p class="text-sm text-gray-500 -mt-1">Role: Dosen</p>
        <a href="logout.php" class="bg-gray-200 px-4 py-1 rounded-lg text-sm">Logout</a>
    </div>
</div>

<!-- FORM INPUT -->
<div class="w-10/12 bg-white mx-auto p-8 rounded-xl shadow">

    <div class="grid grid-cols-1 gap-2">
        <label class="font-semibold">Kode Barang</label>
        <input type="text" class="border rounded-lg p-2" placeholder="Masukkan Kode Barang">

        <label class="font-semibold mt-3">Nama Barang</label>
        <input type="text" class="border rounded-lg p-2" placeholder="Masukkan Nama Barang">

        <label class="font-semibold mt-3">Harga</label>
        <input type="text" class="border rounded-lg p-2" placeholder="Masukkan Harga">

        <label class="font-semibold mt-3">Jumlah</label>
        <input type="number" class="border rounded-lg p-2" placeholder="Masukkan Jumlah">

        <div class="mt-4 flex gap-3">
            <button class="bg-blue-600 text-white px-5 py-2 rounded-lg">Tambahkan</button>
            <button class="bg-gray-300 px-5 py-2 rounded-lg">Batal</button>
        </div>
    </div>

    <!-- TABEL -->
    <h2 class="text-center font-semibold mt-10 text-lg">Daftar Pembelian</h2>

    <table class="w-full mt-4 text-center border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">Kode</th>
                <th class="p-2 border">Nama Barang</th>
                <th class="p-2 border">Harga</th>
                <th class="p-2 border">Jumlah</th>
                <th class="p-2 border">Total</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="border p-2"><?= $pembelian[0]['kode'] ?></td>
                <td class="border p-2"><?= $pembelian[0]['nama'] ?></td>
                <td class="border p-2">Rp <?= number_format($pembelian[0]['harga'], 0, ',', '.') ?></td>
                <td class="border p-2"><?= $pembelian[0]['jumlah'] ?></td>
                <td class="border p-2">Rp <?= number_format($pembelian[0]['total'], 0, ',', '.') ?></td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="4" class="text-right font-bold p-2">Total Belanja</td>
                <td class="p-2 font-semibold">Rp <?= number_format($totalBelanja, 0, ',', '.') ?></td>
            </tr>

            <tr>
                <td colspan="4" class="text-right font-bold p-2">Diskon</td>
                <td class="p-2 text-red-600 font-semibold">
                    Rp <?= number_format($diskon, 0, ',', '.') ?> (5%)
                </td>
            </tr>

            <tr>
                <td colspan="4" class="text-right font-bold p-2">Total Bayar</td>
                <td class="p-2 font-bold text-green-700">
                    Rp <?= number_format($totalBayar, 0, ',', '.') ?>
                </td>
            </tr>
        </tfoot>
    </table>

    <button class="mt-5 bg-red-500 text-white px-5 py-2 rounded-lg">
        Kosongkan Keranjang
    </button>

</div>

</body>
</html>