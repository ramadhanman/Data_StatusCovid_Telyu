<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "datacovidtelyu";

// koneksi ke database
$dbconnect = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

// aksi button simpan
if (isset($_POST['simpan'])) {

    if ($_GET['hal'] == "edit")
    {
        $nim = $_POST['nim_mhs'];
        $nama = $_POST['nama_mhs'];
        $fakultas = $_POST['fakultas_mhs'];
        $daerah = $_POST['asal_mhs'];
        $status = $_POST['status_mhs'];

        $edit = "UPDATE INTO mahasiswa
                    SET
                    ($nim', '$nama', '$fakultas', '$daerah', '$status')
                    WHERE idmhs = '$_GET[id]'
                ";

        mysqli_query($dbconnect, $edit);

        if($edit) {
            echo "<script>
                    alert('Data mahasiswa berhasil diedit');
                    document.location='index.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data mahasiswa gagal diedit!');
                    document.location='index.php';
                </script>";
        }

    } else if($_GET['hal'] == "hapus") {
        
        $hapus = mysqli_query($dbconnect, "DELETE FROM mahasiswa WHERE idmhs = '$_GET[id]'");
        if($hapus){
            echo "<script>
            alert('Data mahasiswa berhasil dihapus');
            document.location='index.php';
            </script>";
        } else {
            echo "<script>
            alert('Data mahasiswa gagal dihapus');
            document.location='index.php';
            </script>";
        }

    } else {
        $nim = $_POST['nim_mhs'];
        $nama = $_POST['nama_mhs'];
        $fakultas = $_POST['fakultas_mhs'];
        $daerah = $_POST['asal_mhs'];
        $status = $_POST['status_mhs'];

        $simpan = "INSERT INTO mahasiswa
                    VALUES 
                    ('', '$nim', '$nama', '$fakultas', '$daerah', '$status')
                ";

        mysqli_query($dbconnect, $simpan);

        if($simpan) {
            echo "<script>
                    alert('Data mahasiswa berhasil disimpan');
                    document.location='index.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data mahasiswa tidak tersimpan!');
                    document.location='index.php';
                </script>";
        }
    }
}
    
    

// Pengujian edit dan hapus
if(isset($_GET['hal'])) {
    //menampilkan data yang akan di edit
    if($_GET['hal'] == "edit") {
        $tampil = mysqli_query($dbconnect, "SELECT * FROM mahasiswa WHERE idmhs = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if($data) {
            $var_nim = $data['nim'];
            $var_nama = $data = ['nama'];
            $var_fakultas = $data = ['fakultas'];
            $var_daerah = $data = ['asal'];
            $var_status = $data = ['status'];
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="style.css">
      <!-- font -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
      <title>Aplikasi Pendataan Mahasiswa</title>
  </head>
  <body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-danger">
        <div class="container">
            <a class="navbar-brand" href="index.php">Status Covid-19</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
              <a class="nav-item nav-link active" href="#jumbotron">Home <span class="sr-only">(current)</span></a>
              <a class="nav-item nav-link" href="https://www.tokopedia.com/about/contact-us">Kontak</a>
            </div>
            </div>
        </div>
    </nav>  
    <!-- akhir navbar -->

    <!-- form pengisian -->
    <div class="container">
      <div class="card form">
        <div class="card-header bg-dark text-white">
          Masukkan Data Mahasiswa
        </div>
        <div class="card-body">
          <form method="post" action="">

            <!-- input NIM -->
            <div class="form-group">
              <label>NIM</label>
              <input type="text" name="nim_mhs" value="<?=@$var_nim?>" class="form-control" placeholder="Masukkan NIM" required>
            </div>
            <!-- akhir inputn NIM -->

            <!-- input nama -->
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama_mhs" value="<?=@$var_nama?>" class="form-control" placeholder="Masukkan nama" required>
            </div>
            <!-- akhir input nama -->

            <!-- pilih fakultas -->
            <div class="form-group">
                <label>Fakultas</label>
                <select class="form-control" name="fakultas_mhs" id="">
                    <option value="<?=@$var_fakultas?>"><?=@$var_fakultas?></option>
                    <option value="Fakultas Teknik Elektro">Fakultas Teknik Elektro</option>
                    <option value="Fakultas Informatika">Fakultas Informatika</option>
                    <option value="Fakultas Rekayasa Industri">Fakultas Rekayasa Industri</option>
                    <option value="Fakultas Ekonomi dan Bisnis">Fakultas Ekonomi dan Bisnis</option>
                    <option value="Fakultas Komunikasi dan Bisnis">Fakultas Komunikasi dan Bisnis</option>
                    <option value="Fakultas Industri Kreatif">Fakultas Industri Kreatif</option>
                    <option value="Fakultas Ilmu Terapan">Fakultas Ilmu Terapan</option>
                </select>
            </div>
            <!-- akhir pilih fakultas -->

            <!-- input asal daerah -->
            <div class="form-group">
              <label>Daerah Asal</label>
              <input type="text" name="asal_mhs" value="<?=@$var_daerah?>" class="form-control" placeholder="ex: Jakarta" required>
            </div>
            <!-- akhir input asal daerah -->

            <!-- pilih status covid -->
            <div class="form-group">
                <label>Status SARS-CoV-2 (Covid-19)</label>
                <select class="form-control" name="status_mhs" id="">
                    <option value="<?=@$var_status?>"><?=@$var_status?></option>
                    <option value="Positif">Positif</option>
                    <option value="Negatif">Negatif</option>
                    <option value="Belum Pernah Tes">Belum Pernah Tes</option>
                </select>
            </div>
            <!-- pilih akhir status covid -->

            <!-- button -->
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button type="reset" class="btn btn-warning" name="reset">Reset</button>
            <!-- akhir button -->

          </form>
        </div>
      </div>
      <!-- akhir form pengisian -->

      <!-- tabel -->
      <div class="card mt-3">
        <div class="card-header bg-info text-white">
          Data Mahasiswa Tersimpan
        </div>
        <div class="card-body">

          <table class="table table-border table-striped">
            <tr>
              <th>No.</th>
              <th>NIM</th>
              <th>Nama</th>
              <th>Fakultas</th>
              <th>Asal Daerah</th>
              <th>Status</th>
              <th>Ubah Data</th>
            </tr>
            <?php
              $no = 1;
              $showdata = mysqli_query($dbconnect, "SELECT * from mahasiswa order by idmhs desc");
              while($data = mysqli_fetch_array($showdata)) :
            ?>
            <tr>
              <td><?=$no++;?></td>
              <td><?=$data['nim']?></td>
              <td><?=$data['nama']?></td>
              <td><?=$data['fakultas']?></td>
              <td><?=$data['daerah']?></td>
              <td><?=$data['status']?></td>
              <td>
                <a href="index.php?hal=edit&id=<?=$data['idmhs']?>" class="btn btn-primary">
                    <img src="img/edit.png" width="16px" alt="">
                </a>
                <a href="index.php?hal=hapus&id=<?=$data['idmhs']?>" onclick="return confirm('Anda yakin akan menghapus data?')" class="btn btn-danger">
                    <img src="img/trash.png" width="16px" alt="">
                </a>
              </td>
            </tr>
            <?php endwhile; //penutup while ?>
          </table>
        </div>
      </div>
      <!-- akhir tabel -->
    </div>
    

    












    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>