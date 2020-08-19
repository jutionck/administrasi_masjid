
    <div class="row clearfix js-sweetalert">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Pengaturan Cetak Dokumen</h2>
                    <br>
                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#myModal">Tambah Data</button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Donatur</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>No HP</th>
                                            <th>Masjid</th>
                                            <th>Status</th>
                                            <th <?php if ($_SESSION['level'] == 'ADMIN') {
                                                        echo "class='hidden'";
                                                    } ?>>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Donatur</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>No HP</th>
                                            <th>Masjid</th>
                                            <th>Status</th>
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
                                                <td><?php echo $t['nama_donatur']; ?></td>
                                                <td><?php echo $t['jenis_kelamin']; ?></td>
                                                <td><?php echo $t['alamat']; ?></td>
                                                <td><?php echo $t['no_hp']; ?></td>
                                                <td><?php echo $t['nama_masjid']; ?></td>
                                                <td><?php echo $t['publish']; ?></td>
                                                <td <?php if ($_SESSION['level'] == 'ADMIN') {
                                                                echo "class='hidden'";
                                                            } ?>>
                                                    <a href="?page=Donatur&b=edit&donatur=<?php echo $t['id_donatur']; ?>" class="btn btn-success btn-circle waves-effect waves-circle waves-float" title="Edit"> <i class="fa fa-edit"> </i> </a>

                                                    <button class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Hapus" data-toggle="modal" data-target="#myModalh<?php echo $t['id_donatur']; ?>"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <!-- Modal Hapus-->
                                            <div class="modal fade text-xs-left" id="myModalh<?php echo $t['id_donatur']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Hapus Data Donatur </label>
                                                        </div>
                                                        <form action="?page=Donatur" method="post">
                                                            <input type="hidden" name="sql" value="delete">
                                                            <input type="hidden" name="iddonatur" value="<?php echo $t['id_donatur']; ?>">
                                                            <div class="modal-body">
                                                                <h5><i class="icon-android-delete"></i> Konfirmasi Penghapusan Data Donatur</h5>
                                                                <p>Apakah Anda Yakin Akan Menghapus Donatur <b><?php echo $t['nama_donatur']; ?>.? </b></p>
                                                                <div class="alert alert-danger" role="alert">
                                                                    <span class="text-bold-600">Ingat!</span> Pastikan Data Penerimaan Shodaqoh tidak ada nama <b> <?php echo $t['nama_donatur']; ?></b>.
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
                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Penambahan Data Donatur </label>
                                        </div>
                                        <form action="?page=Donatur" method="post">
                                            <input type="hidden" name="sql" value="insert">
                                            <input type="hidden" name="publish" value="T">
                                            <input type="hidden" name="idmasjid" value="<?php echo "" . $_SESSION['id_masjid']; ?>">
                                            <div class="modal-body">
                                                <div class="form-group form-float">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="nama" value="" required>
                                                                <label class="form-label">Nama Donatur</label>
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
                                                        <input type="text" class="form-control" name="alamat" value="" required>
                                                        <label class="form-label">Alamat</label>
                                                    </div>
                                                </div>

                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="number" class="form-control" name="hp" value="" required>
                                                        <label class="form-label">Nomor Handphone </label>
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
            global $toko;
            $hasil2 = sql_select_byid();
            $t = mysqli_fetch_array($hasil2);

            ?>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            Perubahan Data Donatur
                            <div class="body">
                                <form action="?page=Donatur" method="post">
                                    <input type="hidden" name="sql" value="update">
                                    <input type="hidden" name="iddonatur" value="<?php echo $t['id_donatur']; ?>">
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nama" value="<?php echo $t['nama_donatur']; ?>" required>
                                                    <label class="form-label">Nama Donatur</label>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <?php $publish = str_replace('"', '"', trim($t["jenis_kelamin"])); ?>
                                                <input type="radio" id="radio_39" class="with-gap radio-col-blue" name="kelamin" value="L" <?php if ($publish == 'L' || $publish == '') {
                                                                                                                                                    echo "checked=\"checked\"";
                                                                                                                                                } else {
                                                                                                                                                    echo "";
                                                                                                                                                } ?>>
                                                <label for="radio_39">LAKI-LAKI</label>

                                                <input type="radio" id="radio_40" class="with-gap radio-col-light-blue" name="kelamin" value="P" <?php if ($publish == 'P' || $publish == '') {
                                                                                                                                                            echo "checked=\"checked\"";
                                                                                                                                                        } else {
                                                                                                                                                            echo "";
                                                                                                                                                        } ?>>
                                                <label for="radio_40">PEREMPUAN</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="alamat" value="<?php echo $t['alamat']; ?>" required>
                                            <label class="form-label">Alamat</label>
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
                                            <?php $publish = str_replace('"', '"', trim($t["publish"])); ?>
                                            <input type="radio" id="radio_41" class="with-gap radio-col-blue" name="publish" value="T" <?php if ($publish == 'T' || $publish == '') {
                                                                                                                                                echo "checked=\"checked\"";
                                                                                                                                            } else {
                                                                                                                                                echo "";
                                                                                                                                            } ?>>
                                            <label for="radio_41">Publikasikan</label>

                                            <input type="radio" id="radio_42" class="with-gap radio-col-light-blue" name="publish" value="F" <?php if ($publish == 'F' || $publish == '') {
                                                                                                                                                        echo "checked=\"checked\"";
                                                                                                                                                    } else {
                                                                                                                                                        echo "";
                                                                                                                                                    } ?>>
                                            <label for="radio_42">Jangan Di Publikasikan</label>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary active waves-effect" data-type="success" value="Simpan" name="enter">
                                <a href="?page=Donatur" class="btn btn-danger active"> Kembali </a>
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
                    $sql = "SELECT a.*, b.`nama_masjid` FROM `m_donatur` as a,`m_masjid` as b WHERE a.`id_masjid`=b.`id_masjid` and a.`id_masjid`= " . $_SESSION['id_masjid'];
                    $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                } else { //IF
                    $sql = "SELECT a.*, b.`nama_masjid` FROM `m_donatur` as a,`m_masjid` as b WHERE a.`id_masjid`=b.`id_masjid`";
                    $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                } //End Else
                return $hasil;
            }


            function sql_insert() //Untuk Insert Data
            {
                global $kdb;
                $cek = "SELECT * FROM `m_donatur` WHERE `nama_donatur` = '" . $_POST['nama'] . "'";
                $hasilcek = mysqli_query($kdb, $cek) or die(mysqli_error($kdb));
                $hasil2 = mysqli_fetch_array($hasilcek);
                if ($hasil2 == "") {
                    $sql = "INSERT INTO `m_donatur`(`nama_donatur`,`jenis_kelamin`,`alamat`,`no_hp`,`id_masjid`,`publish`) VALUES ('" . $_POST['nama'] . "','" . $_POST['kelamin'] . "','" . $_POST['alamat'] . "','" . $_POST['hp'] . "','" . $_POST['idmasjid'] . "','" . $_POST['publish'] . "')";
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
                $sql = "UPDATE `m_donatur` SET `nama_donatur` = '" . $_POST['nama'] . "', `jenis_kelamin` = '" . $_POST['kelamin'] . "',`alamat` = '" . $_POST['alamat'] . "',`no_hp` = '" . $_POST['hp'] . "', `publish` = '" . $_POST['publish'] . "' where `id_donatur` = '" . $_POST['iddonatur'] . "'";
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
                $cek = "SELECT * FROM `tr_sodaqoh` where `id_donatur` = '" . $_POST["iddonatur"] . "'";
                $hasilcek = mysqli_query($kdb, $cek) or die(mysqli_error($kdb));
                $hasil2 = mysqli_fetch_array($hasilcek);

                if ($hasil2['id_donatur'] == "") {
                    $sql = "DELETE FROM `m_donatur` WHERE `id_donatur` = '" . $_POST["iddonatur"] . "'";
                    $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                    if ($hasil) {
                        echo "<script>alert('Data Berhasil Di Hapus !'); </script>";
                    } else {
                        echo "<script>alert('Data Gagal Di Hapus, Mungkin Sedang Ada Gangguan Pada Aplikasi Ini !'); </script>";
                    }
                    return $hasil;
                } else {
                    echo "<script>alert('Data Sedang Di Gunakan Mohon Jangan Di Hapus !'); </script>";
                }
                return $hasil2;
            }

            function sql_select_byid()
            {
                global $kdb;
                global $donatur;
                $sql = "SELECT * FROM `m_donatur` where `id_donatur` = '$donatur'";
                $hasil2 = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                return $hasil2;
            }
            ?>