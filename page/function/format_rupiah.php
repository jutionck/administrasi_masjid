<?php
function format_rupiah($rp)
{
	$jumlah = number_format($rp, 0, ",", ".");
	$rupiah = "Rp" . $jumlah;

	return $rupiah;
}
function format_rupiah_akunting($rp)
{
	$jumlah = number_format($rp, 0, ",", ".");
	$rupiah = '<div style="float: left;">Rp</div><div style="float: right;">' . $jumlah . '</div><div class="clear-both"></div>';

	return $rupiah;
}
function format_rupiah_kwitansi($rp)
{
	$jumlah = number_format($rp, 0, ",", ".");
	$rupiah = "Rp" . $jumlah . ",-";

	return $rupiah;
}
