<?php
namespace Produk{
    use Connection\Connect;
    require_once "../construct.php";
    

class Pengaduan extends Connect{
    
    public function readPengaduan(){
        $conn = $this->getConnection();
        $query = "SELECT * FROM pengaduan JOIN pelapor ON pengaduan.id_pelapor = pelapor.id_pelapor JOIN status ON pengaduan.id_pengaduan = status.id_pengaduan ORDER BY CASE WHEN status.status = 'belum dikonfirmasi' THEN 1 ELSE 2 END";  
        $result = $conn->query($query);
        $burger = $result->fetchAll();
        return $burger;
        }

        function pengaduanTerakhir(){
            $conn = $this->getConnection();
            $query ="SELECT MAX(id_pengaduan) FROM pengaduan;";
            $result = $conn->query($query);
            $hasil = $result->fetch();
            return $hasil[0] + 1;
        }

        function pelaporTerakhir(){
            $conn = $this->getConnection();
            $query ="SELECT MAX(id_pelapor) FROM pelapor;";
            $result = $conn->query($query);
            $hasil = $result->fetch();
            return $hasil[0] + 1;
        }


    public function addPengaduan($data){
        $conn = $this->getConnection();
        $id_pelapor = $data['id_pelapor'];
        $barang_pengaduan = $data['barang_pengaduan'];
        $deskripsi_pengaduan = $data['deskripsi_pengaduan'];
        $tanggal_pengaduan = $data['tanggal_pengaduan'];
        $nama_pelapor = $data['nama_pelapor'];
        $jabatan_pelapor = $data['jabatan_pelapor'];
        $bagian_pelapor = $data['bagian_pelapor'];
        $id_pengaduan =$this->pengaduanTerakhir();
        $status = "Belum Dikonfirmasi";

        
        $query = "INSERT INTO pengaduan VALUES 
        (null,?,?,?,?)";   
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1,$id_pelapor);
        $stmt->bindParam(2,$barang_pengaduan);
        $stmt->bindParam(3,$deskripsi_pengaduan);
        $stmt->bindParam(4,$tanggal_pengaduan);
        $stmt->execute();

        $query2 = "INSERT INTO status VALUES 
        (null,?,null,?)"; 
        $stmt2 = $conn->prepare($query2);
        $stmt2->bindParam(1,$status);
        $stmt2->bindParam(2,$id_pengaduan);
        $stmt2->execute();

        return true;
    }

    public function konfirmasiPengaduan($id_pengaduan){
        session_start();
        $conn = $this->getConnection();
        $status = 'Dikonfirmasi';
        $id_admin = $_SESSION['id_admin'];
        $query = "UPDATE status SET status = ?, id_admin = ? WHERE id_pengaduan = ?";
       
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(1,$status);
        $stmt->bindParam(2,$id_admin);
        $stmt->bindParam(3,$id_pengaduan);
        $stmt->execute();
        return true;
    }


    public function editProduk($data){
        $conn = $this->getConnection();
        $nama_produk = $data['nama_produk'];
        $keterangan_produk = $data['keterangan_produk'];
        $id_produk = $data['id_produk'];
        $gambarLama = $data['gambarLama'];
        $id_kategori = $data['id_kategori'];
        $harga_produk = $data['harga_produk'];
        $stok_produk = $data['stok_produk'];

          //check whether user pick a new image or not
        if($_FILES['gambar']['error']===4){
            $gambar = $gambarLama;
        }else{
            $gambar = $this->uploadGambar();
        }
        $query = "UPDATE produk SET
        nama_produk = ?,
        keterangan_produk = ?,
        gambar = ?,
        id_kategori = ?,
        harga_produk = ?,
        stok_produk = ?
        WHERE id_produk = ?
        ";
             $stmt = $conn->prepare($query);
                $stmt->bindParam(1,$nama_produk);
                $stmt->bindParam(2,$keterangan_produk);
                $stmt->bindParam(3,$gambar);
                $stmt->bindParam(4,$id_kategori);
                $stmt->bindParam(5,$harga_produk);
                $stmt->bindParam(6,$stok_produk);
                $stmt->bindParam(7,$id_produk);
                $stmt->execute();
                return true;
    }


    public function uploadGambar(){
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile =  $_FILES['gambar']['size'];
        $error =  $_FILES['gambar']['error'];  
        $tmp =  $_FILES['gambar']['tmp_name'];  
      
        //cek apakah user sudah menambah gambar
      
        if($error ===4){
          echo "<script>
              alert ('Silahkan pilih gambar');
                </script>";
                return false;
        }
      
        //cek apakah yang diupload adalah gambar
        $ekstensiGambarValid =['jpg','jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile); 
        $ekstensiGambar = strtolower(end($ekstensiGambar)); 
        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
          echo "<script>
              alert ('format gambar salah!');
                </script>";
                return false;
        }
      
        //cek jika ukurannya terlalu besar
        if ($ukuranFile > 1000000){
          echo "<script>
              alert ('Ukuran terlalu besar');
                </script>";
        }
      
        //generate nama file random
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
      
      
        //lolos semua hasil cek, lalu dijalankan
        move_uploaded_file($tmp, '../img/'.$namaFileBaru);
      
        return $namaFileBaru;
    }


    public function deleteProduk($id_produk){
        $conn = $this->getConnection();
        $query = "DELETE FROM produk WHERE id_produk = $id_produk";
        $result = $conn->exec($query);
        return $result;
}


}
}
?>