<?php
// ambil data film & gambar dari URL sebelumnya
$film   = $_GET['film'] ?? '';
$gambar = $_GET['gambar'] ?? '';

// harga tiket
$hargaVIP     = 150000;
$hargaReguler = 75000;
$biayaAdmin   = 2500;

// challenge
// biaya tambahan jam malam
$biayaTambahanMalam = 25000;

// nilai awal
$jam = $ruangan = '';
$jumlah = '';
$totalAngka = 0;
$biayaTambahan = 0;
$sudahHitung = false;

// hitung
if (isset($_POST['hitung'])) {
    // ambil data dari form
    $jam     = $_POST['jam'];
    $ruangan = $_POST['ruangan'];
    $jumlah  = (int) $_POST['jumlah'];
    // menentukan harga tiket berdasarkan jenis ruangan
    // jika ruangan VIP pakai harga VIP
    // jika bukan reguler maka pakai harga reguler
    $hargaTiket = ($ruangan == 'VIP') ? $hargaVIP : $hargaReguler;
    // challenge
    // jam malam (19.00 - 20.30)
    if ($jam == '19.00' || $jam == '20.00' || $jam == '20.30') {
        $biayaTambahan = $biayaTambahanMalam * $jumlah;
    }
    // total harga
    $totalAngka = ($hargaTiket * $jumlah) + ($biayaAdmin * $jumlah) + $biayaTambahan;
    $sudahHitung = true;
}

// pesan
if (isset($_POST['pesan'])) {
    $jam     = $_POST['jam'];
    $ruangan = $_POST['ruangan'];
    $jumlah  = (int) $_POST['jumlah'];
    $totalAngka = (int) $_POST['totalAngka'];

    // hitung ulang biaya tambahan
    if ($jam == '19.00' || $jam == '20.00' || $jam == '20.30') {
        $biayaTambahan = $biayaTambahanMalam * $jumlah;
    }

    echo "<script>
        alert(
            'Pesanan Berhasil!\\n\\n' +
            'Film : $film\\n' +
            'Jam Tayang : $jam\\n' +
            'Ruangan : $ruangan\\n' +
            'Jumlah Tiket : $jumlah\\n' +
            'Biaya Admin : Rp " . number_format($biayaAdmin * $jumlah, 0, ',', '.') . "\\n' +
            'Biaya Tambahan Jam Malam : Rp " . number_format($biayaTambahan, 0, ',', '.') . "\\n\\n' +
            'Total Bayar : Rp " . number_format($totalAngka, 0, ',', '.') . "'
        );
        window.location = 'index.php';
    </script>";
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5" style="max-width:600px;">
    <div class="text-center mb-4">
        <img src="img/<?= $gambar ?>" width="200" class="mb-3">
        <h4>Pesan Tiket - <?= $film ?></h4>
    </div>

    <form method="post">
        <!-- jam tayang -->
        <div class="mb-3">
            <label class="form-label">Jam Tayang</label><br>
            <input type="radio" name="jam" value="12.00" <?= ($jam=='12.00')?'checked':'' ?>> 12.00
            <input type="radio" name="jam" value="16.00" <?= ($jam=='16.00')?'checked':'' ?>> 16.00
            <input type="radio" name="jam" value="18.00" <?= ($jam=='18.00')?'checked':'' ?>> 18.00
        </div>
        <!-- challenge: jam malam -->
        <div class="mb-3">
            <label class="form-label">Jam Tayang Malam - Tambahan Biaya Rp 25.000</label><br>
            <input type="radio" name="jam" value="19.00" <?= ($jam=='19.00')?'checked':'' ?>> 19.00
            <input type="radio" name="jam" value="20.00" <?= ($jam=='20.00')?'checked':'' ?>> 20.00
            <input type="radio" name="jam" value="20.30" <?= ($jam=='20.30')?'checked':'' ?>> 20.30
        </div>

        <!-- ruangan -->
        <div class="mb-3">
            <label class="form-label">Jenis Ruangan</label><br>
            <input type="radio" name="ruangan" value="VIP" <?= ($ruangan=='VIP')?'checked':'' ?>>
            VIP - Rp 150.000<br>
            <input type="radio" name="ruangan" value="Reguler" <?= ($ruangan=='Reguler')?'checked':'' ?>>
            Reguler - Rp 75.000
        </div>

        <!-- jumlah tiket -->
        <div class="mb-3">
            <label class="form-label">Jumlah Tiket</label>
            <input type="number" name="jumlah" class="form-control" value="<?= $jumlah ?>">
        </div>

        <!-- hitung -->
        <button type="submit" name="hitung" class="btn btn-primary">
            Hitung
        </button>

        <!-- total -->
        <div class="mt-4">
            <label class="form-label">Total (termasuk Biaya Admin)</label>
            <input type="text" class="form-control" readonly
                   value="<?= $sudahHitung ? 'Rp ' . number_format($totalAngka, 0, ',', '.') : '' ?>">
        </div>

        <input type="hidden" name="totalAngka" value="<?= $totalAngka ?>">

        <!-- pesan -->
        <button type="submit" name="pesan" class="btn btn-success mt-3">
            Pesan
        </button>

    </form>
</div>

</body>
</html>
