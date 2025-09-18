<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="col">
        <div class="row">
            <h1>Form Tambah Data Buku</h1>

            <!-- Notif gagal tambah buku -->
            <?php if (session('failed')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session('failed') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('buku/create-buku') ?>" method="post" class="mt-4" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <!-- Judul -->
                <div class="form-group row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= (validation_show_error('judul')) ? 'is-invalid' : ''; ?>"
                            id="judul"
                            name="judul"
                            value="<?= old('judul'); ?>"
                            autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('judul'); ?>
                        </div>
                    </div>
                </div>

                <!-- Pengarang -->
                <div class="form-group row mb-3">
                    <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control"
                            id="pengarang"
                            name="pengarang"
                            value="<?= old('pengarang'); ?>">
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>
                </div>

                

                <!-- Tombol -->
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>