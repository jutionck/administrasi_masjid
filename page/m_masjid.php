<?php
$a = !empty($_GET['page']) ? $_GET['page'] : "reset";
$b = !empty($_GET['b']) ? $_GET['b'] : "reset";
$masjid = !empty($_GET['masjid']) ? $_GET['masjid'] : " ";
?>

<?php
$kdb = koneksidatabase();
$a = @$_GET["page"];
$sql = @$_POST["sql"];
$upload 	= @$_POST["upload"];
switch ($upload)
{
	case "1" : upload(); break;
}
    switch ($sql) 
    {
        case "insert": sql_insert(); break; //Buat Input Type Hidden CURD CREATE
        case "update": sql_update(); break; //Buat Input Type Hidden CURD UPDATE
        case "delete": sql_delete(); break; //Buat Input Type Hidden CURD DELETE
    }

    switch ($b) 
    {
        case "reset" : curd_read(); break;
        case "edit" : curd_update(); break;
        default : curd_read(); break;
    }
mysqli_close($kdb);

function curd_read()
    {
       
?>
<!-- Exportable Table -->
<div class="row clearfix js-sweetalert">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Masjid
                </h2>
                <br>
                    <button <?php if ($_SESSION['level'] !== 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?> type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#myModal">Tambah Data</button>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Logo</th>
                                <th>Nama Masjid</th>
                                <th>Ketua</th>
                                <th>Sekretaris</th>
                                <th>Bendahara</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Logo</th>
                                <th>Nama Masjid</th>
                                <th>Ketua</th>
                                <th>Sekretaris</th>
                                <th>Bendahara</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
<?php
  global $kdb;
  $hasil = sql_select();
  $i=1;
  while ($t = mysqli_fetch_array($hasil))
  {  
?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="./images/<?php echo $t['foto']; ?>"</td>
                                <td><?php echo $t['nama_masjid']; ?></td>
                                <td><?php echo $t['ketua']; ?></td>
                                <td><?php echo $t['sekretaris']; ?></td>
                                <td><?php echo $t['bendahara']; ?></td>
                                <td><?php echo $t['alamat']; ?></td>
                                <td><?php echo $t['publish']; ?></td>
                                <td>
                                    <a href="?page=Masjid&b=edit&masjid=<?php echo $t['id_masjid']; ?>" class="btn btn-success btn-circle waves-effect waves-circle waves-float" title="Edit"> <i class="fa fa-edit"> </i> </a>
                                    <button <?php if ($_SESSION['level'] !== 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?> class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Hapus" data-toggle="modal" data-target="#myModalh<?php echo $t['id_masjid']; ?>"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
<!-- Modal Hapus-->
<div class="modal fade text-xs-left" id="myModalh<?php echo $t['id_masjid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <label class="modal-title text-text-bold-600" id="myModalLabel33">Hapus Data Masjid </label>
      </div>
      <form action="?page=Masjid" method="post">
          <input type="hidden" name="sql" value="delete">
          <input type="hidden" name="idmasjid" value="<?php echo $t['id_masjid']; ?>">
          <div class="modal-body">
              <h5><i class="icon-android-delete"></i> Konfirmasi Penghapusan Data Donatur</h5>
              <p>Apakah Anda Yakin Akan Menghapus Data Masjid <b><?php echo $t['nama_masjid']; ?>.? </b></p>
              <div class="alert alert-danger" role="alert">
                <span class="text-bold-600">Ingat!</span> Pastikan Data Petugas tidak ada nama Masjid <b> <?php echo $t['nama_masjid']; ?></b>.
              </div>
            
          </div><!--Modal Body-->
        <div class="modal-footer">
        <input type="submit" class="btn btn-primary active" value="Simpan">
        <input type="reset" class="btn btn-danger active" data-dismiss="modal" value="close">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Hapus-->
<?php
$i++;
}//WHILE
?>
                        </tbody>
                    </table>
                </div>


<!-- Modal Tambah-->
<div class="modal fade text-xs-left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <label class="modal-title text-text-bold-600" id="myModalLabel33">Penambahan Data Masjid </label>
      </div>
      <form action="?page=Masjid" method="post">
          <input type="hidden" name="sql" value="insert">
          <input type="hidden" name="publish" value="T">
            <div class="modal-body">
                <div class="form-group form-float">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-line">
                                <input type="text" class="form-control" name="nama" value="" required>
                                <label class="form-label">Nama Masjid</label>
                            </div>
                        </div>
                    </div>    
                </div>
            </div><!--Modal Body-->
        <div class="modal-footer">
        <input type="submit" class="btn btn-primary active waves-effect" data-type="success" value="Simpan" name="enter">
        <input type="reset" class="btn btn-danger active" data-dismiss="modal" value="close">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Tambah-->
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->
<?php
}//READ
?>

<?php
function curd_update()
    {
        global $kdb;
        global $toko;
        $hasil2 = sql_select_byid();
        $baris = mysqli_fetch_array($hasil2);

?>
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                Perubahan Data Masjid
                <div class="body">
                    <form action="?page=Masjid" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="sql" value="update">
                        <input type="hidden" name="idmasjid" value="<?php echo $baris['id_masjid']; ?>">
                        <input type = "hidden" name ="upload" value="1">
                        <div class="form-group form-float">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <img src="./images/<?php echo $baris['foto'];?>">
                                        <input type="file" class="form-control" name="foto" value="<?php echo $baris['foto']; ?>">
                                        <input type="hidden" name="foto" value="<?php echo $baris['foto']; ?>">
                                        <input name="x" type="hidden" id="x" value="<?php echo $baris['foto']; ?>"/>
                                    </div>
                                </div>
                            </div>    
                        </div> 
                        <div class="form-group form-float">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nama" value="<?php echo $baris['nama_masjid']; ?>" required>
                                        <label class="form-label">Nama Masjid</label>
                                    </div>
                                </div>
                            </div>    
                        </div> 
                        <div class="form-group form-float">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="ketua" value="<?php echo $baris['ketua']; ?>" required>
                                        <label class="form-label">Ketua</label>
                                    </div>
                                </div>
                            </div>    
                        </div> 
                        <div class="form-group form-float">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="sekretaris" value="<?php echo $baris['sekretaris']; ?>" required>
                                        <label class="form-label">Sekretaris</label>
                                    </div>
                                </div>
                            </div>    
                        </div> 
                        <div class="form-group form-float">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="bendahara" value="<?php echo $baris['bendahara']; ?>" required>
                                        <label class="form-label">Bendahara</label>
                                    </div>
                                </div>
                            </div>    
                        </div> 
                        <div class="form-group form-float">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="alamat" value="<?php echo $baris['alamat']; ?>" required>
                                        <label class="form-label">Alamat</label>
                                    </div>
                                </div>
                            </div>    
                        </div> 

                <div <?php if ($_SESSION['level'] !== 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?> class="form-group form-float">
                    <div class="form-line">
                        <?php $publish = str_replace('"', '"', trim($baris["publish"])); ?>
                            <input type="radio" id="radio_41" class="with-gap radio-col-blue" name="publish" value="T" <?php if($publish=='T' || $publish=='') { echo "checked=\"checked\"";} else {echo ""; } ?>
                            >
                            <label for="radio_41">Publikasikan</label>
                            
                            <input type="radio" id="radio_42" class="with-gap radio-col-light-blue" name="publish" value="F" <?php if($publish=='F' || $publish=='') { echo "checked=\"checked\"";} else {echo ""; } ?>
                                >
                            <label for="radio_42">Jangan Di Publikasikan</label>
                    </div>
                </div>

            </div><!--Modal Body-->
                <div class="modal-footer">
                <input type="submit" class="btn btn-primary active waves-effect" data-type="success" value="Simpan" name="enter">
                <a href="?page=Masjid" class="btn btn-danger active"> Kembali </a>
                </div>
        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    }
?>


<!--SQL QUERY-->
<?php
function koneksidatabase()
    {
        include('./koneksi/koneksi.php');
        return $kdb;
    }
function sql_select()
    {
        global $kdb;
        if ($_SESSION['level'] == 'ADMIN') {
            $sql = "SELECT * FROM `m_masjid`";
        }
        else {
            $sql = "SELECT * FROM `m_masjid` where id_masjid=".$_SESSION['id_masjid'];
        }
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
        return $hasil;
    }


function sql_insert() //Untuk Insert Data
    {
        global $kdb;
        $cek = "SELECT * FROM `m_masjid` WHERE `nama_masjid` = '".$_POST['nama']."'";
        $hasilcek = mysqli_query($kdb, $cek) or die(mysqli_error($kdb));
        $hasil2 = mysqli_fetch_array($hasilcek);
        if ($hasil2==""){
            $sql = "INSERT INTO `m_masjid`(`nama_masjid`,`publish`) VALUES ('".$_POST['nama']."','".$_POST['publish']."')";
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            //Peringatan
            if ($hasil){
            echo "<script>alert('Penambahan Data Berhasil !');</script>";
            }
            return $hasil;
        }
        else{
            echo "<script>alert('Nama Donatur Sudah ada, Mohon Ganti dengan Nama Donatur yang Baru !'); </script>";
        }
    }

function sql_update()
    {
        global $kdb;
        $x=$_POST['x'];
        $foto      =$_FILES['foto']['tmp_name'];
        $file_name = $_FILES["foto"]["name"];
        $tujuan_foto = $file_name;
        $tempat_foto = './images/'.$tujuan_foto;

        $ketua = addslashes($_POST['ketua']);
        $sekretaris = addslashes($_POST['sekretaris']);
        $bendahara = addslashes($_POST['bendahara']);
        $alamat = addslashes($_POST['alamat']);

        if (!$foto==""){
            $buat_foto=$tujuan_foto;
            $d = './images/'.$x;
            @unlink ("$d");
            @copy ($foto,$tempat_foto);
        }else{
            $buat_foto=$x;
        }


        $sql = "UPDATE `m_masjid` SET 
        `nama_masjid` = '".$_POST['nama']."',
        `ketua` = '".$ketua."',
        `sekretaris` = '".$sekretaris."',
        `bendahara` = '".$bendahara."',
        `alamat` = '".$alamat."',
        `foto` = '".$buat_foto."',
        `publish` = '".$_POST['publish']."' 
        where `id_masjid` = '".$_POST['idmasjid']."'";
        $hasil = mysqli_query($kdb, $sql) or die (mysqli_error($kdb));

        if ($hasil) {
            echo "<script>alert('Data Berhasil Di Perbaharui !'); </script>";
        } else {
            echo "<script>alert('Data Gagal Di Perbaharui, Mungkin Sedang Ada Gangguan Pada Aplikasi Ini !'); </script>";            
        }
        return $hasil;
    }
function sql_delete()
    {
        global $kdb;
        $cek = "SELECT * FROM `m_petugas` where `id_masjid` = '".$_POST["idmasjid"]."'";
        $hasilcek = mysqli_query($kdb, $cek) or die(mysqli_error($kdb));
        $hasil2 = mysqli_fetch_array($hasilcek);

        if($hasil2['id_masjid']==""){
            $sql = "DELETE FROM `m_masjid` WHERE `id_masjid` = '".$_POST["idmasjid"]."'";
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            if ($hasil) {
                echo "<script>alert('Data Berhasil Di Hapus !'); </script>";
            } else {
                echo "<script>alert('Data Gagal Di Hapus, Mungkin Sedang Ada Gangguan Pada Aplikasi Ini !'); </script>";            
            }
            return $hasil;
        }
        else
        {
            echo "<script>alert('Data Sedang Di Gunakan Mohon Jangan Di Hapus !'); </script>";
        }
        return $hasil2; 
    }

function sql_select_byid()
    {
        global $kdb;
        global $masjid;
        $sql = "SELECT * FROM `m_masjid` where `id_masjid` = '$masjid'";
        $hasil2 = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
        return $hasil2;

    }

function upload()
{
    if(isset($_POST["enter"]))  
 {  
 //ambil parameter-parameter file yang diupload:
 $file_name = $_FILES["foto"]["name"];  
 if (strlen($file_name)>0) {
 if (is_uploaded_file($_FILES['foto']['tmp_name'])) 
      {
        move_uploaded_file ($_FILES['foto']['tmp_name'], "./images/".$file_name);
        //echo "Berhasil Upload";
      }
    }
 } 
}
?>