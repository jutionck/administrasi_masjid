<?php

session_abort();
// setting tanggal
$haries = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jum'at", "Saturday" => "Sabtu");
$bulans = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$bulans_count = count($bulans);
// tanggal bulan dan tahun hari ini
$hari_ini = $haries[date("l")];
$bulan_ini = $bulans[date("n")];
$tanggal = date("d");
$bulan = date("m");
$tahun = date("Y");

// deskripsi halaman
include('./koneksi/koneksi.php');
global $kdb;
include_once("./page/function/format_rupiah.php");
include_once("./page/function/format_tanggal.php");

// parameter bulan
$param = (isset($_POST['bln']) ? $_POST['bln'] : ceil($bulan));
$param2 = (isset($_POST['thn']) ? $_POST['thn'] : $tahun);

// keperluan rekap kas
$param3 = $param2 . "-" . $param . "-01";
$tgl_rekaps = getdate(strtotime($param3));
$tgl_rekap_tmp = mktime(0, 0, 0, $tgl_rekaps['mon'] + 1, $tgl_rekaps['mday'] - 1, $tgl_rekaps['year']);
$tgl_tampil_tmp = mktime(0, 0, 0, $tgl_rekaps['mon'] + 1, $tgl_rekaps['mday'], $tgl_rekaps['year']);
$tgl_rekap = date("Y-m-d", $tgl_rekap_tmp);
$tgl_tampil = date("Y-m-d", $tgl_tampil_tmp);

// variabel untuk menyimpan data
$data = array();

// data rekap kas
$sql_kas = "SELECT * FROM tr_rekapkas ORDER BY tgl_rekap ASC";
$ress_kas = mysqli_query($kdb, $sql_kas);
while ($li = mysqli_fetch_array($ress_kas)) {
    $tgl_rekaps = getdate(strtotime($li['tgl_rekap']));
    $col = array();
    $col['tanggal'] = $li['tgl_tampil'];
    $col['uraian'] = "Kas/Saldo Akhir Bulan " . $bulans[$tgl_rekaps['mon']] . " " . $tgl_rekaps['year'];
    $col['sumber'] = "KAS DKM";
    $col['operasional'] = $li['operasional'];
    $col['pemasukan'] = $li['operasional'];
    $col['pengeluaran'] = $li['pengeluaran_operasional'];
    $data[] = $col;
}

// data infaq (operasional)
$sql_infaq = "SELECT * FROM tr_infaq WHERE id_petugas = '".$_SESSION['id_petugas']."' ORDER BY tanggal ASC";
$ress_infaq = mysqli_query($kdb, $sql_infaq);
while ($li = mysqli_fetch_array($ress_infaq)) {
    $col = array();
    $col['tanggal'] = $li['tanggal'];
    $col['uraian'] = $li['keterangan'];
    $col['sumber'] = $li['jenis_infaq'];
    $col['operasional'] = $li['nominal'];
    $col['pemasukan'] = $li['nominal'];
    $col['pengeluaran'] = "-";
    $data[] = $col;
}

// data pengeluaran
$sql_keluar = "SELECT * FROM tr_pengeluaran  WHERE id_petugas = '".$_SESSION['id_petugas']."' AND jenis_pengeluaran = 'OPERASIONAL' ORDER BY tanggal ASC";
$ress_keluar = mysqli_query($kdb, $sql_keluar);
while ($li = mysqli_fetch_array($ress_keluar)) {
    $col = array();
    $col['tanggal'] = $li['tanggal'];
    $col['uraian'] = $li['keterangan'];
    $col['sumber'] = $li['jenis_pengeluaran'];
    $col['operasional'] = 0;
    $col['pemasukan'] = "-";
    $col['pengeluaran'] = $li['nominal'];
    $data[] = $col;
}

