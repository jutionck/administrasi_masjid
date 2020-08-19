<?php
ob_start();
include'../framework/tcpdf/tcpdf.php';
$id_masjid = $_GET["id_masjid"];
$bln  = $_GET["bln"];
$kdb 		= koneksidatabase();
$bulan = date("m");
$param = (isset($_GET['bln']) ? $_GET['bln'] : ceil($bulan));
class MYPDF extends TCPDF {
	public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logoo.png';
        $this->Image($image_file, 15, 10, 22, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Header
        $html = '<p align="center"></p>';
		$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
    }
    public function Footer() {
		// Logo
		//$image_file = K_PATH_IMAGES.'kan.png';
        //$this->Image($image_file, 2, 270, 20, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Position at 15 mm from bottom
        //$this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
		$hasilsqlkode = sql_select_kode();
		$kode = mysqli_fetch_array($hasilsqlkode);
		global $param;
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'    '.'*** print date '.date ("d-m-Y").' --- Laporan Aset Masjid '.$kode["nama_masjid"].' Bulan ke- '.$param.' ***' , 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Andi Hatmoko');
$pdf->SetTitle('Laporan Data Aset');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(9, 20, 18);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 20);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// add a page
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 8);
	global $kdb;
	global $id_masjid;
	global $bln;
	global $param;
	$kepala = mysqli_query($kdb, "SELECT a.*, b.`nama_masjid` FROM `m_aset` as a,`m_masjid` as b WHERE a.`id_masjid`=b.`id_masjid` and MONTH(a.tgl_aset) = '$bln' and a.`id_masjid`='$id_masjid'");
	$kep = mysqli_fetch_array($kepala);
$header = '<p align="center"><font size="13"><b>LAPORAN DATA ASET MASJID '.$kep['nama_masjid'].'</b><br/></font>
			<font size="13" style="text-transform:uppercase">Bulan ke- '.$param.'<font></p>';
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 16, $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
$html ='<table border="1" cellspacing="0" cellpadding="3">
			<tr align="center" style="background-color: Lavender;">
				<th width="30"><b>No</b></th>
				<th width="90"><b>Tanggal Terima</b></th>
				<th width="155"><b>Nama Aset</b></th>
				<th width="50"><b>Jumlah</b></th>
				<th width="100"><b>Harga</b></th>
				<th width="100"><b>Total</b></th>
				<th width="150"><b>Keterangan</b></th>
			</tr>
			
			';
			$no=1;
			global $kdb;
			global $id_masjid;
			global $bln;
			$idPeg=mysqli_query($kdb, "SELECT a.*, b.`nama_masjid` FROM `m_aset` as a,`m_masjid` as b WHERE a.`id_masjid`=b.`id_masjid` and MONTH(a.tgl_aset) = '$bln' and a.`id_masjid`='$id_masjid'");
			while($peg=mysqli_fetch_array($idPeg)) { 
				$html .='<tr>
					<td align="center">'.$no++.'</td>
					<td align="center">'.$peg['tgl_aset'].'</td>
					<td>'.$peg['namaaset'].'</td>
					<td align="center">'.$peg['jumlah'].'</td>
					<td align="right"> Rp. '.number_format($peg['harga'],2).'</td>
					<td align="right">Rp. '.number_format($peg['total'],2).'</td>
					<td align="center">'.$peg['keterangan'].'</td>
				</tr>';
			} 
$html .= '</table><br /><br /><br />';
$html .= '<table cellpadding="1" border="0">
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="1"></td>
				<td width="1"></td>
				<td width="410"></td>
				<td>Bandar Lampung, '.date ("d-m-Y").'</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="1"></td>
				<td width="1"></td>
				<td width="410">Yang menerima,</td>
				<td>Yang menyerahkan</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td width="410">Sekretaris</td>
				<td width="410">Ketua </td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td width="410">___________________________</td>
				<td width="410">___________________________</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td width="410"></td>
				<td width="410"></td>
			</tr>
		</table>';
$pdf->writeHTML($html, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('ALL_'.$kep['nama_masjid'] .date ("dmY").'.pdf', 'I');

function koneksidatabase()
	{
		include('../koneksi/koneksi.php');
    	return $kdb;
	}
function sql_select_kode() //kode
	{
		global $kdb;
		global $id_masjid;
		global $bln;

		$sql = "SELECT a.*, b.`nama_masjid` FROM `m_aset` as a,`m_masjid` as b WHERE a.`id_masjid`=b.`id_masjid` and MONTH(a.tgl_aset) = '$bln' and a.`id_masjid`='$id_masjid'";
		$hasilkode = mysqli_query($kdb, $sql) or die (mysql_error());
		return $hasilkode;
	}
?>