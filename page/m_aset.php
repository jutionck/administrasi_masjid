<script>
    function startCalc(){
    interval = setInterval("calc()",1);}
    function calc(){
    a = document.autoSumForm.jumlah.value;
    aa = document.autoSumForm.nilai_1.value;
    d = document.autoSumForm.jumlah_1.value = (a * 1) * (aa * 1); }
    function stopCalc(){
    clearInterval(interval);}
</script>
<?php
$a = !empty($_GET['page']) ? $_GET['page'] : "reset";
$b = !empty($_GET['b']) ? $_GET['b'] : "reset";
$aset = !empty($_GET['aset']) ? $_GET['aset'] : " ";
?>

<?php
$kdb = koneksidatabase();
$a = @$_GET["page"];
$sql = @$_POST["sql"];

switch ($sql) {
    case "insert":
        sql_insert();
        break; //Buat Input Type Hidden CURD CREATE
    case "update":
        sql_update();
        break; //Buat Input Type Hidden CURD UPDATE
    case "delete":
        sql_delete();
        break; //Buat Input Type Hidden CURD DELETE
}

switch ($b) {
    case "reset":
        curd_read();
        break;
    case "edit":
        curd_update();
        break;
    default:
        curd_read();
        break;
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
                                Data Aset
                            </h2>
                            <br>

                            <button <?php if ($_SESSION['level'] == 'ADMIN') {
                                            echo "class='hidden'";
                                        } ?> type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#myModal">Input Aset</button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Terima</th>
                                            <th>Nama Aset</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                            <th>Keterangan</th>
                                            <th>Masjid</th>
                                            <th <?php if ($_SESSION['level'] == 'ADMIN') {
                                                        echo "class='hidden'";
                                                    } ?>>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Terima</th>
                                            <th>Nama Aset</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                            <th>Keterangan</th>
                                            <th>Masjid</th>
                                            <th <?php if ($_SESSION['level'] == 'ADMIN') {
                                                        echo "class='hidden'";
                                                    } ?>>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            global $kdb;
                                            $hasil = sql_select();
                                            $i = 1;
                                            while ($t = mysqli_fetch_array($hasil)) {
                                                ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $t['tgl_aset']; ?></td>
                                                <td><?php echo $t['namaaset']; ?></td>
                                                <td><?php echo $t['jumlah']; ?></td>
                                                <td><?php echo $t['harga']; ?></td>
                                                <td><?php echo $t['total']; ?></td>
                                                <td><?php echo $t['keterangan']; ?></td>
                                                <td><?php echo $t['nama_masjid']; ?></td>
                                                <td <?php if ($_SESSION['level'] == 'ADMIN') {
                                                                echo "class='hidden'";
                                                            } ?>>
                                                    <a href="?page=Aset&b=edit&aset=<?php echo $t['idaset']; ?>" class="btn btn-success btn-circle waves-effect waves-circle waves-float" title="Edit"> <i class="fa fa-edit"> </i> </a>

                                                    <button class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Hapus" data-toggle="modal" data-target="#myModalh<?php echo $t['idaset']; ?>"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <!-- Modal Hapus-->
                                            <div class="modal fade text-xs-left" id="myModalh<?php echo $t['idaset']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Hapus Data Donatur </label>
                                                        </div>
                                                        <form action="?page=Aset" method="post">
                                                            <input type="hidden" name="sql" value="delete">
                                                            <input type="hidden" name="idaset" value="<?php echo $t['idaset']; ?>">
                                                            <div class="modal-body">
                                                                <h5><i class="icon-android-delete"></i> Konfirmasi Penghapusan Data Aset</h5>
                                                                <p>Apakah Anda Yakin Akan Menghapus Aset <b><?php echo $t['namaaset']; ?>.? </b></p>
                                                                <div class="alert alert-danger" role="alert">
                                                                    <span class="text-bold-600">Ingat!</span> Pastikan Data Aset tidak ada nama <b> <?php echo $t['namaaset']; ?></b>.
                                                                </div>

                                                            </div>
                                                            <!--Modal Body-->
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
                                            } //WHILE
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
                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Penambahan Data Aset </label>
                                        </div>
                                        <form action="?page=Aset" method="post" name="autoSumForm">
                                            <input type="hidden" name="sql" value="insert">
                                            <input type="hidden" name="publish" value="T">
                                            <input type="hidden" name="idmasjid" value="<?php echo "" . $_SESSION['id_masjid']; ?>">
                                            <div class="modal-body">
                                                            <div class="form-group form-float">
                                <div class="input-group date" id="bs_datepicker_component_container">
                                    <div class="form-line">
                                        <input type="text" name="tgl_aset" class="form-control" placeholder="Masukan Tanggal">
                                    </div>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>    
                            </div>

                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="namaaset" value="" required>
                                                        <label class="form-label">Nama Aset</label>
                                                    </div>
                                                </div>

                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="number" class="form-control" name="jumlah" value="" required="" onFocus="startCalc();" onBlur="stopCalc();">
                                                        <label class="form-label">Jumlah</label>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="number" class="form-control" name="nilai_1" value="" required="" onFocus="startCalc();" onBlur="stopCalc();">
                                                        <label class="form-label">Harga</label>
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type=text name="jumlah_1" class="form-control" onchange='tryNumberFormat(this.form.thirdBox);' readonly="" placeholder="Total">
                                                    </div>
                                                </div>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="keterangan" value="" required>
                                                        <label class="form-label">Keterangan</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Modal Body-->
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
        } //READ
        ?>

        <?php
        function curd_update()
        {
            global $kdb;
            $hasil2 = sql_select_byid();
            $t = mysqli_fetch_array($hasil2);

            ?>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            Perubahan Data Aset
                        </div>
                            <div class="body">
                                <form action="?page=Aset" method="post" name="autoSumForm">
                                    <input type="hidden" name="sql" value="update">
                                    <input type="hidden" name="idaset" value="<?php echo $t['idaset']; ?>">
                                    <input type="hidden" name="idmasjid" value="<?php echo "" . $_SESSION['id_masjid']; ?>">
                                    <div class="modal-body">
                                      <div class="form-group form-float">
                                        <div class="input-group date" id="bs_datepicker_component_container">
                                          <div class="form-line">
                                            <input type="text" name="tgl_aset" class="form-control" placeholder="Masukan Tanggal" value="<?php echo $t['tgl_aset']; ?>">
                                          </div>
                                          <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                          </span>
                                        </div>    
                                      </div>

                                      <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="namaaset" value="<?php echo $t['namaaset']; ?>">
                                            <label class="form-label">Nama Aset</label>
                                        </div>
                                      </div>

                                      <div class="form-group form-float">
                                          <div class="form-line">
                                              <input type="number" class="form-control" name="jumlah" value="<?php echo $t['jumlah']; ?>" required="" onFocus="startCalc();" onBlur="stopCalc();">
                                              <label class="form-label">Jumlah</label>
                                          </div>
                                      </div>
                                      <div class="form-group form-float">
                                          <div class="form-line">
                                              <input type="number" class="form-control" name="nilai_1" value="<?php echo $t['harga']; ?>" required="" onFocus="startCalc();" onBlur="stopCalc();">
                                              <label class="form-label">Harga</label>
                                          </div>
                                      </div>
                                      <div class="form-group form-float">
                                          <div class="form-line">
                                              <input type=text name="jumlah_1" class="form-control" onchange='tryNumberFormat(this.form.thirdBox);' readonly="" placeholder="Total" value="<?php echo $t['total']; ?>">
                                          </div>
                                      </div>
                                      <div class="form-group form-float">
                                          <div class="form-line">
                                              <input type="text" class="form-control" name="keterangan" value="<?php echo $t['keterangan']; ?>" required>
                                              <label class="form-label">Keterangan</label>
                                          </div>
                                      </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary active waves-effect" data-type="success" value="Simpan" name="enter">
                                <a href="?page=Aset" class="btn btn-danger active"> Kembali </a>
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
                if ($_SESSION['level'] == 'USER') {
                    $sql = "SELECT a.*, b.`nama_masjid` FROM `m_aset` as a,`m_masjid` as b WHERE a.`id_masjid`=b.`id_masjid` and a.`id_masjid`= " . $_SESSION['id_masjid'];
                    $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                } else { //IF
                    $sql = "SELECT a.*, b.`nama_masjid` FROM `m_aset` as a,`m_masjid` as b WHERE a.`id_masjid`=b.`id_masjid`";
                    $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                } //End Else
                return $hasil;
            }


            function sql_insert() //Untuk Insert Data
            {
                global $kdb;
                $cek = "SELECT * FROM `m_aset` WHERE `namaaset` = '" . $_POST['namaaset'] . "' AND id_masjid = '".$_SESSION['id_masjid']."'";
                $hasilcek = mysqli_query($kdb, $cek) or die(mysqli_error($kdb));
                $hasil2 = mysqli_fetch_array($hasilcek);
                if ($hasil2 == "") {
                    $sql = "INSERT INTO `m_aset`(`tgl_aset`,`namaaset`,`jumlah`,`harga`,`total`,`keterangan`,`id_masjid`) VALUES ('" . $_POST['tgl_aset'] . "','" . $_POST['namaaset'] . "','" . $_POST['jumlah'] . "','" . $_POST['nilai_1'] . "','" . $_POST['jumlah_1'] . "','" . $_POST['keterangan'] . "','" . $_POST['idmasjid'] . "')";
                    $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                    //Peringatan
                    if ($hasil) {
                        echo "<script>alert('Penambahan Data Berhasil !');</script>";
                    }
                    return $hasil;
                } else {
                    echo "<script>alert('Nama Donatur Sudah ada, Mohon Ganti dengan Nama Donatur yang Baru !'); </script>";
                }
            }

            function sql_update()
            {
                global $kdb;
                $sql = "UPDATE `m_aset` SET 
                `tgl_aset` = '" . $_POST['tgl_aset'] . "', 
                `namaaset` = '" . $_POST['namaaset'] . "',
                `jumlah` = '" . $_POST['jumlah'] . "',
                `harga` = '" . $_POST['nilai_1'] . "', 
                `total` = '" . $_POST['jumlah_1'] . "', 
                `keterangan` = '" . $_POST['keterangan'] . "', 
                `id_masjid` = '" . $_POST['idmasjid'] . "' 
                where `idaset` = '" . $_POST['idaset'] . "'";
                $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));

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
                    $sql = "DELETE FROM `m_aset` WHERE `idaset` = '" . $_POST["idaset"] . "'";
                    $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                    if ($hasil) {
                        echo "<script>alert('Data Berhasil Di Hapus !'); </script>";
                    } else {
                        echo "<script>alert('Data Gagal Di Hapus, Mungkin Sedang Ada Gangguan Pada Aplikasi Ini !'); </script>";
                    }
            }

            function sql_select_byid()
            {
                global $kdb;
                global $aset;
                $sql = "SELECT * FROM `m_aset` where `idaset` = '$aset'";
                $hasil2 = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                return $hasil2;
            }
            ?>