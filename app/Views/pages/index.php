<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <!-- Section Header -->
    <div class="section-header">
        <h1>Blank Page</h1>
        <!-- Breadcrumb -->
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
            <div class="breadcrumb-item">Breadcrumb</div>
        </div>
    </div>
    <!-- Akhir Section Header -->

    <!-- Main Section -->
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Title Card</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Test</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Lol</button>
            </div>
        </div>
    </div>
    <!-- Akhir Main Section -->
</section>
<?= $this->endSection() ?>