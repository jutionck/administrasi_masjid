<?php
session_start();
ob_start();
if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
$page = !empty($_GET['page']) ? $_GET['page'] : "1";

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
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Administrator | Sistem Informasi Administrasi Keuangan Masjid</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />


    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <script src="plugins/code/highcharts.js"></script>
    <script src="plugins/code/modules/exporting.js"></script>
    <script src="plugins/code/modules/export-data.js"></script>
    <script src="plugins/code/grouped-categories.js"></script>

    <!-- Morris Chart Css-->
    <!--     <link href="plugins/morrisjs/morris.css" rel="stylesheet" /> -->

</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">MASJID <?php echo "" . $_SESSION['nama_masjid']; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                            <span><?php echo "" . $_SESSION['nama_petugas']; ?> <i class="fa fa-angle-down"></i></span>
                        </a>
                        <ul class="dropdown-menu settings-menu">
                            <li><a href="index.php?page=Masjid"><i class="fa fa-home"></i> Pengaturan Masjid</a></li>
                            <li><a href="index.php?page=ubahpassword"><i class="fa fa-exchange"></i> Pengaturan Akun</a></li>
                            <li><a href="sistem.php?op=out"><i class="fa fa-sign-out"></i> Keluar</a></li>

                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo "" . $_SESSION['nama_petugas']; ?></div>
                    <div class="email"><i class="fa fa-calendar fa-fw"></i>&nbsp;<?php echo $hari_ini . ", " . $tanggal . " " . $bulan_ini . " " . $tahun ?></div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU UTAMA</li>
                    <li <?php if ($page == "Home") {
                            echo 'class="active"';
                        } else {
                            echo 'class=""';
                        } ?>>
                        <a href="?page=Home">
                            <i class="material-icons">home</i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <?php if ($_SESSION['level'] == 'ADMIN') { ?>
                        <li <?php if ($page == "Donatur" or $page == "Petugas" or $page == "Masjid") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                            <a class="menu-toggle <?php if ($_SESSION['level'] !== 'ADMIN') {
                                                            echo "hidden";
                                                        } ?>">
                                <i class="material-icons">settings</i>
                                <span>Data Master</span>
                            </a>
                            <ul class="ml-menu">
                                <li <?php if ($page == "Masjid") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=Masjid">Data Masjid </a>
                                </li>

                                <li <?php if ($page == "Donatur") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=Donatur">Data Donatur </a>
                                </li>

                                <li <?php if ($page == "Petugas") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=Petugas">Data Petugas</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if ($page == "Infaq" or $page == "Shodaqoh" or $page == "Zakat") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                            <a class="menu-toggle">
                                <i class="material-icons">account_balance_wallet</i>
                                <span>Data Penerimaan</span>
                            </a>
                            <ul class="ml-menu">
                                <li <?php if ($page == "Infaq") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=Infaq">Penerimaan Dana Operasional </a>
                                </li>
                                <li <?php if ($page == "Shodaqoh") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=Shodaqoh">Penerimaan Dana Pembangunan</a>
                                </li>
                                <li <?php if ($page == "Zakat") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=Zakat">Penerimaan Dana ZIS </a>
                                </li>
                            </ul>
                        </li>

                        <li <?php if ($page == "pengeluaran-infaq" or $page == "pengeluaran-shodaqoh" or $page == "pengeluaran-zakat") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                            <a class="menu-toggle">
                                <i class="material-icons">near_me</i>
                                <span>Data Pengeluaran</span>
                            </a>
                            <ul class="ml-menu">
                                <li <?php if ($page == "pengeluaran-infaq") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=Pengeluaran">Pengeluaran Dana Operasional </a>
                                </li>
                                <li <?php if ($page == "pengeluaran-shodaqoh") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=Pengeluaran">Pengeluaran Dana Pembangunan </a>
                                </li>
                                <li <?php if ($page == "pengeluaran-zakat") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=Pengeluaran">Pengeluaran Dana ZIS </a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($_SESSION['level'] == 'USER') {
                        if (isset($menuparent) && $menuparent == "konten_organisasi") {
                            echo '<li class="active">';
                        } else {
                            echo '<li>';
                        }
                        ?>
                        <li>
                            <a class="menu-toggle <?php if ($_SESSION['level'] == 'ADMIN') {
                                                            echo "hidden";
                                                        } ?>">
                                <i class="material-icons">gavel</i>
                                <span>Struktur Organisasi</span>
                            </a>
                            <ul class="ml-menu">
                                <?php
                                    include_once('./koneksi/koneksi.php');
                                    global $kdb;
                                    $sql_menu = "SELECT * FROM m_organisasi ORDER BY menu_konten ASC";
                                    $ress_menu = mysqli_query($kdb, $sql_menu);
                                    while ($menu = mysqli_fetch_array($ress_menu)) {
                                        if ($page == $menu['judul_konten']) {
                                            echo '<li><a href="index.php?page=struktur&org=' . $menu['id_konten'] . '" class="active">' . $menu['menu_konten'] . '</a></li>';
                                        } else {
                                            echo '<li><a href="index.php?page=struktur&org=' . $menu['id_konten'] . '">' . $menu['menu_konten'] . '</a></li>';
                                        }
                                    }
                                    ?>
                            </ul><!-- /.nav-second-level -->

                        <li <?php if ($page == "Donatur") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                            <a href="?page=Donatur">
                                <i class="material-icons">supervisor_account</i>
                                <span>Data Donatur Masjid</span>
                            </a>
                        </li>
                        <li <?php if ($page == "Aset") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                            <a href="?page=Aset">
                                <i class="material-icons">gavel</i>
                                <span>Data Aset Masjid</span>
                            </a>
                        </li>
                    <?php } ?>

                    <li <?php if ($page == "Infaq" or $page == "Shodaqoh" or $page == "Zakat") {
                            echo 'class="active"';
                        } else {
                            echo 'class=""';
                        } ?>>
                        <a class="menu-toggle <?php if ($_SESSION['level'] == 'ADMIN') {
                                                    echo "hidden";
                                                } ?>">
                            <i class="material-icons">account_balance_wallet</i>
                            <span>Data Penerimaan</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if ($page == "Infaq") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                                <a href="?page=Infaq">Penerimaan Dana Operasional </a>
                            </li>
                            <li <?php if ($page == "Shodaqoh") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                                <a href="?page=Shodaqoh">Penerimaan Dana Pembangunan</a>
                            </li>
                            <li <?php if ($page == "Zakat") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                                <a href="?page=Zakat">Penerimaan Dana ZIS </a>
                            </li>
                        </ul>
                    </li>

                    <li <?php if ($page == "pengeluaran-operasional" or $page == "pengeluaran-pembangunan" or $page == "pengeluaran-zis") {
                            echo 'class="active"';
                        } else {
                            echo 'class=""';
                        } ?>>
                        <a class="menu-toggle <?php if ($_SESSION['level'] == 'ADMIN') {
                                                    echo "hidden";
                                                } ?>">
                            <i class="material-icons">near_me</i>
                            <span>Data Pengeluaran</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if ($page == "pengeluaran-operasional") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=pengeluaran-operasional">Pengeluaran Dana Operasional </a>
                                </li>
                                <li <?php if ($page == "pengeluaran-pembangunan") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=pengeluaran-pembangunan">Pengeluaran Dana Pembangunan </a>
                                </li>
                                <li <?php if ($page == "pengeluaran-zis") {
                                            echo 'class="active"';
                                        } else {
                                            echo 'class=""';
                                        } ?>>
                                    <a href="?page=pengeluaran-zis">Pengeluaran Dana ZIS </a>
                                </li>
                        </ul>
                    </li>

                    <li <?php if ($page == "lap-aset" or $page == "lap-operasional" or $page == "lap-pembangunan" or $page == "lap-zis" or $page == "lap-total") {
                            echo 'class="active"';
                        } else {
                            echo 'class=""';
                        } ?>>
                        <a class="menu-toggle <?php if ($_SESSION['level'] == 'ADMIN') {
                                                    echo "hidden";
                                                } ?>">
                            <i class="material-icons">print</i>
                            <span>Laporan</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if ($page == "lap-aset") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                                <a href="?page=lap-aset">Laporan Aset</a>
                            </li>
                            <li <?php if ($page == "lap-operasional") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                                <a href="?page=lap-operasional">Kas Dana Operasional</a>
                            </li>
                            <li <?php if ($page == "lap-pembangunan") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                                <a href="?page=lap-pembangunan">KAS Dana Pembangunan</a>
                            </li>
                            <li <?php if ($page == "lap-zis") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                                <a href="?page=lap-zis">KAS Dana ZIS</a>
                            </li>
                           <!--  <li <?php if ($page == "lap-total") {
                                    echo 'class="active"';
                                } else {
                                    echo 'class=""';
                                } ?>>
                                <a href="?page=lap-total">KAS TOTAL</a>
                            </li> -->
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- Footer -->
            <!--<div class="legal">-->
            <!--    <div class="copyright">-->
            <!--        &copy; 2019 <a href="https://mipdevp.com" target="_blank">MIPDevp</a></span><span class="float-md-right d-xs-block d-md-inline-block"> Template By <a href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank" class="text-bold-800 grey darken-2">-->
            <!--                <p>AdminBSB - Material Design</p>-->
            <!--            </a></span>-->
            <!--    </div>-->
            <!--    <div class="version">-->
            <!--        <b>Version: </b> 1.0-->
            <!--    </div>-->
            <!--</div>-->
            <!-- #Footer -->
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <!--Main Menu-->
    <section class="content">
        <div class="container-fluid">
            <?php
            if ($_SESSION['level'] == 'ADMIN') {
                switch ($page) {
                    case ('Masjid'):
                        include_once('./page/m_masjid.php');
                        break;
                    case ('Donatur'):
                        include_once('./page/m_donatur.php');
                        break;
                    case ('Petugas'):
                        include_once('./page/m_petugas.php');
                        break;
                    default:
                        include_once('./page/home.php');
                        break;
                }
            } else {
                switch ($page) {
                    case ('Donatur'):
                        include_once('./page/m_donatur.php');
                        break;
                    case ('Aset'):
                        include_once('./page/m_aset.php');
                        break;
                    case ('ubahpassword'):
                        include_once('./page/ubahpassword.php');
                        break;
                    case ('struktur'):
                        include_once('./page/organisasi.php');
                        break;
                    case ('Zakat'):
                        include_once('./page/tr_zakat.php');
                        break;
                    case ('Shodaqoh'):
                        include_once('./page/tr_shodaqoh.php');
                        break;
                    case ('Infaq'):
                        include_once('./page/tr_infaq.php');
                        break;
                    case ('pengeluaran-operasional'):
                        include_once('./page/pengeluaran-operasional.php');
                        break;
                    case ('pengeluaran-pembangunan'):
                        include_once('./page/pengeluaran-pembangunan.php');
                        break;
                    case ('pengeluaran-zis'):
                        include_once('./page/pengeluaran-zis.php');
                        break;
                    case ('Home'):
                        include_once('./page/home.php');
                        break;
                    case ('Masjid'):
                        include_once('./page/m_masjid.php');
                        break;
                    case ('RekapKas'):
                        include_once('./page/tr_rekapkas.php');
                        break;
                    case ('lap-operasional'):
                        include_once('./page/lap-operasional.php');
                        break;
                    case ('lap-pembangunan'):
                        include_once('./page/lap-pembangunan.php');
                        break;
                    case ('lap-zis'):
                        include_once('./page/lap-zis.php');
                        break;
                    case ('lap-total'):
                        include_once('./page/lap-total.php');
                        break;
                    case ('lap-aset'):
                        include_once('./page/lap-aset.php');
                        break;
                    // case ('KasTahunan'):
                    //     include_once('./page/Kastahunan.php');
                    //     break;
                    // case ('KasTahunan_cetak'):
                    //     include_once('./page/Kastahunan_cetak.php');
                    //     break;
                    default:
                        include_once('./page/home.php');
                        break;
                }
            }
            ?>
        </div>
    </section>
    <!--END-->

    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- CKeditor -->
    <script src="plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('isi_konten', {
            toolbar: [{
                    name: 'document',
                    groups: ['source', 'savenew'],
                    items: ['Source', '-', 'Save', 'NewPage']
                },
                {
                    name: 'clipboard',
                    groups: ['cutcopypaste', 'undoredo'],
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo']
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'bidi'],
                    items: ['BulletedList', 'NumberedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'BidiLtr', 'BidiRtl']
                },
                {
                    name: 'insert',
                    items: ['Table', 'HorizontalRule', 'SpecialChar', 'PageBreak']
                },
                '/',
                {
                    name: 'styles',
                    items: ['Format', 'Font', 'FontSize']
                },
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat']
                },
                {
                    name: 'align',
                    items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                },
                {
                    name: 'others',
                    items: ['-']
                },
                {
                    name: 'tools',
                    items: ['Maximize', 'ShowBlocks']
                },
                {
                    name: 'about',
                    items: ['About']
                }
            ]
        });
    </script>
    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
</body>

</html>