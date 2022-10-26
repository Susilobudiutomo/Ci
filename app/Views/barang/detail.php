<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Barang</h2>
            <div class="card mb-3" style="max-width: 550px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $barang['gambar']; ?>" class="gambardetail" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $barang['nama_barang']; ?></h5>
                            <p class="card-text"><b>Stok : </b><?= $barang['stok']; ?></p>
                            <p class="card-text"><small class="text-muted">Harga : Rp.</small><?= $barang['harga']; ?></p>

                            <a href="/barang/edit/<?= $barang['slug']; ?>" class="btn btn-warning">Edit</a>

                            <form action="/barang/<?= $barang['id_barang']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Yakin Ingin Menghapus Data ?')">Delete </button>

                            </form>

                            <br><br>
                            <a href="/barang" class="btn btn-primary">Kenbali Ke Daftar Barang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div <?= $this->endSection(); ?>