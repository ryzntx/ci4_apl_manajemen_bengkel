<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Editor<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Editor</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item"><a href="">Editors</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="card card-body">

            <nav class="navbar navbar-expand-lg bg-body-tertiary px-5 fixed-top hero-editor" id="main-navbar">
                <div class="hero-item-editor position-absolute" style="left: 65%;">
                    <a href="#" id="edit" data-modal-title="Edit Navbar Item" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                </div>
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
                            <a class="nav-link" href="#">Masuk</a>
                        </div>
                    </div>
                </div>
            </nav>
            <div data-bs-spy="scroll" data-bs-target="#main-navbar" data-bs-smooth-scroll="true" class="">
                <!-- Section 1 -->
                <div class="px-4 py-5 my-5 text-center" id="beranda">
                    <div class="hero-editor">

                        <div class="hero-item-editor position-absolute" style="left: 75%;">
                            <a href="#" id="edit" data-modal-title="Edit Section 1" data-modal-action="headline-section" data-modal-type="section1-headline" data-id="<?= $editor->where('type', 'section1-headline')->first()->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        </div>
                        <h1 class="display-5 fw-bold text-body-emphasis"><?= json_decode($editor->where('type', 'section1-headline')->first()->data)->title ?></h1>
                        <div class="col-lg-6 mx-auto">
                            <p class="lead mb-4"><?= json_decode($editor->where('type', 'section1-headline')->first()->data)->subtitle ?></p>
                        </div>
                    </div>
                </div>
                <!-- End of Section 1 -->

                <!-- Section 2 -->
                <div class="px-4 pt-5 my-5 text-center hero-editor <?= ($editor->where('type', 'section2-headline')->first()->visibility == 0) ? 'opacity-50' : '' ?>" id="layanan">
                    <div class="hero-item-editor position-absolute" style="left: 35%;">
                        <a href="" id="setVisibility" data-visibility="<?= $editor->where('type', 'section2-headline')->first()->visibility ?>" data-id="<?= $editor->where('type', 'section2-headline')->first()->id ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                    </div>
                    <div class="hero-editor">
                        <div class="hero-item-editor position-absolute" style="left: 65%;">
                            <a href="#" id="edit" data-modal-title="Edit Section 2" data-modal-action="headline-section" data-modal-type="section2-headline" data-id="<?= $editor->where('type', 'section2-headline')->first()->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        </div>
                        <h1 class="display-4 fw-bold text-body-emphasis"><?= json_decode($editor->where('type', 'section2-headline')->first()->data)->title ?></h1>
                        <div class="col-lg-6 mx-auto">
                            <p class="lead mb-4"><?= json_decode($editor->where('type', 'section2-headline')->first()->data)->subtitle ?></p>
                        </div>
                    </div>
                    <div class="overflow-hidden">
                        <div class="container px-5">
                            <div class="d-flex flex-column flex-lg-row gap-5 justify-content-center align-content-center align-items-center ">
                                <?php foreach ($editor->where('type', 'section2-item')->find() as $item) : ?>
                                    <div class="card col-auto hero-editor">
                                        <div class="end-0 hero-item-editor position-absolute">
                                            <a href="#" id="edit" data-modal-title="Edit Item Section 2" data-modal-action="item-section2" data-id="<?= $item->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="" id="delete" data-id="<?= $item->id ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </div>

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
                                <?php if (count($editor->where('type', 'section2-item')->find()) < 4) : ?>
                                    <div class="card col-auto">
                                        <div class="card-body d-flex bg-body-secondary align-content-center">
                                            <div class="text-center">
                                                <button class="btn btn-secondary" id="edit" data-modal-title="Tambah Item Section 2" data-modal-action="new-item-section2"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Section 2 -->

                <!-- Section 3 -->
                <div class="container col-xxl-8 px-2 py-5 hero-editor <?= ($editor->where('type', 'section3-headline')->first()->visibility == 0) ? 'opacity-50' : '' ?>">
                    <div class="hero-item-editor position-absolute ">
                        <a href="" id="setVisibility" data-visibility="<?= $editor->where('type', 'section3-headline')->first()->visibility ?>" data-id="<?= $editor->where('type', 'section3-headline')->first()->id ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                    </div>
                    <div class="row flex-lg-row align-items-center g-5 py-5">
                        <div class="col-lg-6 hero-editor">
                            <div class="hero-item-editor position-absolute" style="left: 45%;">
                                <a href="#" id="edit" data-modal-title="Edit Headline Section 3" data-modal-action="headline-section" data-modal-type="section3-headline" data-id="<?= $editor->where('type', 'section3-headline')->first()->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            </div>
                            <div class="col-auto">
                                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?= json_decode($editor->where('type', 'section3-headline')->first()->data)->title ?></h1>
                                <p class="lead"><?= json_decode($editor->where('type', 'section3-headline')->first()->data)->subtitle ?></p>
                            </div>
                        </div>
                        <div class="col-auto col-sm-12 col-lg-6">
                            <div class="d-flex flex-column gap-4 gap-md-2 px-4 p-md-0 justify-content-center align-content-center align-items-center">
                                <?php foreach ($editor->where('type', 'section3-item')->find() as $item) : ?>
                                    <div class="card d-flex flex-sm-row gap-3 flex-column hero-editor">
                                        <div class="start-0 hero-item-editor position-absolute">
                                            <a href="#" id="edit" data-modal-title="Edit Item Section 3" data-modal-action="item-section3" data-id="<?= $item->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="" id="delete" data-id="<?= $item->id ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </div>
                                        <div class="col-auto">

                                            <img src="<?= base_url('uploads/images/' . json_decode($item->data)->image) ?>" alt="" class="card-img" style=" width: 200px; ">

                                        </div>
                                        <div class="text-start">
                                            <h6><?= json_decode($item->data)->title ?></h6>
                                            <p><?= json_decode($item->data)->subtitle ?></p>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                                <?php if (count($editor->where('type', 'section3-item')->find()) < 3) : ?>
                                    <div class="card d-flex flex-sm-row gap-3 flex-column">
                                        <div class="card-body d-flex bg-body-secondary align-content-center">
                                            <div class="text-center">
                                                <button class="btn btn-secondary" id="edit" data-modal-title="Tambah Item Section 3" data-modal-action="new-item-section3"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Section 3 -->

                <!-- Contact Section -->
                <div class="container col-xl-10 col-xxl-8 px-4 pb-5" id="kontak">
                    <div class="d-flex flex-wrap justify-content-around align-items-center px-2 g-lg-5 py-5">
                        <div class="col-lg-6 col-12 text-center text-lg-start hero-editor">
                            <div class="hero-item-editor position-absolute" style="left: 45%;">
                                <a href="#" id="edit" data-modal-title="Edit Headline Section 4" data-modal-action="headline-section" data-modal-type="section4-headline" data-id="<?= $editor->where('type', 'section4-headline')->first()->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                            </div>
                            <h4 class="display-6 fw-bold lh-1 text-body-emphasis mb-3"><?= json_decode($editor->where('type', 'section4-headline')->first()->data)->title ?></h4>
                            <p class="lead"><?= json_decode($editor->where('type', 'section4-headline')->first()->data)->subtitle ?></p>

                        </div>
                        <div class="col-md-10 col-lg-6 hero-editor">
                            <div class="hero-item-editor position-absolute" style="left: 78%">
                                <a href="#" id="edit" data-modal-title="Edit Map Section 4" data-modal-action="map-section" data-id="<?= $editor->where('type', 'section4-map')->first()->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            </div>
                            <div class="w-100">
                                <?= json_decode($editor->where('type', 'section4-map')->first()->data)->map ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between">
                        <?php foreach ($editor->where('type', 'section4-item')->find() as $item) : ?>
                            <div class="col-12 col-md-4 text-center hero-editor">
                                <div class="hero-item-editor position-absolute ">
                                    <a href="#" id="edit" data-id="<?= $item->id ?>" data-modal-title="Edit Item Section 4" data-modal-action="item-section4" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                </div>
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
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data" id="">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="type" id="type" class="d-none" readonly>
                    <input type="hidden" name="id" id="id" class="d-none" readonly>
                    <div class="form-group d-none" id="form-title">
                        <label for="" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group d-none" id="form-subtitle">
                        <label for="" class="form-label">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" class="form-control">
                    </div>
                    <div class="form-group d-none" id="form-small">
                        <label for="" class="form-label">Small</label>
                        <input type="text" name="small" id="small" class="form-control">
                    </div>
                    <div class="form-group d-none" id="form-icon">
                        <label for="" class="form-label">Icon</label>
                        <input type="text" name="icon" id="icon" class="form-control">
                        <small>Klik disini untuk mencari icon lebih lanjut</small>
                    </div>
                    <div class="form-group d-none" id="form-upload">
                        <label for="" class="form-label">Upload gambar</label>
                        <input type="file" name="upload_file" id="upload-file" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group d-none" id="code-editor">
                        <label for="" class="form-label">Frame Map</label>
                        <textarea name="editor" id="editor" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('addon-script') ?>
