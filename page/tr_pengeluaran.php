<?php
$a = !empty($_GET['page']) ? $_GET['page'] : "reset";
$b = !empty($_GET['b']) ? $_GET['b'] : "reset";
$pengeluaran = !empty($_GET['pengeluaran']) ? $_GET['pengeluaran'] : " ";
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
<div class="row clearfix js-sweetalert">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Riwayat Pengeluaran
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
                                <th>Jenis Pengeluaran</th>
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
                                <th>Jenis Pengeluaran</th>
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
                                <td><?php echo $t['jenis_pengeluaran']; ?></td>
                                <td><?php echo $t['tanggal']; ?></td>
                                <td>Rp. <?php echo number_format($t['nominal'],2,',','.');?></td>
                                <td><?php echo $t['keterangan']; ?></td>
                                <td><?php echo $t['nama_petugas']; ?></td>
                                <td>
                                    <a href="?page=Pengeluaran&b=edit&pengeluaran=<?php echo $t['id_pengeluaran']; ?>" class="btn btn-success btn-circle waves-effect waves-circle waves-float" title="Edit"> <i class="fa fa-edit"> </i> </a>
                                    <button class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Hapus" data-toggle="modal" data-target="#myModalh<?php echo $t['id_pengeluaran']; ?>"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
<!-- Modal Hapus-->
<div class="modal fade text-xs-left" id="myModalh<?php echo $t['id_pengeluaran']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <label class="modal-title text-text-bold-600" id="myModalLabel33">Hapus Data Riwayat Pengeluaran </label>
      </div>
      <form action="?page=Pengeluaran" method="post">
          <input type="hidden" name="sql" value="delete">
          <input type="hidden" name="idpengeluaran" value="<?php echo $t['id_pengeluaran']; ?>">
          <div class="modal-body">
              <h5><i class="icon-android-delete"></i> Konfirmasi Penghapusan Data Infaq</h5>
              <p>Apakah Anda Yakin Akan Menghapus Riwayat Pengeluaran tanggal <b><?php echo $t['tanggal']; ?>.? </b> dengan besaran nominal <b>Rp. <?php echo number_format($t['nominal'],2,',','.');?> </b></p>
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
        <label class="modal-title text-text-bold-600" id="myModalLabel33">Penambahan Data Pengeluaran </label>
      </div>
      <br>
      <form action="?page=Pengeluaran" method="post">
          <input type="hidden" name="sql" value="insert">
          <input type="hidden" name="petugas" value="<?php echo "".$_SESSION['id_petugas']; ?>">
          <!-- <input type="hidden" name="publish" value="T"> -->
            <div class="modal-body">    
                <div class="form-group form-float">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="input-group date" id="bs_datepicker_component_container">
                                    <div class="form-line">
                                        <input type="text" name="tanggal" class="form-control" placeholder="Masukan Taggal">
                                    </div>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>    
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-line">
                                <input type="number" class="form-control" name="nominal" value="" required>
                                <label class="form-label">Nominal</label>
                            </div>
                        </div>
                    </div>    
                </div>

                <div class="form-group form-float">
                            <input type="radio" id="radio_37" class="with-gap radio-col-blue" checked name="pengeluaran" value="PEMBANGUNAN">
                            <label for="radio_37">PEMBANGUNAN</label>

                            <input type="radio" id="radio_38" class="with-gap radio-col-light-blue" name="pengeluaran" value="OPERASIONAL">
                            <label for="radio_38">OPERASIONAL</label>

                            <input type="radio" id="radio_39" class="with-gap radio-col-light-blue" name="pengeluaran" value="ZAKAT INFAQ SHODAQOH">
                            <label for="radio_39">ZAKAT INFAQ SHODAQOH</label>
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
                Perubahan Data Pengeluaran
                <div class="body">
                    <form action="?page=Pengeluaran" method="post">
          <input type="hidden" name="sql" value="update">
          <input type="hidden" name="idpengeluaran" value="<?php echo $baris['id_pengeluaran']; ?>">
          <input type="hidden" name="publish" value="T">
          <input type="hidden" name="petugas" value="<?php echo "".$_SESSION['id_petugas']; ?>">
            <div class="modal-body">
                <div class="form-group form-float">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-line">
                                <input type="date" name="tanggal" class="form-control" placeholder="Masukan Taggal" value="<?php echo $baris['tanggal']; ?>">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <?php $jenis = str_replace('"', '"', trim($baris["jenis_pengeluaran"])); ?>
                            <input type="radio" id="radio_37" class="with-gap radio-col-light-blue" name="pengeluaran" value="PEMBANGUNAN" <?php if($jenis=='PEMBANGUNAN' || $jenis=='') { echo "checked=\"checked\"";} else {echo ""; } ?> >
                            <label for="radio_37">PEMBANGUNAN</label>

                            <?php $jenis = str_replace('"', '"', trim($baris["jenis_pengeluaran"])); ?>
                            <input type="radio" id="radio_38" class="with-gap radio-col-light-blue" name="pengeluaran" value="OPERASIONAL" <?php if($jenis=='OPERASIONAL' || $jenis=='') { echo "checked=\"checked\"";} else {echo ""; } ?> >
                            <label for="radio_38">OPERASIONAL</label>

                            <?php $jenis = str_replace('"', '"', trim($baris["jenis_pengeluaran"])); ?>
                            <input type="radio" id="radio_39" class="with-gap radio-col-light-blue" name="pengeluaran" value="ZAKAT INFAQ SHODAQOH" <?php if($jenis=='ZAKAT INFAQ SHODAQOH' || $jenis=='') { echo "checked=\"checked\"";} else {echo ""; } ?> >
                            <label for="radio_39">ZAKAT INFAQ SHODAQOH</label>
                        </div>
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
        <a href="?page=Pengeluaran" class="btn btn-danger active"> Kembali </a>
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
        $sql = "SELECT a.*,b.* FROM `tr_pengeluaran` as a, `m_petugas` as b WHERE a.`id_petugas`=b.`id_petugas` and b.`id_masjid`=".$_SESSION['id_masjid'];
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        return $hasil;
    }


function sql_insert() //Untuk Insert Data
    {
        global $kdb;
        $sql = "INSERT INTO `tr_pengeluaran`(`jenis_pengeluaran`,`tanggal`,`nominal`,`keterangan`,`id_petugas`) VALUES ('".$_POST['pengeluaran']."','".$_POST['tanggal']."', '".$_POST['nominal']."','".$_POST['keterangan']."','".$_POST['petugas']."')";
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        //Peringatan
        if ($hasil){
        echo "<script>alert('Penambahan Data Berhasil !');</script>";
        }
        return $hasil;
    }

function sql_update()
    {
        global $kdb;
        $sql = "UPDATE `tr_pengeluaran` SET `jenis_pengeluaran` = '".$_POST['pengeluaran']."', `tanggal` = '".$_POST['tanggal']."', `nominal` = '".$_POST['nominal']."', `keterangan` = '".$_POST['keterangan']."', `id_petugas` = '".$_POST['petugas']."' where `id_pengeluaran` = '".$_POST['idpengeluaran']."'";
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
            $sql = "DELETE FROM `tr_pengeluaran` WHERE `id_pengeluaran` = '".$_POST["idpengeluaran"]."'";
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
        global $pengeluaran;
        $sql = "SELECT * FROM `tr_pengeluaran` where `id_pengeluaran` = '$pengeluaran'";
        $hasil2 = mysqli_query($kdb, $sql) or die(mysqli_error());
        return $hasil2;

    }
?>