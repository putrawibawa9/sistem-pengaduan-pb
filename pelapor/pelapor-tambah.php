<?php 
    require_once '../layouts/header.php';
    require_once '../classes/classPelapor.php';

if(isset($_POST['submit'])){
    $add = new Pelapor;

    $result =$add->addPelapor($_POST);
    
    //check the progress
    if ($result){
        echo "
            <script>
            alert('data berhasil ditambah');
            document.location.href = 'index.php';
            </script>
        ";
    }else{
        echo " <script>
        alert('data gagal ditambah');
        document.location.href = 'pelapor-tambah.php';
        </script>
    ";
    }

}
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
      <h4 class="text-center">Tambah Pelapor</h4>
</div>
<div class="container">
  <div class="row">
    <div class="col-12 p-3 bg-white">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="text" name="nama_pelapor" class="form-control" required placeholder="Nama Pelapor">
            </div>
            <div class="mb-3">
                <input type="text" name="jabatan_pelapor" class="form-control" required placeholder="Jabatan Pelapor">
            </div>
            <div class="mb-3">
                <input type="text" name="bagian_pelapor" class="form-control" required placeholder="Bagian Pelapor">
            </div>
            <a href="index.php" class="btn btn-success" >Kembali</a>
            <button type="submit" class="btn btn-primary" name="submit" >Simpan</button>
        </form>
    </div>
  </div>
</div>


<!-- <?php require_once '../admin/footer.php';?> -->


<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.menu-binatang').addClass('active');
</script>