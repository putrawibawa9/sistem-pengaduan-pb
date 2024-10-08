<?php 
    require_once '../layouts/header.php';
    require_once '../classes/classPelapor.php'; 

$id_pelapor = $_GET['id_pelapor'];

$viewPelapor = new Pelapor;

$pelapor =$viewPelapor->viewPelapor($id_pelapor);


if(isset($_POST['submit'])){
   $edit_pelapor = new Pelapor;
   

   if($edit_pelapor->editPelapor($_POST)){
    echo "<script>
            alert('data berhasil dirubah');
            document.location.href = 'index.php';
      </script>";
   }else{
     echo "  <script>
            alert('data gagal dirubah');
            document.location.href = 'index.php';
            </script>";
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
      <h4 class="text-center">Edit Pelapor</h4>
    </div>
    </div>
    </div>


<div class="container">
  <div class="row">
    <div class="col-12 p-3 bg-white">
        <form action="" method="post"`>  
        <input type="hidden" name="id_pelapor" value="<?= $id_pelapor ?>">
            <div class="mb-3">
                <input type="text" name="nama_pelapor" placeholder="Nama Pelapor" class="form-control" value ="<?= $pelapor['nama_pelapor']?> " required>
            </div>
            <div class="mb-3">
                <input type="text" name="jabatan_pelapor" placeholder="Jabatan Pelapor" class="form-control" value ="<?= $pelapor['jabatan_pelapor']?> " required>
            </div>
            <div class="mb-3">
                <input type="text" name="bagian_pelapor" placeholder="Bagian Pelapor" class="form-control" value ="<?= $pelapor['bagian_pelapor']?> " required>
            </div>
            <a href="index.php" class="btn btn-success" >Kembali</a>
            <button type="submit" class="btn btn-primary" name="submit" >Simpan</button>
        </form>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.menu-category').addClass('active');
</script>