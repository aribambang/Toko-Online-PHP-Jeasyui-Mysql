<?php
  include("../includes/db.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Insert Product</title>
    <link rel="stylesheet" type="text/css" href="../jquery-easyui-1.5.2/themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="../jquery-easyui-1.5.2/themes/icon.css">
    <script type="text/javascript" src="../jquery-easyui-1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="../jquery-easyui-1.5.2/jquery.easyui.min.js"></script>
    <script src="../js/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
  </head>
  <body>



    <form id="ff" action="insert_produk.php" method="post" enctype="multipart/form-data">
      <table width="700" align="center" border="1">
        <tr>
          <td colspan="2"><center><h2>Input Produk Baru:</h2></center></td>
        </tr>
        <tr>
          <td>Nama Produk : </td>
          <td><input class="easyui-textbox" type="text" name="nmproduk" value=""></td>
        </tr>

        <tr>
          <td>Kategori : </td>
          <td>
            <select class="easyui-combobox" name="kategori">
              <option>Pilih Kategori</option>
              <?php

              $get_cats = "select * from kategori";

              $run_cats = mysqli_query($con, $get_cats);

              while ($row_cats=mysqli_fetch_array($run_cats)){

                $cat_id = $row_cats['kdkategori'];
                $cat_title = $row_cats['nmkategori'];

                echo "<option value='$cat_id'>$cat_title</option>";

              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Harga : </td>
          <td><input class="easyui-numberbox" type="text" name="harga" value=""></td>
        </tr>

        <tr height="60px">
          <td>Deskripsi : </td>
          <td ><input class="easyui-textbox" type="text" name="deskripsi" value="" style="height=60px;"></td>
        </tr>

        <tr>
          <td>Keyword : </td>
          <td><input class="easyui-textbox" type="text" name="keyword" value="" height="60"></td>
        </tr>
        <tr>
          <td colspan="2">
            <center>
            <input class="easyui-linkbutton" type="submit" name="insert_produk" value="Submit" style="width:80px"></input>
            <input class="easyui-linkbutton" type="reset" value="Reset" style="width:80px" click="clearForm()"></input>
          </center>
        </tr>
      </table>
    </form>
  </body>
</html>

<?php
  if(isset($_POST['insert_produk'])){
    $nmproduk = $_POST['nmproduk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $status = 'on';
    $keyword = $_POST['keyword'];

    if($nmproduk=='' OR $kategori=='' OR $harga=='' OR $deskripsi=='' OR $keyword==''){
      echo "<script>alert('Masukkan semua field!')</script>";
      exit();
    }
    else{
      $insert_produk = "insert into products (nmproduk,kdkategori,harga,deskripsi,status) values ('$nmproduk','$kategori','$harga','$deskripsi','$status')";
      $run_produk = mysqli_query($con,$insert_produk);

      if($run_produk){
        echo "<script>alert('Produk berhasil di input')</script>";
      }

    }

  }

 ?>
