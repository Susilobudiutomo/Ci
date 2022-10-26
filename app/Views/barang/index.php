<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <a href="/barang/create/" class="btn btn-primary mt-3">Tambah Data Barang</a>
      <h1 class="mt-2">Daftar Barang</h1>
      <?php if (session()->getFlashdata('Pesan')) : ?>
        <div class="alert alert-success" role="alert">
          <?= session()->getFlashdata('Pesan'); ?>
        </div>
      <?php endif; ?>
      <table class="table" border="10px">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          ?>
          <?php foreach ($barang as $b) : ?>
            <tr>
              <th scope="row"><?= $i++ ?></th>
              <td><img src="/img/<?= $b['gambar']; ?>" alt="" class="gambar"></td>
              <td><?= $b['nama_barang']; ?></td>
              <td>
                <a href="/barang/<?= $b['slug']; ?>" class="btn btn-success">Detail</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>