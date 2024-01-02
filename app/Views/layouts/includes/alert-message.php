<script>
    <?php if (session('toast_success')) : ?>
        new Notify({
            status: 'success',
            title: 'Sukses!',
            text: '<?= session('toast_success') ?>',
            effect: 'fade',
            speed: 300,
            customClass: null,
            customIcon: null,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 1,
            position: 'right top'
        })
    <?php endif ?>
    <?php if (session('toast_error')) : ?>
        new Notify({
            status: 'error',
            title: 'Eror!',
            text: '<?= session('toast_error') ?>',
            effect: 'fade',
            speed: 300,
            customClass: null,
            customIcon: null,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 1,
            position: 'right top'
        })
    <?php endif ?>
    <?php if (session('toast_warning')) : ?>
        new Notify({
            status: 'warning',
            title: 'Peringatan!',
            text: '<?= session('toast_warning') ?>',
            effect: 'fade',
            speed: 300,
            customClass: null,
            customIcon: null,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 1,
            position: 'right top'
        })
    <?php endif ?>
    <?php if (session('success')) : ?>
        Swal.fire({
            title: 'Sukses!',
            text: '<?= session('success') ?>',
            icon: 'success',
            timer: 3500
        })
    <?php endif ?>
    <?php if (session('warning')) : ?>
        Swal.fire({
            title: 'Peringatan!',
            text: '<?= session('warning') ?>',
            icon: 'warning',
            timer: 3500
        })
    <?php endif ?>
    <?php if (session('error')) : ?>
        Swal.fire({
            title: 'Eror!',
            text: '<?= session('error') ?>',
            icon: 'error',
            timer: 3500
        })
    <?php endif ?>
    <?php if (session('info')) : ?>
        Swal.fire({
            title: 'Info!',
            text: '<?= session('info') ?>',
            icon: 'info',
            timer: 3500
        })
    <?php endif ?>

    function toastSuccess(text) {
        return new Notify({
            status: 'success',
            title: 'Sukses!',
            text: text,
            effect: 'fade',
            speed: 300,
            customClass: null,
            customIcon: null,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 1,
            position: 'right top'
        })
    }

    function toastError(text) {
        return new Notify({
            status: 'error',
            title: 'Error!',
            text: text,
            effect: 'fade',
            speed: 300,
            customClass: null,
            customIcon: null,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 1,
            position: 'right top'
        })
    }

    function toastWarning(text) {
        return new Notify({
            status: 'warning',
            title: 'Peringatan!',
            text: text,
            effect: 'fade',
            speed: 300,
            customClass: null,
            customIcon: null,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 1,
            position: 'right top'
        })
    }
</script>