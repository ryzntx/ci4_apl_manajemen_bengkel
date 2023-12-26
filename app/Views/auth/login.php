<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DS Motor</title>
    <link rel="stylesheet" href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/landingpage.css') ?>">
</head>

<body class="d-flex align-items-xl-center py-xl-4 bg-body-tertiary">

    <main class="form-signin w-100 mx-sm-auto my-xl-auto">
        <div class="card shadow-lg">
            <div class="card-header">
                <h5 class="card-text">Masuk</h5>
            </div>
            <div class="card-body p-5">
                <?php if (session('error') !== null) : ?>
                    <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                <?php elseif (session('errors') !== null) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php if (is_array(session('errors'))) : ?>
                            <?php foreach (session('errors') as $error) : ?>
                                <?= $error ?>
                                <br>
                            <?php endforeach ?>
                        <?php else : ?>
                            <?= session('errors') ?>
                        <?php endif ?>
                    </div>
                <?php endif ?>

                <?php if (session('message') !== null) : ?>
                    <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                <?php endif ?>
                <form action="<?= url_to('login') ?>" method="post" class="needs-validation">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nama Pengguna</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                            <input type="text" name="username" id="username" class="form-control" required autofocus autocomplete="username">
                            <div class="invalid-feedback">
                                Nama pengguna tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Sandi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control " required autofocus autocomplete="current-password">
                            <span class="input-group-text">
                                <i class="fa fa-eye" id="togglePassword" style="cursor: pointer"></i>
                            </span>
                        </div>
                    </div>
                    <?php if (setting('Auth.sessionConfig')['allowRemembering']) : ?>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label for="remember" class="form-check-label">Ingat saya</label>
                        </div>
                    <?php endif; ?>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://kit.fontawesome.com/0f99ad410b.js" crossorigin="anonymous"></script>
    <script>
        const togglePassword = document
            .querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', () => {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the eye icon
            togglePassword.classList.toggle('fa-eye');
            togglePassword.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>