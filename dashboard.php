<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// ===========================
//  Commit 5 – Data Barang
//  (Array Multidimensi)
// ===========================
$produk = [
    ["kode" => "B001", "nama" => "Mie Lidi Pedas", "harga" => 7000],
    ["kode" => "B002", "nama" => "Keripik Balado", "harga" => 8000],
    ["kode" => "B003", "nama" => "Es Kopi Susu", "harga" => 12000],
    ["kode" => "B004", "nama" => "Jus Mangga", "harga" => 10000],
    ["kode" => "B005", "nama" => "Roti Coklat", "harga" => 6000]
];

// Commit 6 – Acak urutan barang
shuffle($produk);

// ===========================
// Commit 7 – Perhitungan Total
// ===========================
$pembelian = [];
$grandtotal = 0;

foreach ($produk as $item) {
    $jumlah = rand(1, 5);
    $total = $item['harga'] * $jumlah;
    $grandtotal += $total;

    $pembelian[] = [
        'kode' => $item['kode'],
        'nama' => $item['nama'],
        'harga' => $item['harga'],
        'jumlah' => $jumlah,
        'total' => $total
    ];
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penjualan - POLGAN MART</title>
    <style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: linear-gradient(to right, #f0f4ff, #ffffff);
        margin: 0;
        padding: 20px;
    }
    .container {
        background: #fff;
        max-width: 850px;
        margin: auto;
        border-radius: 12px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.15);
        padding: 25px 30px;
    }
    h2 {
        color: #007bff;
        margin-bottom: 5px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    th {
        background-color: #007bff;
        color: white;
        padding: 10px;
    }
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    .total {
        font-weight: bold;
        text-align: right;
        background-color: #f8f9fa;
    }
    </style>
</head>
<body>
<div class="container">
    <h2>-- POLGAN MART --</h2>
    <h3>Sistem Penjualan Sederhana</h3>

    <p>Selamat datang, <b><?= $_SESSION['username']; ?></b> |
    <a href="logout.php">Logout</a></p>

    <hr>
    <h3>Daftar Pembelian</h3>
    <table>
        <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>

        <?php foreach ($pembelian as $item): ?>
        <tr>
            <td><?= $item['kode']; ?></td>
            <td><?= $item['nama']; ?></td>
            <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
            <td><?= $item['jumlah']; ?></td>
            <td>Rp <?= number_format($item['total'], 0, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="4" class="total">Total Belanja</td>
            <td><b>Rp <?= number_format($grandtotal, 0, ',', '.'); ?></b></td>
        </tr>
    </table>
</div>
</body>
</html>