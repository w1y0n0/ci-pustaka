<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="col">
        <div class="row">
            <h1>Form Tambah Data Buku</h1>
            <form action="/buku/simpan" method="post" class="mt-4" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <!-- Judul -->
                <div class="form-group row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= (validation_show_error('judul')) ? 'is-invalid' : ''; ?>"
                            id="judul"
                            name="judul"
                            value="<?= old('judul'); ?>">
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
                            class="form-control <?= (validation_show_error('pengarang')) ? 'is-invalid' : ''; ?>"
                            id="pengarang"
                            name="pengarang"
                            value="<?= old('pengarang'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('pengarang'); ?>
                        </div>
                    </div>
                </div>

                <!-- Penerbit -->
                <div class="form-group row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= (validation_show_error('penerbit')) ? 'is-invalid' : ''; ?>"
                            id="penerbit"
                            name="penerbit"
                            value="<?= old('penerbit'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('penerbit'); ?>
                        </div>
                    </div>
                </div>

                <!-- Tahun Terbit -->
                <div class="form-group row mb-3">
                    <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= (validation_show_error('tahun_terbit')) ? 'is-invalid' : ''; ?>"
                            id="tahun_terbit"
                            name="tahun_terbit"
                            value="<?= old('tahun_terbit'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('tahun_terbit'); ?>
                        </div>
                    </div>
                </div>

                <!-- Sampul -->
                <div class="form-group row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul Buku</label>
                    <div class="col-sm-10">
                        <input class="form-control <?= (validation_show_error('sampul')) ? 'is-invalid' : ''; ?>"
                            type="file"
                            id="sampul"
                            name="sampul">
                        <div class="invalid-feedback">
                            <?= validation_show_error('sampul'); ?>
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