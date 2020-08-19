<?php
include('./koneksi/koneksi.php');
global $kdb;

// query database memasukan/memperbarui data ke/pada database
if (isset($_POST['rekap'])) {
    $tgl_rekap = $_POST['tgl_rekap'];
    $tgl_tampil = $_POST['tgl_tampil'];
    $operasional = $_POST['operasional'];
    $pembangunan = $_POST['pembangunan'];
    $zis = $_POST['zis'];
    $pengeluaran = $_POST['pengeluaran'];
    $bln = $_POST['bln_rekap'];
    $thn = $_POST['thn_rekap'];

    $sql_chk = "SELECT * FROM tr_rekapkas
    WHERE tgl_rekap='" . $tgl_rekap . "' AND tgl_tampil='" . $tgl_tampil . "'";
    $ress_chk = mysqli_query($kdb, $sql_chk);
    $rows = mysqli_num_rows($ress_chk);
    $sql = "";
    if ($rows == 1) {
        $li = mysqli_fetch_array($ress_chk);
        $sql = "UPDATE tr_rekapkas SET
				tgl_rekap='" . $tgl_rekap . "',
				tgl_tampil='" . $tgl_tampil . "',
				operasional='" . $operasional . "',
				pembangunan='" . $pembangunan . "',
				zis='" . $zis . "',
				pengeluaran='" . $pengeluaran . "'
				WHERE no_rekap='" . $li['no_rekap'] . "'";
        $ress = mysqli_query($conn, $sql);

        header("location: ?page=KasBulanan&bln=" . $bln . "&thn=" . $thn . "&act=rekap&msg=update_success");
    } else {
        $sql_rekap = "SELECT no_rekap FROM tr_rekapkas
        ";
        $ress_rekap = mysqli_query($kdb, $sql_rekap);
        $rows_rekap = mysqli_num_rows($ress_rekap);
        $newid_rekap = $rows_rekap + 1;

        $sql = "INSERT INTO rekap_kas VALUES (
				'" . $newid_rekap . "',
				'" . $tgl_rekap . "',
				'" . $tgl_tampil . "',
				'" . $operasional . "',
				'" . $pembangunan . "',
				'" . $zis . "',
				'" . $pengeluaran . "')";
        $ress = mysqli_query($conn, $sql);

        header("location: index.php?page=KasBulanan");
    }
}
