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
// parameter tahun
$param = (isset($_POST['thn']) ? $_POST['thn'] : $tahun);

// variabel untuk menyimpan data
$rekap = array();

// data rekap kas
$sql_kas = "SELECT * FROM tr_rekapkas ORDER BY tgl_rekap ASC";
$ress_kas = mysqli_query($kdb, $sql_kas);
while ($li = mysqli_fetch_array($ress_kas)) {
    $tgl_tmp = getdate(strtotime($li['tgl_rekap']));
    $col = array();
    $col['tanggal'] = $li['tgl_rekap'];
    $col['operasional'] = $li['operasional'];
    $col['pembangunan'] = $li['pembangunan'];
    $col['zis'] = $li['zis'];
    $col['pemasukan'] = ($li['operasional'] + $li['pembangunan'] + $li['zis']);
    $col['pengeluaran'] = $li['pengeluaran'];
    $col['saldo'] = $col['pemasukan'] - $col['pengeluaran'];
    // var rekap[mm][yyyy] = array col
    $rekap[$tgl_tmp['year']][$tgl_tmp['mon']] = $col;
}
?>
<!-- top of file -->
<!-- Page Content -->
<div class="row clearfix js-sweetalert">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Laporan Kas Tahunan
                    <div class="col-lg-12"><?php include_once("./page/function/layout_alert.php");; ?></div>
                </h2>
                <br>
                <form action="" method="post">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select name="thn" class="form-control show-tick" data-live-search="true">
                                        <option value="0">- Pilih Tahun -</option>
                                        <?php
                                        for ($n = $tahun; $n >= 2000; $n--) {
                                            if ($param == $n) {
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
                                <th rowspan="2">Uraian</th>
                                <th colspan="12"><?php echo $param ?></th>
                            </tr>
                            <tr>
                                <?php
                                for ($x = 1; $x < $bulans_count; $x++) {
                                    echo "<th>" . $bulans[$x] . "</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Penerimaan Dana Operasional</td>
                                <?php
                                for ($x = 1; $x < $bulans_count; $x++) {
                                    if (isset($rekap[$param][$x]['operasional'])) {
                                        echo '<td>' . format_rupiah_akunting($rekap[$param][$x]['operasional']) . '</td>';
                                    } else {
                                        echo '<td class="text-center">-</td>';
                                    }
                                }
                                ?>
                            </tr>
                            <tr>
                                <td>Penerimaan Dana Pembangunan</td>
                                <?php
                                for ($x = 1; $x < $bulans_count; $x++) {
                                    if (isset($rekap[$param][$x]['pembangunan'])) {
                                        echo '<td>' . format_rupiah_akunting($rekap[$param][$x]['pembangunan']) . '</td>';
                                    } else {
                                        echo '<td class="text-center">-</td>';
                                    }
                                }
                                ?>
                            </tr>
                            <tr>
                                <td>Penerimaan Dana ZIS</td>
                                <?php
                                for ($x = 1; $x < $bulans_count; $x++) {
                                    if (isset($rekap[$param][$x]['zis'])) {
                                        echo '<td>' . format_rupiah_akunting($rekap[$param][$x]['zis']) . '</td>';
                                    } else {
                                        echo '<td class="text-center">-</td>';
                                    }
                                }
                                ?>
                            </tr>
                            <tr class="bg-green">
                                <td>Total Pemasukan</td>
                                <?php
                                for ($x = 1; $x < $bulans_count; $x++) {
                                    if (isset($rekap[$param][$x]['pemasukan'])) {
                                        echo '<td>' . format_rupiah_akunting($rekap[$param][$x]['pemasukan']) . '</td>';
                                    } else {
                                        echo '<td class="text-center">-</td>';
                                    }
                                }
                                ?>
                            </tr>
                            <tr class="bg-red">
                                <td>Total Pengeluaran</td>
                                <?php
                                for ($x = 1; $x < $bulans_count; $x++) {
                                    if (isset($rekap[$param][$x]['pengeluaran'])) {
                                        echo '<td>' . format_rupiah_akunting($rekap[$param][$x]['pengeluaran']) . '</td>';
                                    } else {
                                        echo '<td class="text-center">-</td>';
                                    }
                                }
                                ?>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-orange">
                                <th>Total Saldo</th>
                                <?php
                                for ($x = 1; $x < $bulans_count; $x++) {
                                    if (isset($rekap[$param][$x]['saldo'])) {
                                        echo '<th>' . format_rupiah_akunting($rekap[$param][$x]['saldo']) . '</th>';
                                    } else {
                                        echo '<th class="text-center">-</th>';
                                    }
                                }
                                ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a href="./page/Kastahunan_cetak.php?masjid=<?php echo $_SESSION['id_masjid'] ?>&thn=<?php echo $param ?>" target="_blank" class="btn btn-primary">Cetak</a>
                <!-- a href="#" class="btn btn-primary">Cetak</a -->
            </div>
        </div>
    </div>
</div>