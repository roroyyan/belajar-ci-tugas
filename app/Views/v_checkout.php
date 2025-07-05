<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row">
  <div class="col-lg-6">
    <!-- Form Pemesanan -->
    <?= form_open('buy', 'class="row g-3"') ?>
    <?= form_hidden('username', session()->get('username')) ?>
    <?= form_input(['type' => 'hidden', 'name' => 'total_harga', 'id' => 'total_harga', 'value' => '']) ?>

    <div class="col-12">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" id="nama" value="<?= session()->get('username'); ?>" readonly>
    </div>
    <div class="col-12">
      <label for="alamat" class="form-label">Alamat</label>
      <input type="text" class="form-control" id="alamat" name="alamat">
    </div>
    <div class="col-12">
      <label for="kelurahan" class="form-label">Kelurahan</label>
      <select class="form-control" id="kelurahan" name="kelurahan" required></select>
    </div>
    <div class="col-12">
      <label for="layanan" class="form-label">Layanan</label>
      <select class="form-control" id="layanan" name="layanan" required></select>
    </div>
    <div class="col-12">
      <label for="ongkir" class="form-label">Ongkir</label>
      <input type="text" class="form-control" id="ongkir" name="ongkir" readonly>
    </div>
  </div>

  <div class="col-lg-6">
    <!-- Info Diskon -->
    <?php if (session()->get('diskon_nominal')) : ?>
      <div class="alert alert-warning">
        Diskon aktif: <strong><?= number_to_currency(session()->get('diskon_nominal'), 'IDR') ?></strong> per item produk
      </div>
    <?php endif; ?>

    <!-- Tabel Produk -->
    <div class="col-12">
      <table class="table">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($items)) :
            foreach ($items as $item) : ?>
              <tr>
                <td><?= $item['name'] ?></td>
                <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                <td><?= $item['qty'] ?></td>
                <td><?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
              </tr>
          <?php endforeach;
          endif; ?>
          <tr>
            <td colspan="2"></td>
            <td>Subtotal</td>
            <td><?= number_to_currency($total, 'IDR') ?></td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td>Total</td>
            <td><span id="total"><?= number_to_currency($total, 'IDR') ?></span></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Tombol Submit -->
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Buat Pesanan</button>
    </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function () {
  var ongkir = 0;
  var total = 0;
  hitungTotal();

  $('#kelurahan').select2({
    placeholder: 'Ketik nama kelurahan...',
    ajax: {
      url: '<?= base_url('get-location') ?>',
      dataType: 'json',
      delay: 1500,
      data: function (params) {
        return { search: params.term };
      },
      processResults: function (data) {
        return {
          results: data.map(function (item) {
            return {
              id: item.id,
              text: item.subdistrict_name + ", " + item.district_name + ", " + item.city_name + ", " + item.province_name + ", " + item.zip_code
            };
          })
        };
      },
      cache: true
    },
    minimumInputLength: 3
  });

  $("#kelurahan").on('change', function () {
    var id_kelurahan = $(this).val();
    $("#layanan").empty();
    ongkir = 0;

    $.ajax({
      url: "<?= site_url('get-cost') ?>",
      type: 'GET',
      data: { 'destination': id_kelurahan },
      dataType: 'json',
      success: function (data) {
        data.forEach(function (item) {
          var text = item["description"] + " (" + item["service"] + ") : estimasi " + item["etd"];
          $("#layanan").append($('<option>', {
            value: item["cost"],
            text: text
          }));
        });
        hitungTotal();
      },
    });
  });

  $("#layanan").on('change', function () {
    ongkir = parseInt($(this).val());
    hitungTotal();
  });

  function hitungTotal() {
    total = ongkir + <?= $total ?>;
    $("#ongkir").val(ongkir);
    $("#total").html("IDR " + total.toLocaleString());
    $("#total_harga").val(total);
  }
});
</script>
<?= $this->endSection() ?>