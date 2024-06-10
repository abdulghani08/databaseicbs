<style>
  @page {
    size: 48mm 210mm;
    margin: 0;
  }

  body {
    font-family: monospace, sans-serif;
    font-size: 10pt;
  }

  ul {
    list-style: none;
    padding: 0;
    overflow-x: hidden;
  }

  .outer {
    width: 100%;  
  }

  .inner {
    padding-left: 20px;
  }

  li:not(.nested):before {
    float: left;
    width: 0;
    white-space: nowrap;
    content: "..........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................";
  }

  li span:first-child {
    padding-right: 0.33em;
    background: #FAFAFA;
  }

  span + span {
    float: right;
    padding-left: 0.33em;
    background: #FAFAFA;
  }

  @media print {
    .hilang-diprint {
      display: none;
    }
  }
</style>

<!-- <div class="container border border-dark my-2 p-4 px-5 mt-4"> dipakai kalau misal pake garis!--> 
<div>
  <div class="row justify-content-center">
    <div class="col-12 text-left">
    <center><img width="41%" class="rounded" src="<?= base_url(); ?>assets/img/img_properties/logo.png" alt="logo"></center>
<center style="font-size: 60pt;">
<strong>
      <?= $transaksi['nama_outlet']; ?>
</strong>
</center>
<b>
<center style="font-size: 35pt;">
      <?= $transaksi['alamat_outlet']; ?>
</center>
<b>
<center style="font-size: 35pt;">
      <?= $transaksi['telepon_outlet']; ?>
</center>
      
     
    </div>
  </div>

  <div class="mt-4" style="border: 1px black dashed"></div>

  <div class="row justify-content-center mt-3 mb-2">
    <div class="col text-center">
      <h4 style="font-size: 43pt;">KODE INVOICE. <?= $transaksi['kode_invoice']; ?></h4>
    </div>
  </div>

  <div style="border: 1px black dashed"></div>

  <div class="row my-4">
    <div class="col-6">
      <table border="0">
        <tr>
          <td style="font-size: 45pt;" class="font-weight-bold">Nama</td>
          <td class="px-2">:</td>
          <td style="font-size: 45pt;"><?= $transaksi['nama_member']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 45pt;" class="font-weight-bold">Telp.</td>
          <td class="px-2">:</td>
          <td style="font-size: 45pt;"><?= $transaksi['telepon_member']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 45pt;" class="font-weight-bold">Alamat</td>
          <td class="px-2">:</td>
          <td style="font-size: 45pt;"><?= $transaksi['alamat_member']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 45pt;" class="font-weight-bold">Tgl Masuk</td>
          <td class="px-2">:</td>
          <td style="font-size: 45pt;"><?= $transaksi['tanggal_transaksi']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 45pt;" class="font-weight-bold">Tgl Selesai</td>
          <td class="px-2">:</td>
          <td style="font-size: 45pt;"><?= $transaksi['batas_waktu']; ?></td>
        </tr>
        <tr>
          <td style="font-size: 45pt;" class="font-weight-bold">Status</td>
          <td class="px-2">:</td>
          <td><?php if ($transaksi['status_transaksi'] == 'proses'): ?>
              <span class="text-white btn-print btn btn-sm btn-danger"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php elseif ($transaksi['status_transaksi'] == 'dicuci'): ?>
              <span class="text-white btn-print btn btn-sm btn-warning"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php elseif ($transaksi['status_transaksi'] == 'siap diambil'): ?>
              <span class="text-white btn-print btn btn-sm btn-primary"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php elseif ($transaksi['status_transaksi'] == 'sudah diambil'): ?>
              <span class="text-white btn-print btn btn-sm btn-success"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php else: ?>
              <span class="text-white btn-print btn btn-sm btn-info"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php endif ?></td>
        </tr>
        <tr>
          <td style="min-width: 500px !important" class="font-weight-bold"></td>
          <td class="px-2"></td>      
        </tr>
      </table>
    </div>
  </div>

  <div style="border: 1px black dashed"></div>

  <div class="row mt-3">
    <div class="col">
      <h4 class="font-weight-bold" style="font-size: 45pt;">Detail Transaksi</h5>
      <ul>
        <?php foreach ($detail_transaksi as $dt) : ?>
          <li>
            <span style="font-size: 35pt;"><?= $dt['nama_paket']; ?></span>
            <span style="font-size: 35pt;">=<?= number_format($dt['harga_paket'] * $dt['kuantitas']); ?></span>
            <span style="font-size: 35pt;">xRp.<?= number_format($dt['harga_paket']); ?></span>
            <span style="font-size: 35pt;"><?= number_format($dt['kuantitas'], 1); ?>Kg</span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div style="border: 1px black dashed"></div>

  <div class="row mt-3">
    <div class="col">
      <h5 class="font-weight-bold" style="font-size: 40pt;">Ringkasan Pembayaran</h5>
      <table border="0">
      <tr>
          <td style="min-width: 500px !important" class="font-weight-bold"></td>
          <td class="px-2"></td>
        </tr>
        <tr>
          <td style="font-size: 40pt;" class="font-weight-bold">Uang Deposit</td>
          <td class="px-2">:</td>
          <td style="font-size: 45pt;">Rp <?= number_format($dt['biaya_tambahan']); ?></td>
        </tr>
        <tr>
          <td style="font-size: 40pt;" class="font-weight-bold">Diskon %</td>
          <td class="px-2">:</td>
          <td style="font-size: 45pt;"><?php $diskon = ($total_harga['total_harga'] + $dt['biaya_tambahan']) * $dt['diskon'] / 100; ?>
              <?= number_format($dt['diskon']); ?> (- <?= number_format($diskon); ?>)</td>
        </tr>
        <tr>
          <td style="font-size: 52pt;" class="font-weight-bold">Total Harga</td>
          <td class="px-2">:</td>
          <td><span class="font-weight-bold" style="font-size: 52pt;"><?= number_format($pembayaran['total_harga']); ?></td>
        </tr>
        <tr>
          <td style="font-size: 40pt;" class="font-weight-bold">Uang yang Dibayar</td>
          <td class="px-2">:</td>
          <td><span class="font-weight-bold" style="font-size: 45pt;"><?= number_format($pembayaran['uang_yg_dibayar']); ?></td>
        </tr>
        <tr>
          <td style="font-size: 40pt;" class="font-weight-bold">Kembalian</td>
          <td class="px-2">:</td>
          <td><span class="font-weight-bold" style="font-size: 45pt;"><?= number_format($pembayaran['kembalian']); ?></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="row justify-content-center mt-4">
    <div class="col text-center">
      <p class="font-weight-bold" style="font-size: 35pt;">Terima kasih atas kepercayaan anda</p>
    </div>
    
  </div>
</div>

<!-- Add your remaining HTML code or any closing tags below this line -->
