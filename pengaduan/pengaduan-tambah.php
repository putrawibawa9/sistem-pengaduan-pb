<?php 
    require_once '../classes/classPengaduan.php';
    require_once '../classes/classPelapor.php';

    $result = new Pelapor;
    $data = $result->readKPelapor();


//check whether the button has been click or not
if(isset($_POST['submit'])){
    $add = new Produk\Pengaduan;

    $result =$add->addPengaduan($_POST);
    
    //check the progress
    if ($result){
        echo "
            <script>
            var userConfirmed = confirm('Apakah Ada Laporan Lain?');
        if (userConfirmed) {
            alert('Laporan Diajukan');
            document.location.href = 'pengaduan-tambah.php';
        } else {
            alert('Terimakasih Telah Melapor');
          document.location.href = '../first.html';
        }
            </script>
        ";
    }else{
        echo " <script>
        alert('data gagal ditambah');
        document.location.href = 'pengaduan-tambah.php';
        </script>
    ";

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
</head>
<body class="admin-body">

<div class="container bg-white">
    <div class="row">
        <div class="col-12">
        </div>
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
      <h4 class="text-center">Tambah Pengaduan</h4>
</div>
<div class="container">
  <div class="row">
    <div class="col-12 p-3 bg-white">
        <form method="post" enctype="multipart/form-data">
            <h4>Nama Pelapor</h4>
           <select name="id_pelapor" id="">
            <?php foreach($data as $pelapor): ?>
                <option value="<?= $pelapor['id_pelapor'] ?>"><?= $pelapor['nama_pelapor'] ?></option>
            <?php endforeach; ?>
           </select>
            <div class="mb-3">
                <input type="text" name="barang_pengaduan" class="form-control" required placeholder="Nama Barang">
            </div>


            <label class="form-label">Deskripsi</label>
            <div class="mb-3">
            <textarea class="form-control" name="deskripsi_pengaduan" rows="3"   required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Pengaduan</label>
                <input type="date" name="tanggal_pengaduan" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" >Lapor</button>
           <a href="../first.html" class="btn btn-success" >Kembali</a>
        </form>
    </div>
  </div>
</div>
<div class="col-12">
        </div>
    </div>
</div>
<script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <script>
        $(document).ready(function() {
            $('#pengaduanTable').DataTable();
        });
    </script>
</body>
</html>


<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.menu-binatang').addClass('active');
</script>