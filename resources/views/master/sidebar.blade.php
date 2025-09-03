<!-- Main Sidebar Container -->

<style>
    .active:after {
        content: "" !important;
    }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <!-- <img src="#" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">Karmakar & Company</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transformer_List') }}" class="nav-link {{ Route::is('transformer_List') ? 'active' : '' }}">
                        <i class="fa fa-ship" aria-hidden="true"></i>
                        <p>Digital Register</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ Route::is('LabourList', 'attendance_sheet', 'attendance_list','transformer_cost_List') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('LabourList', 'attendance_sheet', 'attendance_list','transformer_cost_List') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Labour
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('LabourList') }}" class="nav-link {{ Route::is('LabourList') ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Labour</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attendance_page') }}" class="nav-link {{ Route::is('attendance_sheet') ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>New Attendance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attendance_sheet') }}" class="nav-link {{ Route::is('attendance_sheet') ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Daily Attendance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attendance_list') }}" class="nav-link {{ Route::is('attendance_list') ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Attendance List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transformer_cost_List') }}" class="nav-link {{ Route::is('transformer_cost_List') ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Labour Cost</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview {{ Route::is('unitList', 'categoryList', 'subcategoryList', 'rawMeterial_List', 'stockList') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('unitList', 'categoryList', 'subcategoryList', 'rawMeterial_List', 'stockList') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-industry"></i>
                        <p>
                            Material
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('unitList') }}" class="nav-link {{ Route::is('unitList') ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Unit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categoryList') }}" class="nav-link {{ Route::is('categoryList') ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Material Name</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subcategoryList') }}" class="nav-link {{ Route::is('subcategoryList') ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Specification</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rawMeterial_List') }}" class="nav-link {{ Route::is('rawMeterial_List') ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Raw Material List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stockList') }}" class="nav-link {{ Route::is('stockList') ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Raw Material Add</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ Route::is('rawmaterialBuyList') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('rawmaterialBuyList') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-industry"></i>
                        <p>
                            Quotation
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('rawmaterialBuyList') }}" class="nav-link {{ Route::is('rawmaterialBuyList') ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Buy</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ route('logistic_cost_List') }}" class="nav-link {{ Route::is('logistic_cost_List') ? 'active' : '' }}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <p>Logistics</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('miscenious_cost_List') }}" class="nav-link {{ Route::is('miscenious_cost_List') ? 'active' : '' }}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <p>Misclenious</p>
                    </a>
                </li>




                <li class="nav-item">
                    <a href="{{ route('user') }}" class="nav-link {{ Route::is('user') ? 'active' : '' }}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <p>User List</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>