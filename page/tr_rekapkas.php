<?php
$a = !empty($_GET['page']) ? $_GET['page'] : "reset";
?>

<?php
$kdb        = koneksidatabase();
$a          = @$_GET["page"];
$sql        = @$_POST["sql"];
$tgl_awal   = @$_POST["tgl_awal"];
$tgl_akhir  = @$_POST["tgl_akhir"];

switch ($sql) {
    case "insert":
        sql_insert();
        break; //Buat Input Type Hidden CURD CREATE
    case "update":
        sql_update();
        break; //Buat Input Type Hidden CURD UPDATE
    case "delete":
        sql_delete();
        break; //Buat Input Type Hidden CURD DELETE
}

switch ($a) {
    case "reset":
        curd_read();
        break;
    default:
        curd_read();
        break;
}
mysqli_close($kdb);

function curd_read()
{

    ?>
            <!-- Widgets -->
            <!-- Total Dana -->
            <div class="row clearfix">
                <?php

                    /*Penerimaan*/
                    $hasil = sql_jumoperasional();
                    $Operasional1 = mysqli_fetch_assoc($hasil);
                    /*Pengeluaran*/
                    $hasil11 = sql_jumpengoper();
                    $Operasional2 = mysqli_fetch_assoc($hasil11);

                    $hasil2 = sql_jumpembangunan();
                    $Pembangunan1 = mysqli_fetch_assoc($hasil2);
                    $hasil22 = sql_jumpengpem();
                    $Pembangunan2 = mysqli_fetch_assoc($hasil22);

                    $hasil3 = sql_jumzis();
                    $ZIS1 = mysqli_fetch_assoc($hasil3);
                    $hasil33 = sql_jumpengzis();
                    $ZIS2 = mysqli_fetch_assoc($hasil33);

                    $periode_lalu_op = sql_saldo_periode_lalu_operasional();
                    $r_perlalu_op    = mysqli_fetch_array($periode_lalu_op);
                    $penerimaan_ini_op = sql_penerimaan_ini_operasional();
                    $r_penerimaan_op   = mysqli_fetch_array($penerimaan_ini_op);
                    $pengeluaran_ini_op = sql_pengeluaran_ini_operasional();
                    $r_pengeluaran_op   = mysqli_fetch_array($pengeluaran_ini_op);

                    $periode_lalu_pem = sql_saldo_periode_lalu_pembangunan();
                    $r_perlalu_pem    = mysqli_fetch_array($periode_lalu_pem);
                    $penerimaan_ini_pem = sql_penerimaan_ini_pembangunan();
                    $r_penerimaan_pem   = mysqli_fetch_array($penerimaan_ini_pem);
                    $pengeluaran_ini_pem = sql_pengeluaran_ini_pembangunan();
                    $r_pengeluaran_pem  = mysqli_fetch_array($pengeluaran_ini_pem);

                    $periode_lalu_zis = sql_saldo_periode_lalu_ZIS();
                    $r_perlalu_zis    = mysqli_fetch_array($periode_lalu_zis);
                    $penerimaan_ini_zis = sql_penerimaan_ini_ZIS();
                    $r_penerimaan_zis   = mysqli_fetch_array($penerimaan_ini_zis);
                    $pengeluaran_ini_zis = sql_pengeluaran_ini_ZIS();
                    $r_pengeluaran_zis  = mysqli_fetch_array($pengeluaran_ini_zis);

                    /*Saldo Akhir Operasional*/
                    $saldo1 = $Operasional1['Operasional'] - $Operasional2['Operasional'];
                    /*Saldo Sebelum Operasional*/
                    $saldoperiode = ($saldo1 - $r_penerimaan_op['PenerimaanIni']) + $r_pengeluaran_op['PengeluaranIni'];

                    /*Saldo Akhir Pembangunan*/
                    $saldo2 = $Pembangunan1['Pembangunan'] - $Pembangunan2['Pembangunan'];
                    /*Saldo Sebelum Pembangunan*/
                    $saldoperiode2 = ($saldo2 - $r_penerimaan_pem['PenerimaanIni']) + $r_pengeluaran_pem['PengeluaranIni'];

                    /*Saldo Akhir ZIS*/
                    $saldo3 = $ZIS1['ZIS'] - $ZIS2['ZIS'];
                    /*Saldo Sebelum ZIS*/
                    $saldoperiode3 = ($saldo3 - $r_penerimaan_zis['PenerimaanIni']) + $r_pengeluaran_zis['PengeluaranIni'];
                    ?>



            </div>
            <!-- #END# Widgets -->
            <!-- Exportable Table -->
            <div class="row clearfix js-sweetalert">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Rekap Kas Mingguan
                            </h2>
                            <br>
                            <form action="" method="post">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="Tanggal mulai..." name="tgl_awal">
                                            </div>
                                            <span class="input-group-addon">to</span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="Tanggal akhir..." name="tgl_akhir">
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
                                            <th class="text-center">Periode</th>
                                            <th class="text-center">Kas Operasional</th>
                                            <th class="text-center">Kas Pembangunan</th>
                                            <th class="text-center">Kas ZIS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Saldo Periode Lalu</td>
                                            <td class="text-right">Rp. <?php echo number_format($saldoperiode, 2, ',', '.'); ?></td>
                                            <td class="text-right">Rp. <?php echo number_format($saldoperiode2, 2, ',', '.'); ?></td>
                                            <td class="text-right">Rp. <?php echo number_format($saldoperiode2, 2, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Penerimaan</td>
                                            <td class="text-right">Rp. <?php echo number_format($r_penerimaan_op['PenerimaanIni'], 2, ',', '.'); ?></td>
                                            <td class="text-right">Rp. <?php echo number_format($r_penerimaan_pem['PenerimaanIni'], 2, ',', '.'); ?></td>
                                            <td class="text-right">Rp. <?php echo number_format($r_penerimaan_zis['PenerimaanIni'], 2, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pengeluaran</td>
                                            <td class="text-right">Rp. <?php echo number_format($r_pengeluaran_op['PengeluaranIni'], 2, ',', '.'); ?></td>
                                            <td class="text-right">Rp. <?php echo number_format($r_pengeluaran_pem['PengeluaranIni'], 2, ',', '.'); ?></td>
                                            <td class="text-right">Rp. <?php echo number_format($r_pengeluaran_zis['PengeluaranIni'], 2, ',', '.'); ?></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="success">
                                            <th>Total Saldo</th>
                                            <th class="text-right">Rp. <?php echo number_format($saldo1, 2, ',', '.'); ?></th>
                                            <th class="text-right">Rp. <?php echo number_format($saldo2, 2, ',', '.'); ?></th>
                                            <th class="text-right">Rp. <?php echo number_format($saldo3, 2, ',', '.'); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">

                            <button type="submit" name="rekap" class="btn btn-primary">CETAK</button>
                        </div>
                    </div><!-- /.panel-footer -->
                </div>
            </div>
            </div>
            <!-- #END# Exportable Table -->
        <?php
        } //READ
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
                        categories: ["I", "II"]
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
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_jumoperasional()
        {
            global $kdb;
            $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as Operasional FROM `m_petugas` as a,`m_masjid` as b, `tr_infaq` as c WHERE a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and b.`id_masjid`=" . $_SESSION['id_masjid'];
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_jumzis()
        {
            global $kdb;
            $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as ZIS FROM `m_petugas` as a,`m_masjid` as b, `tr_zis` as c WHERE a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and b.`id_masjid`=" . $_SESSION['id_masjid'];
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_jumpengoper()
        {
            global $kdb;
            $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as Operasional FROM `m_petugas` as a,`m_masjid` as b, `tr_pengeluaran` as c where a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and c.`jenis_pengeluaran` = 'OPERASIONAL' and b.`id_masjid` = " . $_SESSION['id_masjid'];
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_jumpengpem()
        {
            global $kdb;
            $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as Pembangunan FROM `m_petugas` as a,`m_masjid` as b, `tr_pengeluaran` as c where a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and c.`jenis_pengeluaran` = 'PEMBANGUNAN' and b.`id_masjid` = " . $_SESSION['id_masjid'];
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_jumpembangunan()
        {
            global $kdb;
            $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as Pembangunan FROM `m_petugas` as a,`m_masjid` as b, `tr_sodaqoh` as c WHERE a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and b.`id_masjid`=" . $_SESSION['id_masjid'];
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_jumpengzis()
        {
            global $kdb;
            $sql = "SELECT a.`id_petugas`,b.`id_masjid`, SUM(`nominal`) as ZIS FROM `m_petugas` as a,`m_masjid` as b, `tr_pengeluaran` as c where a.`id_masjid`=b.`id_masjid` and a.`id_petugas`=c.`id_petugas` and c.`jenis_pengeluaran` = 'ZAKAT INFAQ SHODAQOH' and b.`id_masjid` = " . $_SESSION['id_masjid'];
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_saldo_periode_lalu_operasional()
        {
            global $kdb;
            global $tgl_awal;
            global $tgl_akhir;
            if ($tgl_awal == "" and $tgl_akhir == "") {
                $sql = "SELECT sum(nominal) as SaldoLalu FROM tr_infaq WHERE tanggal = subdate(CURRENT_DATE(),6) AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            } else {
                $sql = "SELECT sum(nominal) as SaldoLalu FROM tr_infaq WHERE tanggal = subdate('$tgl_akhir',6) AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            }
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_penerimaan_ini_operasional()
        {
            global $kdb;
            global $tgl_awal;
            global $tgl_akhir;
            if ($tgl_awal == "" and $tgl_akhir == "") {
                $sql = "SELECT SUM(nominal) as PenerimaanIni FROM `tr_infaq` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND CURRENT_DATE() AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            } else {
                $sql = "SELECT SUM(nominal) as PenerimaanIni FROM `tr_infaq` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND id_petugas = '" . $_SESSION['id_petugas'] . "'  and jenis_infaq != '-'";
            }
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_pengeluaran_ini_operasional()
        {
            global $kdb;
            global $tgl_awal;
            global $tgl_akhir;
            if ($tgl_awal == "" and $tgl_akhir == "") {
                $sql = "SELECT SUM(nominal) as PengeluaranIni FROM `tr_pengeluaran` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND jenis_pengeluaran = 'OPERASIONAL' AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            } else {
                $sql = "SELECT SUM(nominal) as PengeluaranIni FROM `tr_pengeluaran` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND jenis_pengeluaran = 'OPERASIONAL' AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            }
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_saldo_periode_lalu_pembangunan()
        {
            global $kdb;
            global $tgl_awal;
            global $tgl_akhir;
            if ($tgl_awal == "" and $tgl_akhir == "") {
                $sql = "SELECT sum(nominal) as SaldoLalu FROM tr_sodaqoh WHERE id_petugas = '" . $_SESSION['id_petugas'] . "'";
            } else {
                $sql = "SELECT sum(nominal) as SaldoLalu FROM tr_sodaqoh WHERE tanggal = subdate('$tgl_awal',7) AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            }
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_penerimaan_ini_pembangunan()
        {
            global $kdb;
            global $tgl_awal;
            global $tgl_akhir;
            if ($tgl_awal == "" and $tgl_akhir == "") {
                $sql = "SELECT SUM(nominal) as PenerimaanIni FROM `tr_sodaqoh` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            } else {
                $sql = "SELECT SUM(nominal) as PenerimaanIni FROM `tr_sodaqoh` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            }
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_pengeluaran_ini_pembangunan()
        {
            global $kdb;
            global $tgl_awal;
            global $tgl_akhir;
            if ($tgl_awal == "" and $tgl_akhir == "") {
                $sql = "SELECT SUM(nominal) as PengeluaranIni FROM `tr_pengeluaran` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND jenis_pengeluaran = 'PEMBANGUNAN' AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            } else {
                $sql = "SELECT SUM(nominal) as PengeluaranIni FROM `tr_pengeluaran` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND jenis_pengeluaran = 'PEMBANGUNAN' AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            }
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_saldo_periode_lalu_ZIS()
        {
            global $kdb;
            global $tgl_awal;
            global $tgl_akhir;
            if ($tgl_awal == "" and $tgl_akhir == "") {
                $sql = "SELECT sum(nominal) as SaldoLalu FROM tr_zis WHERE id_petugas = '" . $_SESSION['id_petugas'] . "'";
            } else {
                $sql = "SELECT sum(nominal) as SaldoLalu FROM tr_zis WHERE tanggal = subdate('tgl_awal',7) AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            }
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_penerimaan_ini_ZIS()
        {
            global $kdb;
            global $tgl_awal;
            global $tgl_akhir;
            if ($tgl_awal == "" and $tgl_akhir == "") {
                $sql = "SELECT SUM(nominal) as PenerimaanIni FROM `tr_zis` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            } else {
                $sql = "SELECT SUM(nominal) as PenerimaanIni FROM `tr_zis` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            }
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        function sql_pengeluaran_ini_ZIS()
        {
            global $kdb;
            global $tgl_awal;
            global $tgl_akhir;
            if ($tgl_awal == "" and $tgl_akhir == "") {
                $sql = "SELECT SUM(nominal) as PengeluaranIni FROM `tr_pengeluaran` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND jenis_pengeluaran = 'ZAKAT INFAQ SHODAQOH' AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            } else {
                $sql = "SELECT SUM(nominal) as PengeluaranIni FROM `tr_pengeluaran` WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' AND jenis_pengeluaran = 'ZAKAT INFAQ SHODAQOH' AND id_petugas = '" . $_SESSION['id_petugas'] . "'";
            }
            $hasil = mysqli_query($kdb, $sql) or die(mysqli_error($kdb));
            return $hasil;
        }

        ?>