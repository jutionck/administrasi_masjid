<?php
$a = !empty($_GET['page']) ? $_GET['page'] : "reset";
$b = !empty($_GET['b']) ? $_GET['b'] : "reset";
$zakat = !empty($_GET['zakat']) ? $_GET['zakat'] : " ";
?>

<?php
$kdb = koneksidatabase();
$a = @$_GET["page"];
$sql = @$_POST["sql"];

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
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Data Penerimaan Dana Zakat Infaq Shodaqoh
                </h2>
                <br>
                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#myModal">Tambah Data</button>
            </div>
            
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis ZIS</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Petugas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Jenis ZIS</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Petugas</th>
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
                                <td><?php echo $t['jenis_zis']; ?></td>
                                <td><?php echo $t['tanggal']; ?></td>
                                <td>Rp. <?php echo number_format($t['nominal'],2,',','.');?></td>
                                <td><?php echo $t['keterangan']; ?></td>
                                <td><?php echo $t['nama_petugas']; ?></td>
                                <td>
                                    <a href="?page=Zakat&b=edit&zakat=<?php echo $t['id_zis']; ?>" class="btn btn-success btn-circle waves-effect waves-circle waves-float" title="Edit"> <i class="fa fa-edit"> </i> </a>
                                    <button class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Hapus" data-toggle="modal" data-target="#myModalh<?php echo $t['id_zis']; ?>"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>

<!-- Modal Hapus-->
<div class="modal fade text-xs-left" id="myModalh<?php echo $t['id_zis']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <label class="modal-title text-text-bold-600" id="myModalLabel33">Hapus Data Penerimaan Zakat Infaq Shodaqoh </label>
      </div>
      <form action="?page=Zakat" method="post">
          <input type="hidden" name="sql" value="delete">
          <input type="hidden" name="idzis" value="<?php echo $t['id_zis']; ?>">
          <div class="modal-body">
              <h5><i class="icon-android-delete"></i> Konfirmasi Penghapusan Data Penerimaan Dana Zakat Infaq Shodaqoh </h5>
              <p>Apakah Anda Yakin Akan Menghapus Data tanggal <b><?php echo $t['tanggal']; ?>.? </b> dengan besaran nominal <b>Rp. <?php echo number_format($t['nominal'],2,',','.');?> </b></p>
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
        <label class="modal-title text-text-bold-600" id="myModalLabel33">Penambahan Data Dana Zakat Infaq Shodaqoh </label>
      </div>
      <form action="?page=Zakat" method="post">
          <input type="hidden" name="sql" value="insert">
          <input type="hidden" name="publish" value="T">
          <input type="hidden" name="petugas" value="<?php echo "".$_SESSION['id_petugas']; ?>">
            <div class="modal-body">
                <div class="form-group form-float">
                    <div class="input-group date" id="bs_datepicker_component_container">
                        <div class="form-line">
                            <input type="date" name="tanggal" class="form-control" placeholder="Masukan Taggal">
                        </div>
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>    
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="radio" id="radio_37" class="with-gap radio-col-light-blue" name="infaq" value="ZAKAT">
                        <label for="radio_37">ZAKAT</label>
                        <input type="radio" id="radio_38" class="with-gap radio-col-light-blue" name="infaq" value="INFAQ">
                        <label for="radio_38">INFAQ</label>
                        <input type="radio" id="radio_36" class="with-gap radio-col-light-blue" name="infaq" value="SHODAQOH">
                        <label for="radio_36">SHODAQOH</label>
                    </div>
                </div>    
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="number" class="form-control" name="nominal" value="" required>
                        <label class="form-label">Nominal</label>
                    </div>
                </div>

                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="keterangan" value="" required>
                        <label class="form-label">Keterangan</label>
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
                Perubahan Data Penerimaan Dana Zakat Infaq Shodaqoh
                <div class="body">
                    <form action="?page=Zakat" method="post">
          <input type="hidden" name="sql" value="update">
          <input type="hidden" name="idzis" value="<?php echo $baris['id_zis']; ?>">
          <input type="hidden" name="publish" value="T">
          <input type="hidden" name="petugas" value="<?php echo "".$_SESSION['id_petugas']; ?>">
            <div class="modal-body">
                <div class="form-group form-float">
                    <div class="input-group date" id="bs_datepicker_component_container">
                        <div class="form-line">
                            <input type="date" name="tanggal" class="form-control" placeholder="Masukan Taggal" value="<?php echo $baris['tanggal']; ?>">
                        </div>
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>    
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <?php $jenis = str_replace('"', '"', trim($baris["jenis_zis"])); ?>
                        <input type="radio" id="radio_37" class="with-gap radio-col-light-blue" name="infaq" value="ZAKAT" <?php if($jenis=='ZAKAT' || $jenis=='') { echo "checked=\"checked\"";} else {echo ""; } ?> >
                        <label for="radio_37">ZAKAT</label>
                        <input type="radio" id="radio_38" class="with-gap radio-col-light-blue" name="infaq" value="INFAQ" <?php if($jenis=='INFAQ' || $jenis=='') { echo "checked=\"checked\"";} else {echo ""; } ?>>
                        <label for="radio_38">INFAQ</label>
                        <input type="radio" id="radio_36" class="with-gap radio-col-light-blue" name="infaq" value="SHODAQOH" <?php if($jenis=='SHODAQOH' || $jenis=='') { echo "checked=\"checked\"";} else {echo ""; } ?> >
                        <label for="radio_36">SHODAQOH</label>
                    </div>
                </div>    
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="number" class="form-control" name="nominal" value="<?php echo $baris['nominal']; ?>" required>
                        <label class="form-label">Nominal</label>
                    </div>
                </div>

                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="keterangan" value="<?php echo $baris['keterangan']; ?>" required>
                        <label class="form-label">Keterangan</label>
                    </div>
                </div>       
            </div><!--Modal Body-->
        <div class="modal-footer">
        <input type="submit" class="btn btn-primary active waves-effect" data-type="success" value="Simpan" name="enter">
        <a href="?page=Zakat" class="btn btn-danger active"> Kembali </a>
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
        $sql = "SELECT a.*,b.* FROM `tr_zis` as a, `m_petugas` as b where a.`id_petugas`=b.`id_petugas` and b.`id_masjid`=".$_SESSION['id_masjid'];
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        return $hasil;
    }


