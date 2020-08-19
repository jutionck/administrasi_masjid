<?php
$a = !empty($_GET['page']) ? $_GET['page'] : "reset";
$b = !empty($_GET['b']) ? $_GET['b'] : "reset";
$sodaqoh = !empty($_GET['sodaqoh']) ? $_GET['sodaqoh'] : " ";
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
                    Data Penerimaan Dana Pembangunan
                </h2>
                <br>
                    <button <?php if ($_SESSION['level'] == 'ADMIN') {
                            echo "class='hidden'";
                        } ?> type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#myModal">Tambah Data</button>
            </div>
            
            <div class="body">
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Tanggal</th>
                                <th <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Nominal</th>
                                <th <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Keterangan</th>
                                <th <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Donatur</th>
                                <th>Petugas</th>
                                <th <?php if ($_SESSION['level'] !== 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Masjid</th>
                                <th <?php if ($_SESSION['level'] !== 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Total Penerimaan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Tanggal</th>
                                <th <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Nominal</th>
                                <th <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Keterangan</th>
                                <th <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Donatur</th>
                                <th>Petugas</th>
                                <th <?php if ($_SESSION['level'] !== 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Masjid</th>
                                <th <?php if ($_SESSION['level'] !== 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Total Penerimaan</th>
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
                                <td <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>><?php echo $t['tanggal']; ?></td>
                                <td <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Rp. <?php echo number_format($t['nominal'],2,',','.');?></td>
                                <td <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>><?php echo $t['keterangan']; ?></td>
                                <td <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>><?php echo $t['nama_donatur']; ?></td>
                                <td><?php echo $t['nama_petugas']; ?></td>
                                <td  <?php if ($_SESSION['level'] !== 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>><?php echo $t['nama_masjid']; ?></td>
                                <td <?php if ($_SESSION['level'] !== 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?>>Rp. <?php echo number_format($t['TotalPenerimaan'],2,',','.');?></td>
                                <td>
                                    <a <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?> href="?page=Shodaqoh&b=edit&sodaqoh=<?php echo $t['id_sodaqoh']; ?>" class="btn btn-success btn-circle waves-effect waves-circle waves-float" title="Edit"> <i class="fa fa-edit"> </i> </a>
                                    <button <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?> class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Hapus" data-toggle="modal" data-target="#myModalh<?php echo $t['id_sodaqoh']; ?>"><i class="fa fa-trash"></i></button>
                                        <a <?php if ($_SESSION['level'] !== 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?> href="#" class="btn btn-success waves-effect" title="Detail"> DETAIL </a>
                                </td>
                            </tr>
<!-- Modal Hapus-->
<div class="modal fade text-xs-left" id="myModalh<?php echo $t['id_sodaqoh']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <label class="modal-title text-text-bold-600" id="myModalLabel33">Hapus Data Penerimaan Dana Pembangunan </label>
      </div>
      <form action="?page=Shodaqoh" method="post">
          <input type="hidden" name="sql" value="delete">
          <input type="hidden" name="idsodaqoh" value="<?php echo $t['id_sodaqoh']; ?>">
          <div class="modal-body">
              <h5><i class="icon-android-delete"></i> Konfirmasi Penghapusan Data </h5>
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
        <label class="modal-title text-text-bold-600" id="myModalLabel33">Penambahan Data Penerimaan Dana Pembangunan </label>
      </div>
      <form action="?page=Shodaqoh" method="post">
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
                <div class="form-group form-float">
                    <div class="form-line">
                        <p><b>Donatur</b></p>
                        <select class="form-control show-tick" name="donatur" data-live-search="true">
                            <?php
                                global $kdb;
                                $sql = "SELECT * FROM `m_donatur` where `publish`='T' and `id_masjid`= ".$_SESSION['id_masjid'];
                                $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                                    while ($baris = mysqli_fetch_array($hasil)) {
                                        $value = $baris['id_donatur'];
                                        $caption = $baris['nama_donatur'];
                                        if (@$row['id_donatur'] == $baris['id_donatur'])
                                            {
                                                $selstr = "selected";
                                            }else{
                                                $selstr = "";
                                            }
                                ?>                        
                        <option value="<?php echo $value ?>" <?php echo $selstr ?>>
                                     &nbsp; <?php echo $caption; ?> &nbsp;
                        </option>
                                    <?php
                                        }//Penutup While Select
                                    ?>
                        </select>
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
                Perubahan Data Penerimaan Dana Pembangunan
                <div class="body">
                    <form action="?page=Shodaqoh" method="post">
          <input type="hidden" name="sql" value="update">
          <input type="hidden" name="idsodaqoh" value="<?php echo $baris['id_sodaqoh']; ?>">
          <input type="hidden" name="petugas" value="<?php echo "".$_SESSION['id_petugas']; ?>">
          <input type="hidden" name="publish" value="T">
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
                <div class="form-group form-float">
                    <div class="form-line">
                        <p><b>Donatur</b></p>
                        <select class="form-control show-tick" name="donatur" data-live-search="true">
                            <?php
                                global $kdb;
                                $sql = "SELECT * FROM `m_donatur` where `publish`='T' and `id_masjid`= ".$_SESSION['id_masjid'];
                                $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                                    while ($baris = mysqli_fetch_array($hasil)) {
                                        $value = $baris['id_donatur'];
                                        $caption = $baris['nama_donatur'];
                                        if (@$row['id_donatur'] == $baris['id_donatur'])
                                            {
                                                $selstr = "selected";
                                            }else{
                                                $selstr = "";
                                            }
                                ?>                        
                        <option value="<?php echo $value ?>" <?php echo $selstr ?>>
                                     &nbsp; <?php echo $caption; ?> &nbsp;
                        </option>
                                    <?php
                                        }//Penutup While Select
                                    ?>
                        </select>
                    </div>
                </div>
            </div><!--Modal Body-->
        <div class="modal-footer">
        <input type="submit" class="btn btn-primary active waves-effect" data-type="success" value="Simpan" name="enter">
        <a href="?page=Shodaqoh" class="btn btn-danger active"> Kembali </a>
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
        if ($_SESSION['level'] == 'USER') {
            $sql = "SELECT a.*,b.*,c.`nama_donatur` FROM `tr_sodaqoh` as a, `m_petugas` as b, `m_donatur` as c where a.`id_petugas`=b.`id_petugas` and a.`id_donatur`=c.`id_donatur` and b.`id_masjid`=".$_SESSION['id_masjid'];
        }
        else {
            $sql = "SELECT a.*, b.*, c.`nama_masjid`, SUM(a.nominal) as TotalPenerimaan FROM `tr_sodaqoh` as a, `m_petugas` as b, `m_masjid` as c where a.`id_petugas`=b.`id_petugas` and  b.`id_masjid`=c.`id_masjid` GROUP BY c.nama_masjid";
        }
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
        return $hasil;
    }

function sql_insert() //Untuk Insert Data
    {
        global $kdb;
        $sql = "INSERT INTO `tr_sodaqoh`(`tanggal`,`nominal`,`keterangan`,`id_donatur`,`id_petugas`,`publish`) VALUES ('".$_POST['tanggal']."','".$_POST['nominal']."','".$_POST['keterangan']."','".$_POST['donatur']."','".$_POST['petugas']."','".$_POST['publish']."')";
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
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
        $sql = "UPDATE `tr_sodaqoh` SET `tanggal` = '".$_POST['tanggal']."',`nominal` = '".$_POST['nominal']."',`keterangan` = '".$_POST['keterangan']."',`id_donatur` = '".$_POST['donatur']."', `id_petugas` = '".$_POST['petugas']."', `publish` = '".$_POST['publish']."' where `id_sodaqoh` = '".$_POST['idsodaqoh']."'";
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
        $sql = "DELETE FROM `tr_sodaqoh` WHERE `id_sodaqoh` = '".$_POST["idsodaqoh"]."'";
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
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
        global $sodaqoh;
        $sql = "SELECT * FROM `tr_sodaqoh` where `id_sodaqoh` = '$sodaqoh'";
        $hasil2 = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
        return $hasil2;

    }
?>