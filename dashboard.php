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

// Commit 6 – Dashboard Penjualan (Logika Penjualan Random)
shuffle($produk); // urutan barang diacak

// 🔽 Tambahan baru sesuai instruksi
$beli = [];       // menyimpan nama barang yang dibeli
$jumlah = [];     // menyimpan jumlah pembelian
$total = [];      // menyimpan total per barang
$grandtotal = 0;  // total keseluruhan pembelian

// Commit 7 – Dashboard Penjualan (Perhitungan Total)
$pembelian = []; // array untuk menampung hasil pembelian
$grandtotal = 0;

foreach ($produk as $item) {
    $jumlah = rand(1, 5); // jumlah acak per item
    $total = $item['harga'] * $jumlah;
    $grandtotal += $total; // akumulasi total semua item

    // simpan detail pembelian ke array
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
    h3 {
        color: #333;
        font-weight: normal;
        margin-top: 0;
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
        padding-right: 15px;
    }
    .btn-cetak {
        display: inline-block;
        background-color: #28a745;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        margin-top: 15px;
        float: right;
    }
    .btn-cetak:hover {
        background-color: #218838;
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