<?php

$a = !empty($_GET['page']) ? $_GET['page'] : "reset";
$b = !empty($_GET['b']) ? $_GET['b'] : "reset";
$aset = !empty($_GET['aset']) ? $_GET['aset'] : " ";
$bln    = @$_POST["bln"];
$kdb = koneksidatabase();
$a = @$_GET["page"];

switch ($b) {
    default: curd_read();break;
}
mysqli_close($kdb);

function curd_read()
{
?>
<!-- Exportable Table -->
<div class="row clearfix js-sweetalert">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Laporan Data Aset
                </h2>
                <br>

                <form action="" method="post">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select name="bln" class="form-control show-tick">
                                        <option value="0">- Pilih Bulan -</option>
                                        <?php
                                        $bulans = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                        $noBulan = 1;
                                        for($n=0; $n<12; $n++) {
                                          echo '<option value="' . $noBulan . '">' . $bulans[$n] . '</option>';
                                          $noBulan++;
                                        }
                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">TAMPILKAN</button>
                            <a target="_blank" href = "./page/lap-asetcetak.php?id_masjid=<?php echo $_SESSION['id_masjid']?>&bln=<?php global $bln; echo $bln; ?>" class="btn btn-danger btn-lg m-l-15 waves-effect"><i class="fa fa-file-pdf-o" title="Download"></i></a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Terima</th>
                                <th>Nama Aset</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Terima</th>
                                <th>Nama Aset</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Keterangan</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                                global $kdb;
                                $hasil = sql_select();
                                $i = 1;
                                while ($t = mysqli_fetch_array($hasil)) {
                                    ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $t['tgl_aset']; ?></td>
                                    <td><?php echo $t['namaaset']; ?></td>
                                    <td><?php echo $t['jumlah']; ?></td>
                                    <td><?php echo $t['harga']; ?></td>
                                    <td><?php echo $t['total']; ?></td>
                                    <td><?php echo $t['keterangan']; ?></td>
                                </tr>

                                
                            <?php
                                    $i++;
                                } //WHILE
                                ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->
<?php
} //READ
?>

        


<!--SQL QUERY-->
<?php
function koneksidatabase()
{
    include('./koneksi/koneksi.php');
    return $kdb;
}


function sql_select()
{
    global $kdb;
    global $bln;
    if ($_SESSION['level'] == 'USER' AND $bln=="") 
    {
        $sql = "SELECT a.*, b.`nama_masjid` FROM `m_aset` as a,`m_masjid` as b WHERE a.`id_masjid`=b.`id_masjid` and MONTH(a.tgl_aset) = '$bln' and a.`id_masjid`= " . $_SESSION['id_masjid'];
    } 
    elseif ($_SESSION['level'] == 'USER' AND $bln!=="") 
    {
        $sql = "SELECT a.*, b.`nama_masjid` FROM `m_aset` as a,`m_masjid` as b WHERE a.`id_masjid`=b.`id_masjid` and MONTH(a.tgl_aset) = '$bln' and a.`id_masjid`= " . $_SESSION['id_masjid'];
    } 

    else //admin
    {
        $sql = "SELECT a.*, b.`nama_masjid` FROM `m_aset` as a,`m_masjid` as b WHERE a.`id_masjid`=b.`id_masjid`";
       
    } 
     $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
    return $hasil;
}



function sql_select_byid()
{
    global $kdb;
    global $aset;
    $sql = "SELECT * FROM `m_aset` where `idaset` = '$aset'";
    $hasil2 = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
    return $hasil2;
}
?>