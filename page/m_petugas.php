<?php
$a = !empty($_GET['page']) ? $_GET['page'] : "reset";
$b = !empty($_GET['b']) ? $_GET['b'] : "reset";
$petugas = !empty($_GET['petugas']) ? $_GET['petugas'] : " ";
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
                            Data Petugas
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
                                        <th>Nama Petugas</th>
                                        <th>User</th>
                                        <th>Password</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No HP</th>
                                        <th>Masjid</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Petugas</th>
                                        <th>User</th>
                                        <th>Password</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No HP</th>
                                        <th>Masjid</th>
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
                                            <td><?php echo $t['nama_petugas']; ?></td>
                                            <td><?php echo $t['user']; ?></td>
                                            <td><?php echo $t['password']; ?></td>
                                            <td><?php echo $t['jenis_kelamin']; ?></td>
                                            <td><?php echo $t['no_hp']; ?></td>
                                            <td><?php echo $t['nama_masjid']; ?></td>
                                            <td><?php echo $t['publish']; ?></td>
                                            <td>
                                                <a href="?page=Petugas&b=edit&petugas=<?php echo $t['id_petugas']; ?>" class="btn btn-success btn-circle waves-effect waves-circle waves-float" title="Edit"> <i class="fa fa-edit"> </i> </a>
                                                <button class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Hapus" data-toggle="modal" data-target="#myModalh<?php echo $t['id_petugas']; ?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <!-- Modal Hapus-->
                                        <div class="modal fade text-xs-left" id="myModalh<?php echo $t['id_petugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                              <label class="modal-title text-text-bold-600" id="myModalLabel33">Hapus Data Petugas </label>
                                          </div>
                                          <form action="?page=Petugas" method="post">
                                              <input type="hidden" name="sql" value="delete">
                                              <input type="hidden" name="idpetugas" value="<?php echo $t['id_petugas']; ?>">
                                              <div class="modal-body">
                                                  <h5><i class="icon-android-delete"></i> Konfirmasi Penghapusan Data Petugas</h5>
                                                  <p>Apakah Anda Yakin Akan Menghapus Petugas <b><?php echo $t['nama_petugas']; ?>.? </b></p>
                                                  <div class="alert alert-danger" role="alert">
                                                    <span class="text-bold-600">Ingat!</span> Pastikan Data Penerimaan/Pengeluaran Kas tidak ada nama <b> <?php echo $t['nama_petugas']; ?></b>.
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
      <label class="modal-title text-text-bold-600" id="myModalLabel33">Penambahan Data Petugas </label>
  </div>
  <form action="?page=Petugas" method="post">
      <input type="hidden" name="sql" value="insert">
      <input type="hidden" name="publish" value="T">
      <div class="modal-body">
        <div class="form-group form-float">
            <div class="row">
                <div class="col-md-7">
                    <div class="form-line">
                        <input type="text" class="form-control" name="nama" value="" required>
                        <label class="form-label">Nama Petugas</label>
                    </div>
                </div>
                <div class="col-md-5">
                    <input type="radio" id="radio_37" class="with-gap radio-col-blue" checked name="kelamin" value="L">
                    <label for="radio_37">LAKI-LAKI</label>
                    <input type="radio" id="radio_38" class="with-gap radio-col-light-blue" name="kelamin" value="P">
                    <label for="radio_38">PEREMPUAN</label>
                </div>
            </div>    
        </div>
        
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="user" value="" required>
                <label class="form-label">Username </label>
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
                <input type="password" class="form-control" name="password" value="" required>
                <label class="form-label">Password </label>
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
                <input type="number" class="form-control" name="hp" value="" required>
                <label class="form-label">Nomor Handphone </label>
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
                <p><b>Masjid</b></p>
                <select class="form-control show-tick" name="masjid" data-live-search="true">
                    <?php
                    global $kdb;
                    $sql = "SELECT * FROM `m_masjid` where `publish`='T'";
                    $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
                    while ($baris = mysqli_fetch_array($hasil)) {
                        $value = $baris['id_masjid'];
                        $caption = $baris['nama_masjid'];
                        if (@$row['id_masjid'] == $baris['id_masjid'])
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
    $t = mysqli_fetch_array($hasil2);

    ?>

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    Perubahan Data Petugas
                </div>
                <form action="?page=Petugas" method="post">
                  <input type="hidden" name="sql" value="update">
                  <input type="hidden" name="idpetugas" value="<?php echo $t['id_petugas']; ?>">
                  <div class="body">
                      <div class="form-group form-float">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nama" value="<?php echo $t['nama_petugas']; ?>" required>
                                    <label class="form-label">Nama Petugas</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <?php $publish = str_replace('"', '"', trim($t["jenis_kelamin"])); ?>
                                <input type="radio" id="radio_39" class="with-gap radio-col-blue" name="kelamin" value="L" <?php if($publish=='L' || $publish=='') { echo "checked=\"checked\"";} else {echo ""; } ?>
                                >
                                <label for="radio_39">LAKI-LAKI</label>
                                
                                <input type="radio" id="radio_40" class="with-gap radio-col-light-blue" name="kelamin" value="P" <?php if($publish=='P' || $publish=='') { echo "checked=\"checked\"";} else {echo ""; } ?>
                                >
                                <label for="radio_40">PEREMPUAN</label>
                            </div>
                        </div>    
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="user" value="<?php echo $t['user']; ?>" required>
                            <label class="form-label">Username </label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" value="<?php echo $t['password']; ?>" required>
                            <label class="form-label">Password </label>
                        </div>
                    </div>
                    
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="hp" value="<?php echo $t['no_hp']; ?>" required>
                            <label class="form-label">Nomor Handphone </label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <p><b>Masjid</b></p>
                            <select class="form-control show-tick" name="masjid" data-live-search="true">
                                <?php
                                global $kdb;
                                $sql = "SELECT * FROM `m_masjid` where `publish`='T'";
                                $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
                                while ($baris = mysqli_fetch_array($hasil)) {
                                    $value = $baris['id_masjid'];
                                    $caption = $baris['nama_masjid'];
                                    if (@$row['id_masjid'] == $baris['id_masjid'])
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

                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php $publish = str_replace('"', '"', trim($t["publish"])); ?>
                                <input type="radio" id="radio_41" class="with-gap radio-col-blue" name="publish" value="T" <?php if($publish=='T' || $publish=='') { echo "checked=\"checked\"";} else {echo ""; } ?>
                                >
                                <label for="radio_41">Publikasikan</label>
                                
                                <input type="radio" id="radio_42" class="with-gap radio-col-light-blue" name="publish" value="F" <?php if($publish=='F' || $publish=='') { echo "checked=\"checked\"";} else {echo ""; } ?>
                                >
                                <label for="radio_42">Jangan Di Publikasikan</label>                        
                            </div>
                        </div>
                        


                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary active waves-effect" data-type="success" value="Simpan" name="enter">
                        <a href="?page=Petugas" class="btn btn-danger active"> Kembali </a>
                    </div>
                </form>           
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
    $sql = "SELECT a.*,b.`nama_masjid` FROM `m_petugas` as a, `m_masjid` as b Where a.`id_masjid`=b.`id_masjid` and a.`level`='USER'";
    $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
    return $hasil;
}


function sql_insert() //Untuk Insert Data
{
    global $kdb;
    $cek = "SELECT * FROM `m_petugas` WHERE `nama_petugas` = '".$_POST['nama']."'";
    $hasilcek = mysqli_query($kdb, $cek) or die(mysqli_error());
    $hasil2 = mysqli_fetch_array($hasilcek);
    if ($hasil2==""){
        $sql = "INSERT INTO `m_petugas`(`nama_petugas`,`jenis_kelamin`,`no_hp`,`user`,`password`,`level`,`id_masjid`,`publish`) VALUES ('".$_POST['nama']."','".$_POST['kelamin']."', '".$_POST['hp']."','".$_POST['user']."','".$_POST['password']."','USER','".$_POST['masjid']."','".$_POST['publish']."')";
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
            //Peringatan
        if ($hasil){
            echo "<script>alert('Penambahan Data Berhasil !');</script>";
        }
        return $hasil;
    }
    else{
        echo "<script>alert('Nama Petugas Sudah ada, Mohon Ganti dengan Nama Petugas yang Baru !'); </script>";
    }
}

function sql_update()
{
    global $kdb;
    $sql = "UPDATE `m_petugas` SET `nama_petugas` = '".$_POST['nama']."', `jenis_kelamin` = '".$_POST['kelamin']."',`user` = '".$_POST['user']."', `password` = '".$_POST['password']."',`no_hp` = '".$_POST['hp']."',`id_masjid` = '".$_POST['masjid']."', `publish` = '".$_POST['publish']."' where `id_petugas` = '".$_POST['idpetugas']."'";
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
    $cek = "SELECT * FROM `tr_sodaqoh` where `id_petugas` = '".$_POST["idpetugas"]."'";
    $hasilcek = mysqli_query($kdb, $cek) or die(mysqli_error());
    $hasil2 = mysqli_fetch_array($hasilcek);

    if($hasil2['id_petugas']==""){
        $sql = "DELETE FROM `m_petugas` WHERE `id_petugas` = '".$_POST["idpetugas"]."'";
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
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
    global $petugas;
    $sql = "SELECT * FROM `m_petugas` where `id_petugas` = '$petugas'";
    $hasil2 = mysqli_query($kdb, $sql) or die(mysqli_error());
    return $hasil2;

}
?>