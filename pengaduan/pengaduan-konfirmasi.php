<?php

require_once '../classes/classPengaduan.php';

$konfirmasi = new Produk\Pengaduan;
$id_pengaduan = $_GET['id_pengaduan'];

if ($konfirmasi->konfirmasiPengaduan($id_pengaduan)){
    echo "<script>
            alert('Pengaduan Berhasil Dikonfirmasi');
            document.location.href = 'pengaduan.php';
      </script>";
}else{
  echo "  <script>
            alert('Pengaduan Berhasil Dikonfirmasi');
            document.location.href = 'pengaduan.php';
            </script>";
}


?>