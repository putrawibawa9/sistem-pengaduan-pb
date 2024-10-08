<?php
session_start();
use Connection\Connect;

require_once "./construct.php";
class Auth extends Connection\Connect{
    public $error =false;
    public $row;

public function register($data){
   $conn = $this->getConnection();
    $gambar = $this->uploadGambar();
        if (!$gambar) {
            return false;
        }
        $nama_admin = $data['nama_admin'];
        $username_admin = $data['username_admin'];
        $password_admin = $data['password_admin'];
        $jabatan_admin = $data['jabatan_admin'];
        $gambar_admin = $gambar;

        $query = "INSERT INTO admin VALUES 
        (null,?,?,?,?,?)";
    
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(1,$nama_admin);
        $stmt->bindParam(2,$username_admin);
        $stmt->bindParam(3,$password_admin);
        $stmt->bindParam(4,$jabatan_admin);
        $stmt->bindParam(5,$gambar_admin);
        $stmt->execute();
        return true;
}

 public function uploadGambar(){
    $fileLocation = $_SERVER['DOCUMENT_ROOT'] . '/sistempengaduan/img/';

        $namaFile = $_FILES['gambar_admin']['name'];
        $ukuranFile =  $_FILES['gambar_admin']['size'];
        $error =  $_FILES['gambar_admin']['error'];  
        $tmp =  $_FILES['gambar_admin']['tmp_name'];  
      
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
       move_uploaded_file($tmp,  $fileLocation . $namaFileBaru);


      
        return $namaFileBaru;
    }
    
public function login ($username, $password){

    $connection = $this->getConnection();

    $query = "SELECT * FROM admin WHERE username_admin = ? AND password_admin = ?";
    $result = $connection->prepare($query);
    $result->execute([$username, $password]);
    if($this->row = $result->fetch()){
        $_SESSION['nama_admin'] = $this->row['nama_admin'];
        $_SESSION['gambar_admin'] = $this->row['gambar_admin'];
        $_SESSION['id_admin'] = $this->row['id_admin'];  
        header("Location: pengaduan/pengaduan.php");
    }else{
        $this->error = True;
        header("Location: index.php?error=1");
        exit();
    };
   
    }

public function logout(){
    session_destroy();
    header("Location: first.html");
    exit;
}
}
?>