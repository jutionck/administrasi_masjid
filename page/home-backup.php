<?php
$a = !empty($_GET['page']) ? $_GET['page'] : "reset";
?>

<?php
$kdb = koneksidatabase();
$a = @$_GET["page"];
$sql = @$_POST["sql"];

    switch ($sql) 
    {
        case "insert": sql_insert(); break; //Buat Input Type Hidden CURD CREATE
        case "update": sql_update(); break; //Buat Input Type Hidden CURD UPDATE
        case "delete": sql_delete(); break; //Buat Input Type Hidden CURD DELETE
    }

    switch ($a) 
    {
        case "reset" : curd_read(); break;
        default : curd_read(); break;
    }
mysqli_close($kdb);

function curd_read()
    {
       
?>
            <!-- Widgets -->
            <!-- Total Dana -->
            <div class="row clearfix">
                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <?php
                            $hasil = sql_jumoperasional();
                            $Operasional1 = mysqli_fetch_assoc($hasil);
                        ?>
                        <div class="content">
                            <div class="text">Total Dana Operasional</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">Rp. <?php echo number_format($Operasional1['Operasional'],2,',','.');?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <?php
                            $hasil = sql_jumpembangunan();
                            $Pembangunan1 = mysqli_fetch_assoc($hasil);
                        ?>
                        <div class="content">
                            <div class="text">Total Dana Pembangunan</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">Rp. <?php echo number_format($Pembangunan1['Pembangunan'],2,',','.');?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <?php
                            $hasil = sql_jumzis();
                            $ZIS1 = mysqli_fetch_assoc($hasil);
                        ?>
                        <div class="content">
                            <div class="text">Total Dana ZIS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">Rp. <?php echo number_format($ZIS1['ZIS'],2,',','.');?></div>
                        </div>
                    </div>
                </div>
                <!-- End Total Dana -->


                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">money_off</i>
                        </div>
                        <?php
                            $hasil = sql_jumpengoper();
                            $Operasional2 = mysqli_fetch_assoc($hasil);
                        ?>
                        <div class="content">
                            <div class="text">Pengeluaran Dana Operasioanl</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">Rp. <?php echo number_format($Operasional2['Operasional'],2,',','.');?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">money_off</i>
                        </div>
                        <?php
                            $hasil = sql_jumpengpem();
                            $Pembangunan2 = mysqli_fetch_assoc($hasil);
                        ?>
                        <div class="content">
                            <div class="text">Pengeluaran Dana Pembangunan</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Rp. <?php echo number_format($Pembangunan2['Pembangunan'],2,',','.');?></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">money_off</i>
                        </div>
                        <?php
                            $hasil = sql_jumpengzis();
                            $ZIS2 = mysqli_fetch_assoc($hasil);
                        ?>
                        <div class="content">
                            <div class="text">Pengeluaran Dana ZIS</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Rp. <?php echo number_format($ZIS2['ZIS'],2,',','.');?></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">aspect_ratio</i>
                        </div>
                        <?php $saldo1 = $Operasional1['Operasional'] - $Operasional2['Operasional'] ?>
                        <div class="content">
                            <div class="text">SALDO DANA OPERASIONAL</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Rp. <?php echo number_format($saldo1,2,',','.');?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">aspect_ratio</i>
                        </div>
                        <?php $saldo2 = $Pembangunan1['Pembangunan'] - $Pembangunan2['Pembangunan'] ?>
                        <div class="content">
                            <div class="text">SALDO DANA PEMBANGUNAN</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Rp. <?php echo number_format($saldo2,2,',','.');?></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">aspect_ratio</i>
                        </div>
                        <?php $saldo3 = $ZIS1['ZIS'] - $ZIS2['ZIS'] ?>
                        <div class="content">
                            <div class="text">SALDO DANA ZIS</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Rp. <?php echo number_format($saldo3,2,',','.');?></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- #END# Widgets -->
<!-- Exportable Table -->
<div class="row clearfix js-sweetalert">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Grafik
                </h2>
                <br>
            </div>
            <div class="body">

                Comming Soon..................
                <!-- <div id="INFLTIONRATE" style="min-width: 150px; width: 100%; min-height: 360px; margin: 0 auto"></div> -->
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->
<?php
}//READ
?>
<script type="text/javascript">
Highcharts.chart('INFLATIONRATE', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Lampung Inflation Rate'
    },
    xAxis: {
        categories: [{
            name: "2016",
            categories: ["I", "II", "III", "IV"]
        }, {
            name: "2017",
            categories: ["I", "II", "III", "IV"]
        }, {
            name: "2018",
            categories: ["I", "II", "III", "IV"]
        }, {
            name: "2019",
            categories: ["I","II"]
        }]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'yoy (%)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'DANA OPERASIONAL',
        data: [5.29, 3.15, 2.47, 2.78, 3.67, 4.91, 3.85, 3.01, 3.23, 2.80, 2.86, 2.72, 1.66, 2.76]

    }, {
        name: 'DANA PEMBANGUNAN',
        data: [4.45, 3.45, 3.07, 3.02, 3.61, 4.37, 3.73, 3.61, 3.40, 3.12, 2.88, 3.13, 2.48, 3.28]

    }]
});
</script>


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
        $sql = "SELECT * FROM `m_donatur`";
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        return $hasil;
    }

function sql_jumoperasional()
    {
        global $kdb;
        $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as Operasional FROM `m_petugas` as a,`m_masjid` as b, `tr_infaq` as c WHERE a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and b.`id_masjid`=".$_SESSION['id_masjid'];
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        return $hasil;
    }

function sql_jumzis()
    {
        global $kdb;
        $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as ZIS FROM `m_petugas` as a,`m_masjid` as b, `tr_zis` as c WHERE a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and b.`id_masjid`=".$_SESSION['id_masjid'];
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        return $hasil;
    }

function sql_jumpengoper()
    {
        global $kdb;
        $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as Operasional FROM `m_petugas` as a,`m_masjid` as b, `tr_pengeluaran` as c where a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and c.`jenis_pengeluaran` = 'OPERASIONAL' and b.`id_masjid` = ".$_SESSION['id_masjid'];
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        return $hasil;
    }

function sql_jumpengpem()
    {
        global $kdb;
        $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as Pembangunan FROM `m_petugas` as a,`m_masjid` as b, `tr_pengeluaran` as c where a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and c.`jenis_pengeluaran` = 'PEMBANGUNAN' and b.`id_masjid` = ".$_SESSION['id_masjid'];
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        return $hasil;
    }

function sql_jumpembangunan()
    {
        global $kdb;
        $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as Pembangunan FROM `m_petugas` as a,`m_masjid` as b, `tr_sodaqoh` as c WHERE a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and b.`id_masjid`=".$_SESSION['id_masjid'];
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        return $hasil;
    }

function sql_jumpengzis()
    {
        global $kdb;
        $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as ZIS FROM `m_petugas` as a,`m_masjid` as b, `tr_pengeluaran` as c where a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and c.`jenis_pengeluaran` = 'ZAKAT INFAQ SHODAQOH' and b.`id_masjid` = ".$_SESSION['id_masjid'];
        $hasil = mysqli_query($kdb, $sql) or die(mysqli_error());
        return $hasil;
    }

?>