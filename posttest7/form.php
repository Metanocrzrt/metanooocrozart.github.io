<link rel="stylesheet" href="crud.css">
<?php

  session_start();
  include('koneksi.php'); 

  if (!isset($_SESSION['login'])){
    header("Location:index.php");
  }
  
?>
<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
      * {
        font-family: "Roboto Mono";
      }
      h1 {
        text-transform: uppercase;
        color: salmon;
      }
    table {
      background-color: #FFFFFF;
      border: solid 1px #DDEEEE;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #DDEFEF;
        border: solid 1px #DDEEEE;
        color: #336B6B;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #DDEEEE;
        color: #333;
        padding: 10px;
        text-shadow: 1px 1px 1px #fff;
    }
    a {
          background-color: salmon;
          color: #fff;
          padding: 10px;
          text-decoration: none;
          font-size: 12px;
    }
    .logout{
        text-align:right;
        margin-left:830px;
    }
    
    </style>
  </head>
  <body>

  
    <center><h1>Data Sepatu</h1><center>
    <center><a href="tambah_sepatu.php">+ &nbsp; Tambah Sepatu</a><center>
    <br/>
    <form action="" method="get"><input type="text" name="cari" id="cari" placeholder="cari..."><button name="search">cari</button></form>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Sepatu</th>
          <th>Dekripsi</th>
          <th>Harga Beli</th>
          <th>Harga Jual</th>
          <th>Gambar</th>
          <th>Action</th>
          <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
  
      <?php
      
      $query = "SELECT * FROM sepatu ORDER BY id ASC";
      $result = mysqli_query($koneksi, $query);
      
      if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }
      if(isset($_GET['search'])){
        $keyword = $_GET['cari'];
        $result = mysqli_query($koneksi,"SELECT * FROM sepatu WHERE nama_sepatu LIKE'%$keyword%'");
      }else{
        $result = mysqli_query($koneksi,"SELECT * FROM sepatu");
      }

      
      $no = 1; 
      while($row = mysqli_fetch_assoc($result))
      {
    

      ?>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['nama_sepatu']; ?></td>
          <td><?php echo substr($row['deskripsi'], 0, 20); ?>...</td>
          <td>Rp <?php echo number_format($row['harga_beli'],0,',','.'); ?></td>
          <td>Rp <?php echo number_format($row['harga_jual'],0,',','.'); ?></td>
          <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_sepatu']; ?>" style="width: 120px;"></td>
          <td>
              <a href="edit_sepatu.php?id=<?php echo $row['id']; ?>">Edit</a> 
              <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
          </td>
          <td><?php echo date_default_timezone_set("Asia/Makassar"),$tanggal = date("Y-m-d H:i:s"); ?></td>
      </tr>
         
      <?php
        $no++; 
      }
      ?>
    </tbody>
    </table>
    <a href ="logout.php" class = "logout">Logout</a>
  </body>
</html>