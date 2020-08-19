<?php
$b = !empty($_GET['b']) ? $_GET['b'] : "reset";
$org = !empty($_GET['org']) ? $_GET['org'] : " ";

$kdb = koneksidatabase();
$sql = @$_POST["sql"];

switch ($sql) {
    case "update":
        sql_update();
        break; //Buat Input Type Hidden CURD UPDATE
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
    global $kdb;

    if (isset($_GET['org'])) {
        $sql = "SELECT * FROM m_organisasi WHERE id_konten='" . $_GET['org'] . "'";
        $ress = mysqli_query($kdb, $sql);
        $data = mysqli_fetch_array($ress);
    }
    ?>

            <div class="row clearfix js-sweetalert">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><?php echo $data['judul_konten'] ?></h2>
                        </div>
                        <div class="body">
                            <?php echo $data['isi_konten'] ?>
                        </div>
                        <div class="panel-footer">
                            <a href="index.php?page=struktur&b=edit&org=<?php echo $data['id_konten'] ?>" class="btn btn-warning">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php  } ?>
        <?php
        function curd_update()
        {
            $hasil2 = sql_select_byid();
            $t = mysqli_fetch_array($hasil2);
            ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            Perubahan Data Donatur
                            <div class="body">
                                <form action="index.php?page=struktur&org=<?php echo $t['id_konten'] ?>" method="post">
                                    <input type="hidden" name="sql" value="update">
                                    <input type="hidden" name="iddonatur" value="<?php echo $t['id_konten']; ?>">
                                    <div class="form-group form-float">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="judul_konten" value="<?php echo $t['judul_konten']; ?>" required>
                                                    <input type="hidden" name="id_konten" value="<?php echo $t['id_konten'] ?>">
                                                    <label class="form-label">Judul Konten</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="menu_konten" value="<?php echo $t['menu_konten']; ?>" required>
                                                    <label class="form-label">Nama Konten</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-line">
                                                    <textarea name="isi_konten" id="isi_konten" class="form-control" rows="26" placeholder="Isi Konten" required><?php echo $t['isi_konten'] ?></textarea>
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

                <?php

                function koneksidatabase()
                {
                    include('./koneksi/koneksi.php');
                    return $kdb;
                }

                function sql_select_byid()
                {
                    global $kdb;
                    global $org;
                    $sql = "SELECT * FROM m_organisasi WHERE id_konten = '$org'";
                    $hasil2 = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
                    return $hasil2;
                }
                function sql_update()
                {
                    global $kdb;
                    $id_konten = $_POST['id_konten'];
                    $judul_konten = addslashes($_POST['judul_konten']);
                    $isi_konten = addslashes($_POST['isi_konten']);
                    $menu_konten = addslashes($_POST['menu_konten']);

                    $sql = "UPDATE m_organisasi SET
			judul_konten='" . $judul_konten . "',
			isi_konten='" . $isi_konten . "',
			menu_konten='" . $menu_konten . "'
            WHERE id_konten='" . $id_konten . "'";
                    $ress = mysqli_query($kdb, $sql);

                    if ($ress) {
                        echo "<script>alert('Data Berhasil Di Perbaharui !'); </script>";
                    } else {
                        echo "<script>alert('Data Gagal Di Perbaharui, Mungkin Sedang Ada Gangguan Pada Aplikasi Ini !'); </script>";
                    }
                    return $ress;
                }
                ?>