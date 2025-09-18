<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-2 mb-4">Ubah Data Buku</h3>
            <form action="/buku/update/<?= $buku['id_buku']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="sampulLama" value="<?= $buku['sampul']; ?>">
                <div class="form-group row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (validation_show_error('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= (old('judul')) ? old('judul') : $buku['judul']; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (validation_show_error('pengarang')) ? 'is-invalid' : ''; ?>" id="pengarang" name="pengarang" value="<?= (old('pengarang')) ? old('pengarang') : $buku['pengarang']; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('pengarang'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (validation_show_error('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $buku['penerbit']; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('penerbit'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (validation_show_error('tahun_terbit')) ? 'is-invalid' : ''; ?>" id="tahun_terbit" name="tahun_terbit" value="<?= (old('tahun_terbit')) ? old('tahun_terbit') : $buku['tahun_terbit']; ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('tahun_terbit'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <input class="form-control <?= (validation_show_error('sampul')) ? 'is-invalid' : ''; ?>" type="file" id="sampul" name="sampul" onchange="previewImg()">
                        <div class="invalid-feedback">
                            <?= validation_show_error('sampul'); ?>
                        </div>
                        <img src="/img/<?= $buku['sampul']; ?>" alt="" class="img-thumbnail img-preview mt-2" width="200">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                        <a href="/buku/<?= $buku['id_buku']; ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>