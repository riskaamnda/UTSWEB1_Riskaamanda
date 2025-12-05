<?php
// ====== ARRAY DATA BARANG ======
$barangList = [
    ["kode" => "BRG001", "nama" => "Sabun Mandi", "harga" => 15000],
    ["kode" => "BRG002", "nama" => "Sikat Gigi", "harga" => 8000],
    ["kode" => "BRG003", "nama" => "Pasta Gigi", "harga" => 12000],
    ["kode" => "BRG004", "nama" => "Shampoo", "harga" => 20000],
    ["kode" => "BRG005", "nama" => "Handuk", "harga" => 30000],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $kode   = $_POST['kode']   ?? '';
    $nama   = $_POST['nama']   ?? '';
    $harga  = (int)($_POST['harga']   ?? 0);
    $jumlah = (int)($_POST['jumlah']  ?? 0);

    // hitung total
    $lineTotal   = $harga * $jumlah;
    $grandtotal  = $lineTotal;

    // hitung diskon
    if ($grandtotal == 0) {
        $d = "0%";
        $diskon = 0;
    } elseif ($grandtotal < 50000) {
        $d = "5%";
        $diskon = 0.05 * $grandtotal;
    } elseif ($grandtotal <= 100000) {
        $d = "10%";
        $diskon = 0.10 * $grandtotal;
    } else {
        $d = "15%";
        $diskon = 0.15 * $grandtotal;
    }

    $totalbayar = $grandtotal - $diskon;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>POLGAN MART - Single Input</title>
</head>
<body>
    <h2>Input Barang (Sekali saja)</h2>
    <form method="post">
        
        <!-- ===== SELECT KODE BARANG ===== -->
        <div>
            <label>Kode Barang</label><br>
            <select name="kode" id="kodeBarang">
                <option value="">Pilih Kode Barang</option>
                <?php foreach ($barangList as $b): ?>
                    <option 
                        value="<?= $b['kode']; ?>"
                        data-nama="<?= $b['nama']; ?>"
                        data-harga="<?= $b['harga']; ?>"
                        <?= (($_POST['kode'] ?? '') == $b['kode']) ? 'selected' : ''; ?>
                    >
                        <?= $b['kode'] . " - " . $b['nama']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Nama Barang otomatis -->
        <div>
            <label>Nama Barang</label><br>
            <input type="text" id="namaBarang" name="nama" readonly 
                   value="<?php echo $_POST['nama'] ?? ''; ?>">
        </div>

        <!-- Harga otomatis -->
        <div>
            <label>Harga</label><br>
            <input type="number" id="hargaBarang" name="harga" min="0" readonly
                   value="<?php echo $_POST['harga'] ?? ''; ?>">
        </div>

        <div>
            <label>Jumlah</label><br>
            <input type="number" name="jumlah" min="1" 
                   value="<?php echo $_POST['jumlah'] ?? 1; ?>">
        </div>

        <div style="margin-top:8px;">
            <button type="submit">Kirim</button>
        </div>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <h2>Ringkasan Pembelian</h2>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Harga (Rp)</th>
                <th>Jumlah</th>
                <th>Total Baris (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $kode ?></td>
                <td><?= $nama ?></td>
                <td style="text-align:right;"><?= number_format($harga,0,',','.') ?></td>
                <td style="text-align:center;"><?= $jumlah ?></td>
                <td style="text-align:right;"><?= number_format($lineTotal,0,',','.') ?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Subtotal</strong></td>
                <td style="text-align:right;"><?= number_format($grandtotal,0,',','.') ?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Diskon (<?= $d ?>)</strong></td>
                <td style="text-align:right;"><?= number_format($diskon,0,',','.') ?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Total Bayar</strong></td>
                <td style="text-align:right;"><?= number_format($totalbayar,0,',','.') ?></td>
            </tr>
        </tfoot>
    </table>
    <?php endif; ?>

    <!-- ==== SCRIPT UNTUK OTOMATIS ISI NAMA & HARGA ==== -->
    <script>
        document.getElementById('kodeBarang').addEventListener('change', function () {
            let opt = this.options[this.selectedIndex];
            document.getElementById('namaBarang').value  = opt.getAttribute('data-nama')  || "";
            document.getElementById('hargaBarang').value = opt.getAttribute('data-harga') || "";
        });
    </script>

</body>
</html>