function sql_insert() //Untuk Insert Data
    {
        global $kdb;
        $sql = "INSERT INTO `tr_zis`(`jenis_zis`,`tanggal`,`nominal`,`keterangan`,`id_petugas`,`publish`) VALUES ('".$_POST['infaq']."','".$_POST['tanggal']."','".$_POST['nominal']."','".$_POST['keterangan']."','".$_POST['petugas']."','".$_POST['publish']."')";
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        //Peringatan
        if ($hasil){
        echo "<script>alert('Penambahan Data Berhasil !');</script>";
        }
        else{
            echo "<script>alert('Data Gagal Di Simpan, Mohon Ulangi Lagi !'); </script>";
        }
        return $hasil;
    }
   
function sql_update()
    {
        global $kdb;
        $sql = "UPDATE `tr_zis` SET `jenis_zis` = '".$_POST['infaq']."', `tanggal` = '".$_POST['tanggal']."',`nominal` = '".$_POST['nominal']."',`keterangan` = '".$_POST['keterangan']."', `id_petugas` = '".$_POST['petugas']."', `publish` = '".$_POST['publish']."' where `id_zis` = '".$_POST['idzis']."'";
        $hasil = mysqli_query($kdb, $sql) or die (mysqli_error());

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
        $sql = "DELETE FROM `tr_zis` WHERE `id_zis` = '".$_POST["idzis"]."'";
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        if ($hasil) {
            echo "<script>alert('Data Berhasil Di Hapus !'); </script>";
        } else {
            echo "<script>alert('Data Gagal Di Hapus, Mungkin Sedang Ada Gangguan Pada Aplikasi Ini !'); </script>";            
        }
        return $hasil;
    }   

function sql_select_byid()
    {
        global $kdb;
        global $zakat;
        $sql = "SELECT * FROM `tr_zis` where `id_zis` = '$zakat'";
        $hasil2 = mysqli_query($kdb, $sql) or die(mysqli_error());
        return $hasil2;

    } 
?>