<script>
    $(function() {
        $(document).on('click', '#edit', function(e) {
            e.preventDefault()
            var modalTitle = $(this).data('modal-title')
            var modalAction = $(this).data('modal-action')
            var modalType = $(this).data('modal-type')
            var id = $(this).data('id');

            $('#form-title').attr('class', 'd-none');
            $('#form-subtitle').attr('class', 'd-none');
            $('#form-small').attr('class', 'd-none');
            $('#form-icon').attr('class', 'd-none');
            $('#form-upload').attr('class', 'd-none');
            $('#code-editor').attr('class', 'd-none');

            $('form').trigger('reset')
            $('form').attr('id', '');
            $('form').attr('action', '');


            $('#editModalLabel').html(modalTitle);

            if (modalAction == 'headline-section') {
                $('form').attr('id', 'formEditSection');
                $('#form-title').attr('class', 'd-block');
                $('#form-subtitle').attr('class', 'd-block');
                $.ajax({
                    type: "get",
                    url: "<?= base_url('editor/read/') ?>" + id,
                }).done(function(res) {
                    $('#id').val(res['id']);
                    $('#type').val(modalType);
                    $('#title').val(JSON.parse(res['data']).title);
                    $('#subtitle').val(JSON.parse(res['data']).subtitle);
                    // $('form').attr('action', '<?= base_url('editor/updateitem/') ?>' + res['id']);
                    $('#editModal').modal('show')
                }).fail(function(error) {
                    console.error(error);
                });
            }

            if (modalAction == 'new-item-section2') {
                $('form').attr('id', 'formInput');
                // $('form').attr('action', '<?= base_url('editor/saveitem') ?>');
                $('#form-title').attr('class', 'd-block');
                $('#form-subtitle').attr('class', 'd-block');
                $('#form-small').attr('class', 'd-block');
                $('#form-upload').attr('class', 'd-block');
                $('#type').val('section2-item');
                $('#editModal').modal('show')
            }

            if (modalAction == 'item-section2') {
                $('form').attr('id', 'formEditItemSection');
                $('#form-title').attr('class', 'd-block');
                $('#form-subtitle').attr('class', 'd-block');
                $('#form-small').attr('class', 'd-block');
                $('#form-upload').attr('class', 'd-block');
                $('#type').val('section2-item');
                $.ajax({
                    type: "get",
                    url: "<?= base_url('editor/read/') ?>" + id,
                }).done(function(res) {
                    $('#id').val(res['id']);
                    $('#title').val(JSON.parse(res['data']).title);
                    $('#subtitle').val(JSON.parse(res['data']).subtitle);
                    $('#small').val(JSON.parse(res['data']).small);
                    // $('form').attr('action', '<?= base_url('editor/updateitem/') ?>' + res['id']);
                    $('#editModal').modal('show')
                }).fail(function(error) {
                    console.error(error);
                });
            }

            if (modalAction == 'new-item-section3') {
                $('form').attr('id', 'formInput');
                // $('form').attr('action', '<?= base_url('editor/saveitem') ?>');
                $('#form-title').attr('class', 'd-block');
                $('#form-subtitle').attr('class', 'd-block');
                $('#form-upload').attr('class', 'd-block');
                $('#type').val('section3-item');
                $('#editModal').modal('show')
            }

            if (modalAction == 'item-section3') {
                $('form').attr('id', 'formEditItemSection');
                $('#form-title').attr('class', 'd-block');
                $('#form-subtitle').attr('class', 'd-block');
                $('#form-upload').attr('class', 'd-block');
                $('#type').val('section3-item');
                $.ajax({
                    type: "get",
                    url: "<?= base_url('editor/read/') ?>" + id,
                }).done(function(res) {
                    $('#id').val(res['id']);
                    $('#title').val(JSON.parse(res['data']).title);
                    $('#subtitle').val(JSON.parse(res['data']).subtitle);
                    // $('form').attr('action', '<?= base_url('editor/updateitem/') ?>' + es['id']);
                    $('#editModal').modal('show')
                }).fail(function(error) {
                    console.error(error);
                });
            }

            if (modalAction == 'map-section') {
                $('form').attr('id', 'formEditMapSection');
                $('#code-editor').attr('class', 'd-block');
                $.ajax({
                    type: "get",
                    url: "<?= base_url('editor/read/') ?>" + id,
                }).done(function(res) {
                    $('#id').val(res['id']);
                    $('#editor').val(JSON.parse(res['data']).map);
                    // $('form').attr('action', '<?= base_url('editor/updateitem/') ?>' + res['id']);
                    $('#editModal').modal('show')
                }).fail(function(error) {
                    console.error(error);
                });
            }

            if (modalAction == 'item-section4') {
                $('form').attr('id', 'formEditItemSection');
                $('#form-title').attr('class', 'd-block');
                $('#form-subtitle').attr('class', 'd-block');
                $('#form-icon').attr('class', 'd-block');
                $('#type').val('section4-item');

                $.ajax({
                    type: "get",
                    url: "<?= base_url('editor/read/') ?>" + id,
                }).done(function(res) {
                    $('#id').val(res['id']);
                    $('#title').val(JSON.parse(res['data']).title);
                    $('#subtitle').val(JSON.parse(res['data']).subtitle);
                    $('#icon').val(JSON.parse(res['data']).icon);
                    // $('form').attr('action', '<?= base_url('editor/updateitem/') ?>' + es['id']);
                    $('#editModal').modal('show')
                }).fail(function(error) {
                    console.error(error);
                });

            }

        })

        $(document).on('submit', '#formInput', function(e) {
            var formData = new FormData(document.querySelector('form'))
            console.log(formData);
            $.ajax({
                type: "post",
                url: "<?= base_url('editor/saveitem') ?>",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function(res) {
                // console.log(res);
                $('#editModal').modal('hide')
                $('#formInput').trigger('reset')
                window.location.reload()

            }).fail(function(err) {
                console.error(err);
            });
            e.preventDefault();
        })

        $(document).on('submit', '#formEditItemSection', function(e) {
            var formData = new FormData(document.querySelector('form'))
            console.log(formData);
            var id = $('#id').val()
            $.ajax({
                type: "post",
                url: "<?= base_url('editor/updateitem/') ?>" + id,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function(res) {
                console.log(res);
                $('#editModal').modal('hide')
                $('#formEditItemSection').trigger('reset')
                window.location.reload()

            }).fail(function(err) {
                console.error(err);
            });
            e.preventDefault();
        })
        $(document).on('submit', '#formEditSection', function(e) {
            var formData = new FormData(document.querySelector('form'))
            console.log(formData);
            var id = $('#id').val()
            $.ajax({
                type: "post",
                url: "<?= base_url('editor/updatesection/') ?>" + id,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function(res) {
                // console.log(res);
                $('#editModal').modal('hide')
                $('#formEditSection').trigger('reset')
                window.location.reload()

            }).fail(function(err) {
                console.error(err);
            });
            e.preventDefault();
        })

        $(document).on('click', '#delete', function(e) {
            e.preventDefault()
            var id = $(this).data('id')
            console.log(id);
            $.ajax({
                type: "get",
                url: "<?= base_url('editor/deleteitemsection/') ?>" + id,
            }).done(function(res) {
                // console.log(res);
                window.location.reload()
            })
        })

        $(document).on('click', '#setVisibility', function(e) {
            e.preventDefault()
            let visibility = $(this).data('visibility')
            let id = $(this).data('id')
            console.log((visibility == 0) ? '1' : '0');
            $.ajax({
                type: "post",
                url: "<?= base_url('editor/setvisibility/') ?>" + id,
                data: {
                    visibility: (visibility == 0) ? '1' : '0',
                },
            }).done(function(res) {
                window.location.reload()
            }).fail(function(error) {
                console.error(error);
            });
        })
    });
</script>
<?= $this->endSection() ?>