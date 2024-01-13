 <!-- General JS Scripts -->
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
 </script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
 </script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
 <script src="<?= base_url('vendor/fontawesome-free/js/all.min.js') ?>"></script>
 <script src="<?= base_url('assets/js/stisla.js') ?>"></script>

 <!-- JS Libraies -->
 <script src="<?= base_url('vendor/simple-notify/dist/simple-notify.min.js') ?>"></script>
 <script src="<?= base_url('vendor/sweetalert/dist/sweetalert2.all.min.js') ?>"></script>
 <script src="<?= base_url('vendor/DataTables/datatables.min.js') ?>"></script>
 <script src="<?= base_url('vendor/select2/dist/js/select2.full.min.js') ?>"></script>
 <script src="<?= base_url('vendor/daterangepicker/daterangepicker.js') ?>"></script>


 <!-- Template JS File -->
 <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
 <script src="<?= base_url('assets/js/custom.js') ?>"></script>

 <!-- Page Specific JS File -->
 <?= $this->include('layouts/includes/alert-message') ?>

 <?= $this->renderSection('addon-script') ?>