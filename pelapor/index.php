<?php
session_start();
require_once '../classes/classPelapor.php'; 
require_once '../layouts/header.php'; 


$hasil = new Pelapor;
$pelapor = $hasil->readKPelapor();

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
      <h4 class="text-center">Data Pelapor</h4>
      <p class="text-center">Selamat datang <span class="text-primary"><?=$_SESSION['nama_admin']  ?></span> </p>
      <div class="text-center">
          <a class="btn btn-primary btn-sm" href="pelapor-tambah.php">Tambah Data Pelapor</a>
      </div>
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
                    <th class="text-center">Aksi</th>
                  </tr>
            </thead>
            <tbody>
              <?php $i=1?>
              <?php foreach($pelapor as $row):?>
                <tr>
                  <td><?=$i++ ?></td>
                  <td ><?=$row['nama_pelapor']?></td>
                  <td ><?=$row['bagian_pelapor']?></td>
                  <td ><?=$row['jabatan_pelapor']?></td>
                    <td class="text-center">
                        <a href="pelapor-edit.php?id_pelapor=<?=$row['id_pelapor']?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="pelapor-delete.php?id_pelapor=<?=$row['id_pelapor']?>" onclick="return confirm('yakin?');"  class="btn btn-danger btn-sm" >Hapus</a>
                  <?php endforeach; ?>
                  </td>
                </tr>
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
 
