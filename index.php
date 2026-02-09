<?php
// data film disimpan dalam array
$film_data = [
    ["Avengers: Endgame", "avengers.jpeg"],
    ["Spider-Man: No Way Home", "spiderman.jpeg"],
    ["The Batman", "thebatman.jpeg"]
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bioskop Modern</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero {
            background-color: #000;
            background-size: cover;
            background-position: center;
            height: 300px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .film-img {
            height: 250px;
            object-fit: cover;
        }

        .card {
            height: 100%;
            border-radius: 12px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .row {
            justify-content: center;
        }
    </style>
</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Bioskop Modern</a>
    </div>
</nav>

<!-- hero landing page -->
<div class="hero">
    <div>
        <h2>Selamat Datang di Bioskop Modern</h2>
        <p>Tempat terbaik untuk menonton film favorit Anda</p>
        <!-- tombol menuju daftar film -->
        <a href="#film" class="btn btn-primary mt-2">Lihat Film</a>
    </div>
</div>

<!-- daftar -->
<div class="container mt-5" id="film">
    <h4 class="text-center mb-4">Daftar Film</h4>
    <div class="row">
        <?php foreach ($film_data as $film) { ?>
        <!-- data film -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <!-- tampilan gambar film -->
                <img src="img/<?= $film[1]; ?>" class="card-img-top film-img">
                <div class="card-body text-center">
                    <!-- tampilan judul film -->
                    <h6><?= $film[0]; ?></h6>

                    <!-- link ke halaman transaksi-->
                    <a href="transaksi.php?film=<?= $film[0]; ?>&gambar=<?= $film[1]; ?>"
                       class="btn btn-sm btn-primary mt-2">
                        Pesan Tiket
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