// sorting data berdasarkan tanggal
sort($data);
?>
<!-- top of file -->
<!-- Page Content -->
<div class="row clearfix js-sweetalert">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Laporan Kas Dana Operasional
                    <div class="col-lg-12"><?php include_once("./page/function/layout_alert.php");; ?></div>
                </h2>
                <br>
                <form action="" method="post">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select name="bln" class="form-control show-tick" data-live-search="true">
                                        <option value="0">- Pilih Bulan -</option>
                                        <?php
                                        for ($n = 1; $n < $bulans_count; $n++) {
                                            if ($param == $n) {
                                                echo '<option value="' . $n . '" selected>' . $bulans[$n] . '</option>';
                                            } else {
                                                echo '<option value="' . $n . '">' . $bulans[$n] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select name="thn" class="form-control show-tick" data-live-search="true">
                                        <option value="0">- Pilih Tahun -</option>
                                        <?php
                                        for ($n = $tahun; $n >= 2000; $n--) {
                                            if ($param2 == $n) {
                                                echo '<option value="' . $n . '" selected>' . $n . '</option>';
                                            } else {
                                                echo '<option value="' . $n . '">' . $n . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">TAMPILKAN</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Uraian</th>
                                <th>Sumber</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $saldo = 0;
                            $sum_infaq = 0;
                            $sum_pemasukan = 0;
                            $sum_pengeluaran = 0;
                            foreach ($data as $row) {
                                $tanggal_array = getdate(strtotime($row['tanggal']));
                                if ($param && $param == $tanggal_array['mon'] && $param2 == $tanggal_array['year']) {
                                    echo '<tr>';
                                    echo '<td class="text-center">' . $i . '</td>';
                                    echo '<td class="text-center">' . format_tanggal($row['tanggal']) . '</td>';
                                    echo '<td>' . $row['uraian'] . '</td>';
                                    echo '<td>' . $row['sumber'] . '</td>';
                                    if ($row['pemasukan'] != "-") {
                                        echo '<td class="text-right">' . format_rupiah_akunting($row['pemasukan']) . '</td>';
                                        $saldo += $row['pemasukan'];
                                        $sum_pemasukan += $row['pemasukan'];
                                        $sum_infaq += $row['operasional'];
                                        
                                    } else {
                                        echo '<td class="text-center">' . $row['pemasukan'] . '</td>';
                                    }
                                    if ($row['pengeluaran'] != "-") {
                                        echo '<td class="text-right">' . format_rupiah_akunting($row['pengeluaran']) . '</td>';
                                        $saldo -= $row['pengeluaran'];
                                        $sum_pengeluaran += $row['pengeluaran'];
                                    } else {
                                        echo '<td class="text-center">' . $row['pengeluaran'] . '</td>';
                                    }
                                    echo '<td class="text-right">' . format_rupiah_akunting($saldo) . '</td>';
                                    echo '</tr>';

                                    $i++;
                                }
                            }
                            if ($i == 1) {
                                echo '<tr><td colspan="7" class="text-center">-= Belum ada data =-</td></tr>';
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <?php
                            echo '<tr>';
                            echo '<th colspan="4" class="text-center">Total</th>';
                            echo '<th class="text-right">' . format_rupiah_akunting($sum_pemasukan) . '</th>';
                            echo '<th class="text-right">' . format_rupiah_akunting($sum_pengeluaran) . '</th>';
                            echo '<th class="text-right">' . format_rupiah_akunting($saldo) . '</th>';
                            echo '</tr>';
                            ?>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <form class="form-inline" action="" method="POST">
                            <input type="hidden" name="tgl_rekap" value="<?php echo $tgl_rekap ?>">
                            <input type="hidden" name="tgl_tampil" value="<?php echo $tgl_tampil ?>">
                            <input type="hidden" name="operasional" value="<?php echo $sum_infaq ?>">
                            <input type="hidden" name="pengeluaran" value="<?php echo $sum_pengeluaran ?>">
                            <input type="hidden" name="bln_rekap" value="<?php echo $param ?>">
                            <input type="hidden" name="thn_rekap" value="<?php echo $param2 ?>">
                            <?php
                            if ($i == 1) {
                                echo '<button type="submit" name="rekap" class="btn btn-success" disabled>Simpan Rekap</button>';
                            } else {
                                echo '<button type="submit" name="rekap" class="btn btn-success">Simpan Rekap</button>';
                            }
                            ?>
                            <?php
                            if ($i == 1) {
                                ?> <a href="./page/lap-operasional-cetak.php?masjid=<?php echo $_SESSION["id_masjid"] ?>&petugas=<?php echo $_SESSION["id_petugas"] ?>&bln=<?php echo $param ?>&thn=<?php echo $param2 ?>" target="_blank" class="btn btn-primary" disabled>Cetak</a>
                            <?php } else { ?>
                                <a href="./page/lap-operasional-cetak.php?masjid=<?php echo $_SESSION["id_masjid"] ?>&petugas=<?php echo $_SESSION["id_petugas"] ?>&bln=<?php echo $param ?>&thn=<?php echo $param2 ?>" target=" _blank" class="btn btn-primary">Cetak</a>
                            <?php }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

// query database memasukan/memperbarui data ke/pada database
include_once('./koneksi/koneksi.php');
global $kdb;
if (isset($_POST['rekap'])) {
    $tgl_rekap = $_POST['tgl_rekap'];
    $tgl_tampil = $_POST['tgl_tampil'];
    $operasional = $_POST['operasional'];
    $pengeluaran = $_POST['pengeluaran'];
    $id_masjid = $_SESSION['id_masjid'];
    $bln = $_POST['bln_rekap'];
    $thn = $_POST['thn_rekap'];

    $sql_chk = "SELECT * FROM tr_rekapkas
    WHERE tgl_rekap='" . $tgl_rekap . "' AND tgl_tampil='" . $tgl_tampil . "' AND id_masjid = '".$_SESSION['id_masjid']."'";
    $ress_chk = mysqli_query($kdb, $sql_chk);
    $rows = mysqli_num_rows($ress_chk);
    $sql = "";
    if ($rows == 1) {
        $li = mysqli_fetch_array($ress_chk);
        $sql = "UPDATE tr_rekapkas SET
				tgl_rekap='" . $tgl_rekap . "',
				tgl_tampil='" . $tgl_tampil . "',
				operasional='" . $operasional . "',
				pengeluaran_operasional='" . $pengeluaran . "',
                id_masjid='" . $id_masjid . "'
				WHERE no_rekap='" . $li['no_rekap'] . "'";
        $ress = mysqli_query($kdb, $sql);
        if ($ress) {
            echo "<script>alert('Data berhasil disimpan!'); window.location='index.php?page=lap-operasional';</script>";
        }

        //header("location: index.php?page=KasBulanan&bln=" . $bln . "&thn=" . $thn . "&act=rekap&msg=update_success");
    } else {
        $sql_rekap = "SELECT no_rekap FROM tr_rekapkas where id_masjid = '".$_SESSION['id_masjid']."'
        ";
        $ress_rekap = mysqli_query($kdb, $sql_rekap);
        $rows_rekap = mysqli_num_rows($ress_rekap);
        $newid_rekap = $rows_rekap + 1;

        $sql = "INSERT INTO tr_rekapkas (no_rekap, tgl_rekap, tgl_tampil, operasional, pengeluaran_operasional, id_masjid) VALUES (
				'" . $newid_rekap . "',
				'" . $tgl_rekap . "',
				'" . $tgl_tampil . "',
				'" . $operasional . "',
                '" . $pengeluaran . "',
				'" . $id_masjid . "')";
        $ress = mysqli_query($kdb, $sql);

        if ($ress) {
            echo "<script>alert('Data berhasil disimpan!'); window.location='index.php?page=lap-operasional';</script>";
        }

        //header("location: index.php?page=KasBulanan&bln=" . $bln . "&thn=" . $thn . "&act=rekap&msg=add_success");
    }
}
?>