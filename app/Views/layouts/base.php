<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $this->renderSection('title', true) ?> &mdash; Manajemen Bengkel</title>

    <?= $this->include('layouts/includes/styles') ?>

    <style>
        * {
            /* border: solid 1px red; */
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Navbar Item -->
            <?= $this->include('layouts/includes/navbar') ?>
            <!-- Akhir Navbar -->

            <!-- Sidebar -->
            <?= $this->include('layouts/includes/sidebar') ?>
            <!-- Akhir Sidebar -->

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content') ?>

            </div>
            <!-- Akhir Main Content -->

            <!-- Footer -->
            <?= $this->include('layouts/includes/footer') ?>
            <!-- Akhir Footer -->
        </div>
    </div>
    <?= $this->include('layouts/includes/scripts') ?>

</body>

</html>