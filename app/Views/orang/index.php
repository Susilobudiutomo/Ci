<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="ro">
        <div class="col-5">
            <h1 class="mt-2">Daftar Karyawan</h1>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukan Keyword Pencarian" name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">

            <table class="table" border="10px">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (8 * ($currentpage - 1));
                    ?>
                    <?php foreach ($orang as $o) : ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $o['nama']; ?></td>
                            <td><?= $o['alamat']; ?></td>
                            <td>
                                <a href="#" class="btn btn-warning">Edit</a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('orang', 'orang_pagination'); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>