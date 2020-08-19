<?php
include("./function/format_tanggal.php");
$param = (isset($_GET['bln']) ? $_GET['bln'] : ceil($bulan));
$param2 = (isset($_GET['thn']) ? $_GET['thn'] : $tahun);

	// keperluan rekap kas
$param3 = $param2 ."-". $param ."-01";
$tgl_rekaps = getdate(strtotime($param3));
$tgl_rekap_tmp = mktime(0, 0, 0, $tgl_rekaps['mon']+1, $tgl_rekaps['mday']-1, $tgl_rekaps['year']);
$tgl_tampil_tmp = mktime(0, 0, 0, $tgl_rekaps['mon']+1, $tgl_rekaps['mday'], $tgl_rekaps['year']);
$tgl_rekap = date("Y-m-d", $tgl_rekap_tmp);
$tgl_tampil = date("Y-m-d", $tgl_tampil_tmp);

echo '<b>' . $tgl_rekap . '</b><br>';
echo $tgl_tampil .  '<br>';

echo $param3;
?>