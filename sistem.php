<?php
session_start();
include_once("./koneksi/koneksi.php");
global $kdb;
$kode = $_POST['username'];
$password = $_POST['password'];
$op = $_GET['op'];

if($op=="in"){
	$cek = mysqli_query($kdb, "SELECT a.*,b.* FROM `m_petugas` as a,`m_masjid` as b WHERE a.`id_masjid`=b.`id_masjid` and  a.`user` = '$kode' and a.`password` = '$password' AND a.`publish` = 'T'");
    if(mysqli_num_rows($cek)==1){//nilai 1 jika berhasil
    	$c = mysqli_fetch_array($cek);
    	$_SESSION['user'] = $c['user'];
    	$_SESSION['id_petugas'] = $c['id_petugas'];
    	$_SESSION['nama_petugas'] = $c['nama_petugas'];
    	$_SESSION['nama_masjid'] = $c['nama_masjid'];
    	$_SESSION['id_masjid'] = $c['id_masjid'];
    	$_SESSION['level'] = $c['level'];
    	header("location:index.php");	
								} //Penutup If Mysql Num Rowel
								else
								{

									?>
									<script language="JavaScript">
										alert('Username Belum Terdaftar atau Password  Salah. Silahkan diulang kembali! Atau Daftar Ulang');
										document.location='login.php';
									</script>
									<?php
								}
								
} //If Op=in

else if($op=="out")
{
	unset($_SESSION['user']);
	unset($_SESSION['level']);
	unset($_SESSION['password']);
	unset($_SESSION['id_petugas']);
	header("location:index.php");
}
?>