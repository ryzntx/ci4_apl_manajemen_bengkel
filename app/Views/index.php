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
                    <a class="nav-link active" aria-current="page" href="#beranda">Beranda</a>
                    <a class="nav-link" href="#layanan">Layanan</a>
                    <a class="nav-link" href="#kontak">Kontak</a>
                    <a class="nav-link" href="<?= (auth()->loggedIn()) ? base_url('beranda') : base_url('login') ?>"><?= (auth()->loggedIn()) ? 'Admin' : 'Masuk' ?></a>
                </div>
            </div>
        </div>
    </nav>

    <div data-bs-spy="scroll" data-bs-target="#main-navbar" data-bs-smooth-scroll="true" class="">
        <!-- Section 1 -->
        <div class="px-4 py-5 my-5 text-center" id="beranda">
            <h1 class="display-5 fw-bold text-body-emphasis"><?= json_decode($editor->where('type', 'section1-headline')->first()->data)->title ?></h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4"><?= json_decode($editor->where('type', 'section1-headline')->first()->data)->subtitle ?></p>
            </div>
        </div>
        <!-- End of Section 1 -->
        <?php if ($editor->where('type', 'section2-headline')->first()->visibility) : ?>
            <!-- Section 2 -->
            <div class="px-4 pt-5 my-5 text-center" id="layanan">
                <h1 class="display-4 fw-bold text-body-emphasis"><?= json_decode($editor->where('type', 'section2-headline')->first()->data)->title ?></h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead mb-4"><?= json_decode($editor->where('type', 'section2-headline')->first()->data)->subtitle ?></p>
                </div>
                <div class="overflow-hidden">
                    <div class="container px-5">
                        <div class="d-flex flex-column flex-lg-row gap-5 justify-content-center align-content-center align-items-center ">
                            <?php foreach ($editor->where('type', 'section2-item')->find() as $item) : ?>
                                <div class="card col-auto d-flex align-items-center align-content-center">

                                    <?php if (json_decode($item->data)->small != null) : ?>
                                        <div class="start-0 top-0 px-2 py-1 position-absolute bg-body bg-opacity-50 justify-content-center align-items-center" style="border-radius: 5px 0px 5px 0px;">
                                            <small class="text-black fw-medium ">
                                                <?= json_decode($item->data)->small ?>
                                            </small>
                                        </div>
                                    <?php endif ?>
                                    <img src="<?= base_url('uploads/images/' . json_decode($item->data)->image) ?>" alt="" class="card-img-top" style="width: 300px;">

                                    <div class="text-start p-2">
                                        <div class="card-subtitle">
                                            <small><?= json_decode($item->data)->subtitle ?></small>
                                        </div>
                                        <div class="card-title">
                                            <h6 class=""><?= json_decode($item->data)->title ?></h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Section 2 -->
        <?php endif ?>
        <?php if ($editor->where('type', 'section3-headline')->first()->visibility) : ?>
            <!-- Section 3 -->
            <div class="container col-xxl-8 px-4 py-5">
                <div class="row flex-lg-row align-items-center g-5 py-5">
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?= json_decode($editor->where('type', 'section3-headline')->first()->data)->title ?></h1>
                        <p class="lead"><?= json_decode($editor->where('type', 'section3-headline')->first()->data)->subtitle ?></p>
                    </div>
                    <div class="col-auto col-sm-12 col-lg-6">
                        <div class="d-flex flex-column gap-4 gap-md-2 px-4 p-md-0 justify-content-center align-content-center align-items-center">
                            <?php foreach ($editor->where('type', 'section3-item')->find() as $item) : ?>
                                <div class="card d-flex flex-sm-row gap-3 flex-column">
                                    <div class="col-auto">

                                        <img src="<?= base_url('uploads/images/' . json_decode($item->data)->image) ?>" alt="" class="card-img" style=" width: 200px; ">

                                    </div>
                                    <div class="text-start">
                                        <h6><?= json_decode($item->data)->title ?></h6>
                                        <p><?= json_decode($item->data)->subtitle ?></p>
                                    </div>
                                </div>
                            <?php endforeach ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Section 3 -->
        <?php endif ?>

        <!-- Contact Section -->
        <div class="container col-xl-10 col-xxl-8 px-4 pb-5" id="kontak">
            <div class="d-flex flex-wrap justify-content-around align-items-center px-2 g-lg-5 py-5">
                <div class="col-lg-6 col-12 text-center text-lg-start">
                    <h4 class="display-6 fw-bold lh-1 text-body-emphasis mb-3"><?= json_decode($editor->where('type', 'section4-headline')->first()->data)->title ?></h4>
                    <p class="lead"><?= json_decode($editor->where('type', 'section4-headline')->first()->data)->subtitle ?></p>
                </div>
                <div class="col-md-10   col-lg-6 ">
                    <div class="w-100">
                        <?= json_decode($editor->where('type', 'section4-map')->first()->data)->map ?>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between">
                <?php foreach ($editor->where('type', 'section4-item')->find() as $item) : ?>
                    <div class="col-12 col-md-4 text-center">
                        <div class="badge bg-primary p-3 rounded-circle my-3">
                            <i class="<?= json_decode($item->data)->icon ?>"></i>
                        </div>
                        <h6><?= json_decode($item->data)->title ?></h6>
                        <p><?= json_decode($item->data)->subtitle ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <!-- End of Contact Section -->
    </div>

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