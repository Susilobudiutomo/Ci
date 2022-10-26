<?= $this->extend('/layout/tamplate'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">From Tambah Data Barang</h2>
            <form action="/barang/save" method="post" enctype="multipart/form-data">
                <!-- csrf_field(); untuk menjaga agar from bisa di input lewat halaman ini saja (menghindari pembajakan ) -->
                <?= csrf_field(); ?>

                <div class="row mb-3">
                    <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_barang')) ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" autofocus value="<?= old('nama_barang'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->geterror('nama_barang'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->geterror('harga'); ?>
                        </div>
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= old('stok'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->geterror('stok'); ?>
                        </div>
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="gambar" class="col-sm-2 col-form-label ">Gambar</label>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview ">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="form-control form-control-sm 
                            <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" onchange="previewImg()">
                            <label class="form-label" for="gambar">Pilih Gambar</label>

                            <div class="invalid-feedback">
                                <?= $validation->geterror('gambar'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type=" submit" class="btn btn-primary">Tambah Data</button>
        </div>
        </form>
    </div>
</div>
</div>
<?= $this->endSection(); ?>