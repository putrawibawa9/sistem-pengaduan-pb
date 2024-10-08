<?php
session_start();
require_once '../classes/classPengaduan.php';  
require_once '../layouts/header.php'; 


$hasil = new Produk\Pengaduan;
$pengaduan = $hasil->readPengaduan();

?>
<div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-12 text-center">
        <img src="../img/logoPb.jpg" class="img-fluid" width="200px" alt="Logo Hanoman">
      </div>
    </div>
  </div>

<div class="container">
  <div class="row">
    <div class="col-12 p-3 bg-white">
      <h4 class="text-center">Data Pengaduan</h4>
      <p class="text-center">Selamat datang <span class="text-primary"><?=$_SESSION['nama_admin']  ?></span> </p>
      <img width="100" height="100" src="../img/<?=$_SESSION['gambar_admin']  ?>" alt="" class="mx-auto d-block">
    </div>
    </div>
    </div>

  
    
    <div class="container">
      <div class="row">
        <div class="col-12 p-3 bg-white">
          
          <table class="table table-bordered" id="pengaduanTable">
            <thead>
              <tr>
                <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Bagian</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Barang</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Tanggal Pengajuan</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Konfirmasi</th>
                  </tr>
            </thead>
            <tbody>
              <?php $i=1?>
              <?php foreach($pengaduan as $row):?>
                <tr>
                  <td><?=$i++ ?></td>
                  <td ><?=$row['nama_pelapor']?></td>
                  <td ><?=$row['bagian_pelapor']?></td>
                  <td ><?=$row['jabatan_pelapor']?></td>
                  <td ><?=$row['barang_pengaduan']?></td>
                  <td ><?=$row['deskripsi_pengaduan']?></td>
                  <td ><?=$row['tanggal_pengaduan']?></td>
                  <?php 
                  if((!isset($row['status'])) || $row['status'] == 'Belum Dikonfirmasi'){
                    $row['status'] = 'Belum Dikonfirmasi';
                  }else{
                    $row['status'] = 'Dikonfirmasi';
                  }
                  ?>
                  <td ><?=$row['status']?></td>
                  <td>
                    <?php 
                    if($row['status'] == 'Dikonfirmasi'){
                      echo "<a href='#' class='btn btn-secondary disabled'>Dikonfirmasi</a>";
                    }else{
                      echo "<a href='pengaduan-konfirmasi.php?id_pengaduan=".$row['id_pengaduan']."' class='btn btn-primary' onclick='return confirm('apakah yakin?')'>Konfirmasi</a>";
                    }
                    ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
        </table>
        <div>
          
          </div>
    </div>
  </div>
</div>



<?php require_once '../layouts/footer.php'; ?>
<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.menu-binatang').addClass('active');
</script>
 
