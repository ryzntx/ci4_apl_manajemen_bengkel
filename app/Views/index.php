<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DS Motor</title>
    <link rel="stylesheet" href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css') ?>">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary px-5 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <!-- <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24"
                        class="d-inline-block align-text-top">  -->
                DS Motor
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    <a class="nav-link" href="#layanan">Layanan</a>
                    <a class="nav-link" href="#kontak">Kontak</a>
                    <a class="nav-link" href="<?= (auth()->loggedIn()) ? base_url('beranda') : base_url('login') ?>"><?= (auth()->loggedIn()) ? 'Admin' : 'Masuk' ?></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Section 1 -->
    <div class="px-4 py-5 my-5 text-center" id="layanan">
        <h1 class="display-5 fw-bold text-body-emphasis">Selamat Datang di DS Motor</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Kami menyediakan layanan perbaikan sepeda motor yang profesional dengan harga
                terjangkau.
            </p>
        </div>
    </div>
    <!-- End of Section 1 -->

    <!-- Section 2 -->
    <div class="px-4 pt-5 my-5 text-center">
        <h1 class="display-4 fw-bold text-body-emphasis">Layanan Kami</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Kami menawarkan berbagai layanan perbaikan dan perawatan sepeda motor.</p>
        </div>
        <div class="overflow-hidden">
            <div class="container px-5">
                <div class="d-flex flex-column flex-lg-row gap-5 justify-content-center">
                    <div class="card col-auto">
                        <div class="card-img-top bg-body-secondary">
                            <div class="left-0 top-0 px-2 py-1 position-absolute bg-black bg-opacity-10 justify-content-center align-items-center" style="border-radius: 5px 0px 5px 0px;">
                                <small class="text-black fw-medium ">
                                    Cepat dan Andal
                                </small>
                            </div>
                            <div class="p-5">
                                Image of Motorcyle Repair

                            </div>
                        </div>
                        <div class="text-start p-2">
                            <div class="card-subtitle">
                                <small>Perbaikan Sepeda Motor</small>
                            </div>
                            <div class="card-title">
                                <h6 class="">Mulai dari Rp. 50.000</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card col-auto">
                        <div class="card-img-top bg-body-secondary">
                            <div class="left-0 top-0 px-2 py-1 position-absolute bg-black bg-opacity-10
                                    justify-content-center align-items-center" style="border-radius: 5px 0px 5px 0px;">
                                <small class="text-black fw-medium ">
                                    Pemeriksaan Rutin
                                </small>
                            </div>
                            <div class="p-5">
                                Image of Motorcyle Repair

                            </div>
                        </div>
                        <div class="text-start p-2">
                            <div class="card-subtitle">
                                <small>Pemeliharaan Sepeda Motor</small>
                            </div>
                            <div class="card-title">
                                <h6 class="">Mulai dari Rp. 30.000</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card col-auto">
                        <div class="card-img-top bg-body-secondary">
                            <div class="p-5">
                                Image of Motorcyle Repair

                            </div>
                        </div>
                        <div class="text-start p-2">
                            <div class="card-subtitle">
                                <small>Pergantian Ban</small>
                            </div>
                            <div class="card-title">
                                <h6 class="">Mulai dari Rp. 20.000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Section 2 -->

    <!-- Section 3 -->
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row align-items-center g-5 py-5">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Kenapa Memilih Kami?
                </h1>
                <p class="lead">Berikut adalah beberapa alasan mengapa Anda harus memilih bengkel motor kami.</p>
            </div>
            <div class="col-auto col-sm-12 col-lg-6">
                <div class="d-flex flex-column gap-4 gap-md-2 px-4 p-md-0">
                    <div class="card d-flex flex-sm-row gap-3 flex-column">
                        <div class="col-auto col-lg-4">
                            <div class="p-5 bg-body-secondary">
                                Gambar Disini
                            </div>
                        </div>
                        <div class="">
                            <h6>Mekanik yang Berpengalaman</h6>
                            <p>Tim mekanin kami yang berpengalaman memastikan perbaikan kualitas tinggi.</p>
                        </div>
                    </div>
                    <div class="card d-flex flex-sm-row gap-3 flex-column">
                        <div class="col-auto col-lg-4">
                            <div class="p-5 bg-body-secondary">
                                Gambar Disini
                            </div>
                        </div>
                        <div class="">
                            <h6>Mekanik yang Berpengalaman</h6>
                            <p>Tim mekanin kami yang berpengalaman memastikan perbaikan kualitas tinggi.</p>
                        </div>
                    </div>
                    <div class="card d-flex flex-sm-row gap-3 flex-column">
                        <div class="col-auto col-lg-4">
                            <div class="p-5 bg-body-secondary">
                                Gambar Disini
                            </div>
                        </div>
                        <div class="">
                            <h6>Mekanik yang Berpengalaman</h6>
                            <p>Tim mekanin kami yang berpengalaman memastikan perbaikan kualitas tinggi.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End of Section 3 -->

    <!-- Contact Section -->
    <div class="container col-xl-10 col-xxl-8 px-4 pb-5" id="kontak">
        <div class="d-flex flex-wrap justify-content-around align-items-center px-2 g-lg-5 py-5">
            <div class="col-lg-6 col-12 text-center text-lg-start">
                <h4 class="display-6 fw-bold lh-1 text-body-emphasis mb-3">Hubungi Kami
                </h4>

            </div>
            <div class="col-md-10   col-lg-6 ">
                <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1129.5904466700697!2d107.796212227274!3d-6.558723483832988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e693b0ef729f41f%3A0x42cd2271c5b36889!2sDS%20Motor!5e0!3m2!1sid!2sid!4v1701957963491!5m2!1sid!2sid" style="border:0;" height="300" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-between">
            <div class="col-12 col-md-4 text-center">
                <div class="badge bg-primary p-3 rounded-circle my-3">
                    <i class="fa-solid fa-location-dot fa-xl"></i>
                </div>
                <h6>Alamat</h6>
                <p>Jalan Cinangsi, Kec. Cibogo, Kabupaten Subang, Jawa Barat 41285</p>
            </div>
            <div class="col-12 col-md-4 text-center">
                <div class="badge bg-primary p-3 rounded-circle my-3">
                    <i class="fa-solid fa-phone fa-xl"></i>
                </div>
                <h6>No Handphone</h6>
                <p>+6285-3242-32492</p>
            </div>
            <div class="col-12 col-md-4 text-center">
                <div class="badge bg-primary p-3 rounded-circle my-3">
                    <i class="fa-solid fa-envelope fa-xl"></i>
                </div>
                <h6>Email</h6>
                <p>dsmotor@gmail.com</p>
            </div>
        </div>
    </div>
    <!-- End of Contact Section -->

    <!-- Footer -->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 my-4 border-top">
            <div class=" d-flex align-items-center">
                <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 DS Motor. All rights reserved.</span>
            </div>
        </footer>
    </div>
    <!-- End of Footer -->

    <script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://kit.fontawesome.com/0f99ad410b.js" crossorigin="anonymous"></script>
</body>

</html>