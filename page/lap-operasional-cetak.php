<?php
// deskripsi halaman
include('../koneksi/koneksi.php');
global $kdb;
$masjid = $_GET['masjid'];
$petugas = $_GET['petugas'];
include_once("./function/format_rupiah.php");
include_once("./function/format_tanggal.php");
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

// parameter tahun
$param = (isset($_GET['bln']) ? $_GET['bln'] : ceil($bulan));
$param2 = (isset($_GET['thn']) ? $_GET['thn'] : $tahun);
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
$sql_infaq = "SELECT * FROM tr_infaq WHERE id_petugas = '".$petugas."' ORDER BY tanggal ASC";
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
$sql_keluar = "SELECT * FROM tr_pengeluaran  WHERE id_petugas = '".$petugas."' AND jenis_pengeluaran = 'OPERASIONAL' ORDER BY tanggal ASC";
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

$sql = "SELECT * FROM m_masjid where id_masjid = " . $masjid;
$hasil = mysqli_query($kdb, $sql);
$r = mysqli_fetch_array($hasil);

// deskripsi halaman
$pagedesc = "Masjid ". $r['nama_masjid']. "- Laporan Kas Keuangan Bulanan - Periode " . $bulans[$param] ." ". $param2;
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
                <tbody>
                    <tr>
                        <td rowspan="3" width="16%" class="text-center">
                            <img src="../images/<?php echo $r['foto']; ?>" alt="logo-dkm" width="80" />
                        </td>
                        <td class="text-center">
                            <h3>DEWAN KEMAKMURAN MASJID (DKM)</h3>
                        </td>
                        <td rowspan="3" width="16%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <h2>Masjid <?php echo $r['nama_masjid']; ?></h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"><?php echo $r['alamat']; ?></td>
                    </tr>
                </tbody>
            </table>
            <hr class="line-top" />
        </div>
    </section>

    <section id="body-of-report">
        <div class="container-fluid">
            <h4 class="text-center">LAPORAN KAS KEUANGAN BULANAN</h4>
            <h5 class="text-center">Periode <?php echo $bulans[$param] . " " . $param2 ?></h5>
            <br />
            <table class="table table-bordered table-keuangan">
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
                            <?php echo $r['bendahara']; ?>
                            <div class="line-ttd"></div>
                        </td>
                        <td class="text-center">
                            <?php echo $r['sekretaris']; ?>
                            <div class="line-ttd"></div>
                        </td>
                        <td>&nbsp;</td>
                        <td class="text-center">
                            <?php echo $r['ketua']; ?>
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