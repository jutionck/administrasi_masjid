<?php
include_once("./koneksi/koneksi.php");
global $kdb;
// query database mencari data pengguna
$sql = "SELECT * FROM m_petugas WHERE id_petugas='" . $_SESSION['id_petugas'] . "'";
$ress = mysqli_query($kdb, $sql);
$data = mysqli_fetch_array($ress);

?>
<div class="row clearfix js-sweetalert">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Pengaturan Akun
                </h2>
            </div>
            <div class="body">
                <form class="form-horizontal" action="" method="post">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Password Lama</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="password_old" id="email_address_2" class="form-control" placeholder="Password lama..." required>
                                    <input type="hidden" name="password_old2" value="<?php echo $data['password'] ?>">
                                    <input type="hidden" name="id_petugas" value="<?php echo $data['id_petugas'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password_2">Password Baru</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" name="password_new" id="password_2" class="form-control" placeholder="Password baru..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password_2">Ulangi Password Baru</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" name="password_new2" id="password_2" class="form-control" placeholder="Ulangi password baru..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button type="submit" name="perbarui" class="btn btn-primary m-t-15 waves-effect">SIMPAN PERUBAHAN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
global $kdb;
// query database memperbarui data pada database
if (isset($_POST['perbarui'])) {
    $id_petugas = $_POST['id_petugas'];
    $password_old = $_POST['password_old'];
    $password_old2 = $_POST['password_old2'];
    $password_new = $_POST['password_new'];
    $password_new2 = $_POST['password_new2'];

    if ($password_old == $password_old2) {
        if ($password_new == $password_new2) {
            $sql = "UPDATE m_petugas SET password='" . $password_new . "' WHERE id_petugas='" . $id_petugas . "'";
            $ress = mysqli_query($kdb, $sql);
            if ($ress) {
                echo "<script>alert('Password berhasil disimpan!'); window.location='index.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal memperbarui data, password baru tidak sesuai..'); window.location='index.php?page=ubahpassword';</script>";
        }
    } else {
        echo "<script>alert('Gagal memperbarui data, password lama tidak sesuai...'); window.location='index.php?page=ubahpassword';</script>";
    }
}
?>