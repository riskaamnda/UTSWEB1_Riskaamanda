<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Commit 5 – Data Barang (versi baru)
$kode_barang = ["B001", "B002", "B003", "B004", "B005"];
$nama_barang = ["Mie Lidi Pedas", "Keripik Balado", "Es Kopi Susu", "Jus Mangga", "Roti Coklat"];
$harga_barang = [7000, 8000, 12000, 10000, 6000];

// Gabungkan data barang jadi satu array
$produk = [];
for ($i = 0; $i < count($kode_barang); $i++) {
    $produk[] = [
        'kode' => $kode_barang[$i],
        'nama' => $nama_barang[$i],
        'harga' => $harga_barang[$i]
    ];
}

// Commit 6 – Acak barang dan jumlah
shuffle($produk); // urutan barang diacak
$grandtotal = 0;
$pembelian = [];

// Buat pembelian acak
for ($i = 0; $i < count($produk); $i++) {
    $jumlah = rand(1, 5); // jumlah random 1–5
    $total = $produk[$i]['harga'] * $jumlah;
    $grandtotal += $total;

    $pembelian[] = [
        'kode' => $produk[$i]['kode'],
        'nama' => $produk[$i]['nama'],
        'harga' => $produk[$i]['harga'],
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
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            max-width: 800px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        h2, h3 {
            text-align: center;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #eaeaea;
        }
        .total {
            font-weight: bold;
            text-align: right;
            padding-right: 15px;
        }
        .logout {
            text-align: right;
            margin-bottom: 10px;
        }
        .logout a {
            text-decoration: none;
            background-color: #dc3545;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
        }
        .logout a:hover {
            background-color: #c82333;
        }
        hr {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>-- POLGAN MART --</h2>
    <h3>Sistem Penjualan Sederhana</h3>

    <div class="logout">
        <p>Selamat datang, <b><?= $_SESSION['username']; ?></b></p>
        <a href="logout.php">Logout</a>
    </div>

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