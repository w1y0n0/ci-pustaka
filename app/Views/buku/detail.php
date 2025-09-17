<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-2">Detail Buku</h3>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $buku['sampul']; ?>" class="img-fluid rounded-start" alt="<?= $buku['judul']; ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $buku['judul']; ?></h5>
                            <p class="card-text"><b>Pengarang : <?= $buku['pengarang']; ?> </b></p>
                            <p class="card-text">Penerbit : <?= $buku['penerbit']; ?></p>
                            <p class="card-text">Tahun Terbit : <?= $buku['tahun_terbit']; ?></p>

                            <a href="" class="btn btn-warning">Ubah</a>
                            <a href="" class="btn btn-danger">Hapus</a>
                            <br><br>
                            <a href="/buku">Kembali ke Daftar Buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>