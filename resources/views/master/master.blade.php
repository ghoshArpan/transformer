<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard ! @yield('title')</title>

    <!-------------------------------- Ionicons --------------------------------------->
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <!---------------------------- Tempusdominus Bootstrap 4 -------------------------->
    <link rel="stylesheet" href="{{ asset('admin_css/tempusdominus-bootstrap-4.min.css') }}">
    <!----------------------------- iCheck ---------------------------------------------->
    <link rel="stylesheet" href="{{ asset('admin_css/icheck-bootstrap.min.css') }}">
    <!------------------------------------ JQVMap -------------------------------------->
    {{-- <link rel="stylesheet" href="{{ asset('admin_css/jqvmap.min.css') }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_css/adminlte.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin_css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin_css/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin_css/summernote-bs4.min.css') }}">


    <link rel="stylesheet" href="{{ asset('bootstrapDataTables/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrapDataTables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('confirm_css/jquery-confirm.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrapvalidator/dist/css/bootstrapValidator.min.css') }}">

    <link rel="stylesheet" href="{{ asset('bootstrapDataTables/css/datepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('multiselect/bootstrap-multiselect.css') }}">
    <!----------------------------- jQuery ---------------------------------------->
    <script src="{{ asset('admin_js/jquery.min.js ') }}"></script>

    {{-- <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.css" /> --}}

    <style>
        td {
  white-space: normal !important;  /* Allows text to wrap */
  word-break: break-word !important;  /* Breaks long words */
  overflow-wrap: break-word !important;
  vertical-align: top !important;  /* Aligns content to the top of the cell */
  padding: 8px !important;  /* Adds some spacing inside the cell */
  max-width: 200px !important;  /* Optional: Limits width to force wrapping */
}

    /* Full-page loader */
    .loader-overlay {
        display: none;
        /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .loader {
        width: 50px;
        height: 50px;
        border: 5px solid white;
        border-top: 5px solid transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .form-horizontal .has-feedback .form-control-feedback {
        top: 0;
        right: 15px;
    }

    .has-error {
        color: red;
        border-color: red;
    }

    .has-error .form-control {

        border-color: red;
    }

    .has-success .form-control {

        border-color: green;
    }

    #vehicle_user .inputGroupContainer .form-control-feedback,
    #vehicle_user .selectContainer .form-control-feedback {
        top: 0;
        right: -15px;
    }

    .has-error .form-control-feedback {
        color: #a94442;
    }

    .form-control-feedback {
        position: absolute;
        /* top: 25px;
            right: 0; */
        z-index: 2;
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
        margin-left: 97%;
        margin-top: -38px;
    }

    .has-feedback .form-control-feedback {
        top: 2px;
        right: 15px;
    }

    .content-header {
        margin-bottom: 19px;
    }

    .glyphicon {
        position: relative;
        top: 1px;
        /* display: inline-block; */
        font-family: 'Glyphicons Halflings';
        font-style: normal;
        font-weight: 400;
        /* line-height: 1; */
        -webkit-font-smoothing: antialiased;
        /* -moz-osx-font-smoothing: grayscale; */
    }

    /* .glyphicon-remove:before {
            content: "\e014";
              } */
    .required:after {
        content: '*';
        color: red;
        font-weight: 700;
        margin-left: 4px;
    }

    /* .form-control{
             border-radius: 10px !important;
              } */


    /* ..... */

    .loader {
        position: fixed;
        z-index: 99999;
        height: 2em;
        width: 2em;
        overflow: show;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }

    /* Transparent Overlay */
    .loader:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
    }

    /* :not(:required) hides these rules from IE9 and below */
    .loader:not(:required) {
        /* hide "loading..." text */
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }

    .loader:not(:required):after {
        content: '';
        display: block;
        font-size: 10px;
        width: 1em;
        height: 1em;
        margin-top: -0.5em;
        -webkit-animation: spinner 150ms infinite linear;
        -moz-animation: spinner 150ms infinite linear;
        -ms-animation: spinner 150ms infinite linear;
        -o-animation: spinner 150ms infinite linear;
        animation: spinner 150ms infinite linear;
        border-radius: 0.5em;
        -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
    }

    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-o-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    </style>
     <style>
        /* Ensure the table has enough space */
       
    </style>
    <style>
    .check-icon {
        font-size: 20px;
        color: green;
    }

    .custom-checkbox {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        accent-color: green;
    }

    body {
        background-color: #f8f9fa;
    }

    .container {
        margin-top: 50px;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
        border-radius: 10px;
        overflow: hidden;
    }




.col-sm-12.alert-success{
    max-width: 97% !important;
    /* width: 90%; */
    margin-left: 17px !important;
}
.thead tr th{
    background-color: rgb(157, 178, 180);
    color: black;  
}

        
 
    th {
        background-color: rgb(2, 108, 122);
        color: white;
    }

    .content-header {
        padding: 3px .5rem !important;
    }

    .add_button {
        background-color: rgb(2, 108, 122);
        color: white;
    }

    .btn-submit {
        width: 100%;
        border-radius: 20px;
    }

    .check-icon {
        font-size: 20px;
        border-radius: 20px;

        color: green;
    }

    button {
        border-radius: 6px
    }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="loader" id="pLoader" style="display:none">Loading&#8230;</div>
        <!-- Preloader -->

        <!-- <div class="preloader flex-column justify-content-center align-items-center">
             <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
               </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fa fa-bars" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> -->

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <!-- <span class="badge badge-danger navbar-badge">3</span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                                class="dropdown-item">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                        <!-- <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"> -->
                        <!-- Message Start -->
                        <!-- <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div> -->
                        <!-- Message End -->
                        <!-- </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"> -->
                        <!-- Message Start -->
                        <!-- <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div> -->
                        <!-- Message End -->
                        <!-- </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li> -->
                        <!-- Notifications Dropdown Menu -->
                        <!-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true"
                        href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        @include('master.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            {{-- <h1 class="m-0">Dashboard</h1> --}}
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li> --}}
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="#"></a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <div class="loader-overlay" id="loader">
    <div class="loader"></div>
</div>
    <!-- ./wrapper -->

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin_js/jquery-ui.min.js ') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $(document).ready(function() {
            $("#loader").fadeOut();
        });
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin_js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('admin_js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('admin_js/sparkline.js') }}"></script>

    <!-- JQVMap -->
    <script src="{{ asset('admin_js/jquery.vmap.min.js') }}"></script>
    {{-- <script src="{{asset('admin_js/jquery.vmap.usa.js')}}"></script> --}}

    <!-- jQuery Knob Chart -->
    <script src="{{ asset('admin_js/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('admin_js/moment.min.js') }}"></script>
    <script src="{{ asset('admin_js/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin_js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('admin_js/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin_js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin_js/adminlte.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('admin_js/demo.js') }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    <script src="{{ asset('admin_js/dashboard.js') }}"></script>

    <script src="{{ asset('confirm_js/jquery-confirm.js') }}"></script>
    <script src="{{ asset('bootstrapDataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bootstrapvalidator/dist/js/bootstrapValidator.min.js') }}"></script>
    <script src="{{ asset('bootstrapDataTables/js/datepicker.min.js') }}"></script>

    <script src="{{ asset('bootstrap_date/date_picker.min.js') }}"></script>

    <script src="{{ asset('multiselect/bootstrap-multiselect.min.js') }}"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js"
        integrity="sha512-lxQ4VnKKW7foGFV6L9zlSe+6QppP9B2t+tMMaV4s4iqAv4iHIyXED7O+fke1VeLNaRdoVkVt8Hw/jmZ+XocsXQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

   <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">

<!-- jQuery (Required for DataTables) -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

   
   <script>
        new DataTable('#group_list', {
            scrollX: true,
                
});
//     new DataTable('#group_list', {
//         fixedColumns: {
//         start: 1,
//         end: 1
//     },
//     paging: false,
//     scrollCollapse: true,
//     scrollX: true,
// });
$(".table").dataTable();

    // For DataTables >=1.10, use:

    $('.table_inside').dataTable({
        searching: false,
        paging: false,
        info: false
    });

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    </script>

    @yield('script')
</body>

</html>