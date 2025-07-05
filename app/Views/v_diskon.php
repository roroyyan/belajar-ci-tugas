<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h3>Kelola Diskon</h3>

  <!-- Flash message -->
  <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('failed')) : ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('failed') ?></div>
  <?php endif; ?>

  <!-- Form Tambah Diskon -->
  <form action="<?= base_url('diskon/store') ?>" method="post" class="mb-4">
    <div class="row">
      <div class="col-md-4">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="<?= old('tanggal') ?>">
        <small class="text-danger"><?= isset($errors['tanggal']) ? $errors['tanggal'] : '' ?></small>
      </div>
      <div class="col-md-4">
        <label>Nominal Diskon (Rp)</label>
        <input type="number" name="nominal" class="form-control" value="<?= old('nominal') ?>">
        <small class="text-danger"><?= isset($errors['nominal']) ? $errors['nominal'] : '' ?></small>
      </div>
      <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-primary">Tambah Diskon</button>
      </div>
    </div>
  </form>

  <!-- Tabel Diskon -->
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Nominal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($diskon as $d) : ?>
        <tr>
          <td><?= $d['tanggal'] ?></td>
          <td><?= number_to_currency($d['nominal'], 'IDR') ?></td>
          <td>
            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $d['id'] ?>">Edit</button>
            <a href="<?= base_url('diskon/delete/' . $d['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus diskon tanggal <?= $d['tanggal'] ?>?')">Hapus</a>
          </td>
        </tr>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal<?= $d['id'] ?>" tabindex="-1">
          <div class="modal-dialog">
            <form action="<?= base_url('diskon/update/' . $d['id']) ?>" method="post" class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Diskon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label>Tanggal (readonly)</label>
                  <input type="date" name="tanggal" value="<?= $d['tanggal'] ?>" class="form-control" readonly style="background-color:#e9ecef;">
                </div>
                <div class="mb-3">
                  <label>Nominal</label>
                  <input type="number" name="nominal" value="<?= $d['nominal'] ?>" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              </div>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>