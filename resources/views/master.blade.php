<!DOCTYPE html>
<?php
$page = $_SERVER['PHP_SELF'];
$sec = "600";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ARSIP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="refresh" content="<?php echo $sec ?>">
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    <!-- SELECT 2 -->

    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

    <!-- FONT ARABIC -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Scheherazade+New&display=swap" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css">

    @include('sweetalert::alert')
</head>



<body class="fixed-left">
    <?php

    use Illuminate\Support\Facades\Auth;

    $role = Auth::user()->role;
    ?>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <center>
                        <img src="{{ ('img/logopt.png') }}" width="110" class="logo">
                    </center>
                    <h4 class="text-white"></h4>
                </div>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="">
                        <div class="pull-left">
                            <button type="button" class="button-menu-mobile open-left waves-effect waves-light">
                                <i class="ion-navicon"></i>
                            </button>
                            <span class="clearfix"></span>
                        </div>
                        <form class="navbar-form pull-left" role="search">
                            <div class="form-group">
                            </div>
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </form>

                        <ul class="nav navbar-nav navbar-right pull-right">

                            <li class="hidden-xs">
                                <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="fa fa-crosshairs"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-user"></i></a>
                                <ul class="dropdown-menu">
                                    <!-- <li><a href="javascript:void(0)"> Profile</a></li>
                                    <li><a href="javascript:void(0)"><span class="badge badge-success pull-right">5</span> Settings </a></li>
                                    <li><a href="javascript:void(0)"> Lock screen</a></li>
                                    <li class="divider"></li> -->
                                    <li><a href="{{route('actionlogout')}}"> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->

        <div class=" left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!-- <div class="user-details">

                    <div class="user-info">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{Auth::user()->name}}</a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)"> Profile</a></li>
                                <li><a href="javascript:void(0)"> Settings</a></li>
                                <li><a href="javascript:void(0)"> Lock screen</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)"> Logout</a></li>
                            </ul>
                        </div>

                        <p class="text-muted m-0"><i class="fa fa-dot-circle-o text-success"></i> Online</p>
                    </div>
                </div> -->
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>
                        <?php if ($role == 1) { ?>
                            <li>
                                <a href="{{ url('/home') }}" class="waves-effect"><i class="ti-home"></i><span> Dashboard
                                    </span></a>
                            </li>
                        <?php } ?>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-settings"></i> <span>
                                    Data Masterrr</span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{url('/')}}" class="waves-effect"><i class="ti-user"></i><span>
                                            Jabatan</span></a></li>
                                <li><a href="{{url('/')}}" class="waves-effect"><i class="ti-user"></i><span>
                                            Divisi</span></a></li>
                            </ul>
                        </li>

                        <?php if ($role == 1) { ?>
                            <li><a href="{{url('/arsip')}}" class="waves-effect"><i class="ti-zip"></i><span>
                                        Arsip</span></a></li>
                        <?php  } else {
                        } ?>

                        <?php if ($role == 1) { ?>
                            <li><a href="{{url('/kategori')}}" class="waves-effect"><i class="ti-layers"></i><span>
                                        Data Kategori</span></a></li>
                        <?php  } else {
                        } ?>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-settings"></i> <span>
                                    Manajemen Akun</span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                            <ul class="list-unstyled">

                                <?php if ($role == 1) { ?>
                                    <li><a href="{{url('/user')}}" class="waves-effect"><i class="ti-user"></i><span> Tambah User</span></a></li>
                                <?php  } else {
                                } ?>

                                <li><a href="{{url('/gpass')}}" class="waves-effect"><i class="ti-unlock"></i><span>
                                            Ganti Password</span></a></li>
                            </ul>
                        </li>

                        <!--<li>
                            <a href="{{ url('/maintenance_coba') }}" class="waves-effect"><i class="ti-book"></i><span> Coba </span></a>
                        </li> -->

                        <!-- <li>
                            <a href="{{ url('/maintenance') }}" class="waves-effect"><i class="ti-check-box"></i><span> Maintenance </span></a>
                        </li> -->
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">

                        </div>
                    </div>

                    <div class="row">
                        <div class="alert alert-success alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            Hi <?php echo Auth::user()->name; ?>
                        </div>
                        @yield('konten')
                    </div>

                    <!-- End Row -->


                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer">
                2022 © TI-Tirta-Asasta
            </footer>

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->


    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!-- Datatables-->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <script src="assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>
    <script src="assets/pages/dashborad.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/pages/datatables.init.js"></script>
    <script src="assets/js/html5-qrcode.min.js"></script>

    <!-- SWEET ALERT -->
    <script src="assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="assets/pages/sweet-alert.init.js"></script>

    <!-- SELECT 2 -->
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

</body>

</html>