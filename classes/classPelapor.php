<?php
    use Connection\Connect;
    require_once "../construct.php";

class Pelapor extends Connect{
    
    public function readKPelapor(){
        $conn = $this->getConnection();
        $query = "SELECT * FROM pelapor ORDER BY id_pelapor DESC";
        $result = $conn->query($query);
        $pelapor = $result->fetchAll();
        return $pelapor;
        }


    public function addPelapor($data){
        $conn = $this->getConnection();
        $nama_pelapor = $data['nama_pelapor'];
        $bagian_pelapor = $data['bagian_pelapor'];
        $jabatan_pelapor = $data['jabatan_pelapor'];
        $query = "INSERT INTO pelapor VALUES 
        (null,?,?,?)";
    
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(1,$nama_pelapor);
        $stmt->bindParam(2,$bagian_pelapor);
        $stmt->bindParam(3,$jabatan_pelapor);
        $stmt->execute();
        return true;
    }


    public function deletePelapor($id_pelapor){
        $conn = $this->getConnection();
        $query = "DELETE FROM pelapor WHERE id_pelapor = $id_pelapor";
    $rowsAffected = $conn->exec($query);
    if($rowsAffected !== false){
      echo "<script>
      alert('data berhasil dihapus');
      document.location.href = '../pelapor/index.php';
        </script>";
        }else{
        echo "  <script>
      alert('data gagal dihapus');
      document.location.href = '../pelapor/';
      </script>";
    }
}

    public function viewPelapor($id_pelapor){
        $conn = $this->getConnection();
        $query = "SELECT * FROM pelapor WHERE id_pelapor = $id_pelapor";
        $result = $conn->query($query);
        $pelapor = $result->fetch();
        return $pelapor;
    }

 public function editPelapor($data){
        $conn = $this->getConnection();
        $nama_pelapor = $data['nama_pelapor'];
        $jabatan_pelapor = $data['jabatan_pelapor'];
        $id_pelapor = $data['id_pelapor'];
        $bagian_pelapor = $data['bagian_pelapor'];
        $query = "UPDATE pelapor SET
        nama_pelapor = ?,
        jabatan_pelapor = ?,
        bagian_pelapor = ?
        WHERE id_pelapor = ?
        ";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(1,$nama_pelapor);
                $stmt->bindParam(2,$jabatan_pelapor);
                $stmt->bindParam(3,$bagian_pelapor);
                $stmt->bindParam(4,$id_pelapor);
                $stmt->execute();
                return true;
    }

}

?>