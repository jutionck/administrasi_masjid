<?php
// deskripsi halaman
include('../koneksi/koneksi.php');
global $kdb;
include_once("./function/format_rupiah.php");
include_once("./function/format_tanggal.php");

// parameter tahun
$param = (isset($_GET['thn']) ? $_GET['thn'] : $tahun);
$masjid = $_GET['masjid'];

// keperluan reporting
$bulans = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$bulans_count = count($bulans);
$tgl_cetak = date("Y-m-d");

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

$sql = "SELECT * FROM m_masjid where id_masjid = " . $masjid;
$hasil = mysqli_query($kdb, $sql);
$row = mysqli_fetch_array($hasil);

// deskripsi halaman
$pagedesc = "Masjid " .$row['nama_masjid']. " - Laporan Kas Keuangan Tahunan - Periode " . $param;
$pagetitle = str_replace(" ", "_", $pagedesc)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="sistem informasi administrasi keuangan masjid">
    <meta name="author" content="universitas pamulang">

    <title><?php echo $pagetitle ?></title>

    <link href="../libs/images/brand-dkm.png" rel="icon" type="images/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="../libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/offline-font.css" rel="stylesheet">
    <link href="../dist/css/custom-report.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="../libs/jquery/dist/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <section id="header-kop">
        <div class="container-fluid">
            <table class="table table-borderless">
                <?php
                global $kdb;
                $sql = "SELECT * FROM m_masjid where id_masjid = " . $masjid;
                $hasil = mysqli_query($kdb, $sql);
                $row = mysqli_fetch_array($hasil);
                ?>
                <tbody>
                    <tr>
                        <td rowspan="3" width="16%" class="text-center">
                            <img src="../images/<?php echo $row['foto']; ?>" alt="logo-dkm" width="80" />
                        </td>
                        <td class="text-center">
                            <h3>DEWAN KEMAKMURAN MASJID (DKM)</h3>
                        </td>
                        <td rowspan="3" width="16%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <h2><?php echo $row['nama_masjid']; ?></h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"><?php echo $row['alamat']; ?></td>
                    </tr>
                </tbody>
            </table>
            <hr class="line-top" />
        </div>
    </section>

    <section id="body-of-report">
        <div class="container-fluid">
            <h4 class="text-center">LAPORAN KAS KEUANGAN TAHUNAN</h4>
            <h5 class="text-center">Periode <?php echo $param ?></h5>
            <br />
            <table class="table table-bordered table-keuangan">
                <thead>
                    <tr>
                        <th rowspan="2">Uraian</th>
                        <th colspan="12"><?php echo $param ?></th>
                    </tr>
                    <tr>
                        <?php
                        for ($x = 1; $x < $bulans_count; $x++) {
                            echo '<th class="text-nowrap">' . $bulans[$x] . '</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Penerimaan Infaq</td>
                        <?php
                        for ($x = 1; $x < $bulans_count; $x++) {
                            if (isset($rekap[$param][$x]['infaq'])) {
                                echo '<td>' . format_rupiah_akunting($rekap[$param][$x]['infaq']) . '</td>';
                            } else {
                                echo '<td class="text-center">-</td>';
                            }
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>Penerimaan Shodaqoh</td>
                        <?php
                        for ($x = 1; $x < $bulans_count; $x++) {
                            if (isset($rekap[$param][$x]['sodaqoh'])) {
                                echo '<td>' . format_rupiah_akunting($rekap[$param][$x]['sodaqoh']) . '</td>';
                            } else {
                                echo '<td class="text-center">-</td>';
                            }
                        }
                        ?>
                    </tr>
                    <tr>
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
                    <tr>
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
                    <tr>
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
            <br />
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td class="text-center"><?php echo format_tanggal_laporan("Bandar Lampung", $tgl_cetak) ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="30%" class="text-center">Bendahara</td>
                        <td width="30%" class="text-center">Sekretaris</td>
                        <td width="10%">&nbsp;</td>
                        <td width="30%" class="text-center">Ketua</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="height: 60px">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <?php echo $row['bendahara']; ?>
                            <div class="line-ttd"></div>
                        </td>
                        <td class="text-center">
                            <?php echo $row['sekretaris']; ?>
                            <div class="line-ttd"></div>
                        </td>
                        <td>&nbsp;</td>
                        <td class="text-center">
                            <?php echo $row['ketua']; ?>
                            <div class="line-ttd"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div><!-- /.container -->
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            window.print();
        });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- jTebilang JavaScript -->
    <script src="../libs/jTerbilang/jTerbilang.js"></script>

</body>

</html>