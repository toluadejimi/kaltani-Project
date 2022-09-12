<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>KALTANI MIS</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <!-- Start GA -->
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css"> -->

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons.min.css">
    <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/components.css">
    
    <!-- Start GA 
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    
    
 <!--   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->


    
    <!-- /END GA -->
    <style>
        .dataTables_filter {
    display: block !important;
}
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                     
                    </div>
                </form>
                <ul class="navbar-nav navbar-right">
                    
                    <li ><a href="#" 
                            class="nav-link nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block">{{Auth::user()->first_name}}</div>
                        </a>
                        
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/dashboard">
                        <img src="img/logo.png')}}" class="img-fluid" width="90px" alt="KaltaniIms" srcset="">
                        </a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="/dashboard">
                            <img src="img/logo.png')}}" class="img-fluid" alt="KaltaniIms" srcset="">
                        </a>
                    </div>
                    
                     @if(Auth::user()->role->name == 'Sales Manager')
                                            <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="/dashboard"><i class="fas fa-solid fa-grid-horizontal fa-3x"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Items</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/item">Create Items</a></li>
                                <!--<li><a class="nav-link" href="/bailing_item"> Create Bailing Items</a></li>-->
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-solid fa-map-location fa-3x"></i>
                                <span>Factory / Collections</span>
                            </a>
                          
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/locations">Create Location</a></li>
                                <li><a class="nav-link" href="/addCollection">Add Collection</a></li>
                                <li><a class="nav-link" href="/collectioncenter">Collection Center List</a></li>
                                <li><a class="nav-link" href="/factory">Factory List</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/sorting"><i class="fas fa-solid fa-filter-list fa-3x"></i>
                                <span>Sorting</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/bailing"><i class="fas fa-solid fa-grid-2-plus fa-3x"></i>
                                <span>Bailing</span>
                            </a>
                        </li>
                        <li class="dropdown">
                             <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-solid fa-arrow-right-arrow-left fa-3x"></i>
                                <span>Transfers</span>
                            </a>
                            <!--<a class="nav-link" href="/transfer"><i class="fas fa-solid fa-arrow-right-arrow-left fa-3x"></i>-->
                            <!--    <span>Transfer</span>-->
                            <!--</a>-->
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/transfer">Transfer</a></li>
                                <li><a class="nav-link" href="/sortedtransfer">Sorted Transfer</a></li>
                            </ul>
                        </li>
                        <!--<li>-->
                        <!--    <a class="nav-link" href="/factory"><i-->
                        <!--            class="fas fa-solid fa-industry-windows fa-3x"></i>-->
                        <!--        <span>Factory</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="/users" data-toggle="dropdown"><i class="fas fa-solid fa-users fa-3x"></i>
                                <span>Users</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/users">Create Users</a></li>
                                <li><a class="nav-link" href="/manage/role">Create Role</a></li>
                                <li><a class="nav-link" href="/customers">Customers</a></li>
                                <li><a class="nav-link" href="/agents">Agents</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/recycle"><i class="fas fa-solid fa-recycle fa-3x"></i>
                                <span>Recycle</span>
                            </a>
                        </li>
                         
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="/sales" data-toggle="dropdown"><i class="fas fa-solid fa-messages-dollar fa-3x"></i>
                                <span>Sales</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/sales">Flesk Sales</a></li>
                                <li><a class="nav-link" href="/salesBailed">Bailed Sales</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="#"><i
                                    class="fas fa-solid fa-file-chart-column fa-3x"></i>
                                <span>Report</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/collection_report">Collection Report</a></li>
                                <li><a class="nav-link" href="/bailed_report">Bailing Report</a></li>
                                <li><a class="nav-link" href="/sorting_report">Sorting Report</a></li>
                                <li><a class="nav-link" href="/transfered_report">Transfered Report</a></li>
                                <li><a class="nav-link" href="/recycled_report">Recycled Report</a></li>
                                <li><a class="nav-link" href="/sales_report">Flesk Sales Report</a></li>
                                <li><a class="nav-link" href="/salesbailed_report">Bailed Sales Report</a></li>
                            </ul>
                        </li>
                         <li>
                            <a class="nav-link" href="/update-password"><i
                            <i class="fa-solid fa-unlock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/logout"><i
                                    class="fas fa-solid fa-arrow-right-from-bracket fa-3x"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                        
                        @elseif(Auth::user()->role->name == 'Admin')
                         <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="/dashboard"><i class="fas fa-solid fa-grid-horizontal fa-3x"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Items</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/item">Create Items</a></li>
                                <!--<li><a class="nav-link" href="/bailing_item"> Create Bailing Items</a></li>-->
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-solid fa-map-location fa-3x"></i>
                                <span>Factory / Collections</span>
                            </a>
                          
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/locations">Create Location</a></li>
                                <li><a class="nav-link" href="/addCollection">Add Collection</a></li>
                                <li><a class="nav-link" href="/collectioncenter">Collection Center List</a></li>
                                <li><a class="nav-link" href="/factory">Factory List</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/sorting"><i class="fas fa-solid fa-filter-list fa-3x"></i>
                                <span>Sorting</span>
                            </a>
                        </li>
                        
                        <li>
                            <a class="nav-link" href="/drop-off"><i class="fas fa-solid fa-truck-fast"></i>
                                <span>Drop off List</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/agent-request"><i class="fas fa-solid fa-user"></i>
                                <span>Agent Request</span>
                            </a>
                        </li>
                         <li>
                            <a class="nav-link" href="/fund-agent"><i class="fas fa-solid fa-money-bills"></i></i>
                                <span>Fund Agent</span>
                            </a>
                        </li>
                          <li>
                            <a class="nav-link" href="/transactions"><i class="fas fa-solid fa-money-from-bracket"></i></i></i>
                                <span>Transactions</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/bailing"><i class="fas fa-solid fa-grid-2-plus fa-3x"></i>
                                <span>Bailing</span>
                            </a>
                        </li>
                        <li class="dropdown">
                             <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-solid fa-arrow-right-arrow-left fa-3x"></i>
                                <span>Transfers</span>
                            </a>
                            <!--<a class="nav-link" href="/transfer"><i class="fas fa-solid fa-arrow-right-arrow-left fa-3x"></i>-->
                            <!--    <span>Transfer</span>-->
                            <!--</a>-->
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/transfer">Transfer</a></li>
                                <li><a class="nav-link" href="/sortedtransfer">Sorted Transfer</a></li>
                            </ul>
                        </li>
                        <!--<li>-->
                        <!--    <a class="nav-link" href="/factory"><i-->
                        <!--            class="fas fa-solid fa-industry-windows fa-3x"></i>-->
                        <!--        <span>Factory</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="/users" data-toggle="dropdown"><i class="fas fa-solid fa-users fa-3x"></i>
                                <span>Users</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/users">Create Users</a></li>
                                <li><a class="nav-link" href="/manage/role">Create Role</a></li>
                                <li><a class="nav-link" href="/customers">Customers</a></li>
                                <li><a class="nav-link" href="/agents">Agents</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/recycle"><i class="fas fa-solid fa-recycle fa-3x"></i>
                                <span>Recycle</span>
                            </a>
                        </li>
                         
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="/sales" data-toggle="dropdown"><i class="fas fa-solid fa-messages-dollar fa-3x"></i>
                                <span>Sales</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/sales">Flesk Sales</a></li>
                                <li><a class="nav-link" href="/salesBailed">Bailed Sales</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="#"><i
                                    class="fas fa-solid fa-file-chart-column fa-3x"></i>
                                <span>Report</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/collection_report">Collection Report</a></li>
                                <li><a class="nav-link" href="/bailed_report">Bailing Report</a></li>
                                <li><a class="nav-link" href="/sorting_report">Sorting Report</a></li>
                                <li><a class="nav-link" href="/transfered_report">Transfered Report</a></li>
                                <li><a class="nav-link" href="/recycled_report">Recycled Report</a></li>
                                <li><a class="nav-link" href="/sales_report">Flesk Sales Report</a></li>
                                <li><a class="nav-link" href="/salesbailed_report">Bailed Sales Report</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/update-password"><i
                            <i class="fa-solid fa-unlock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/logout"><i
                                    class="fas fa-solid fa-arrow-right-from-bracket fa-3x"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                        @elseif(Auth::user()->role->name == 'GM Operations')
                        <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="/dashboard"><i class="fas fa-solid fa-grid-horizontal fa-3x"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Items</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/item">Create Items</a></li>
                                <!--<li><a class="nav-link" href="/bailing_item"> Create Bailing Items</a></li>-->
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-solid fa-map-location fa-3x"></i>
                                <span>Factory / Collections</span>
                            </a>
                          
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/locations">Create Location</a></li>
                                <li><a class="nav-link" href="/addCollection">Add Collection</a></li>
                                <li><a class="nav-link" href="/collectioncenter">Collection Center List</a></li>
                                <li><a class="nav-link" href="/factory">Factory List</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/sorting"><i class="fas fa-solid fa-filter-list fa-3x"></i>
                                <span>Sorting</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/bailing"><i class="fas fa-solid fa-grid-2-plus fa-3x"></i>
                                <span>Bailing</span>
                            </a>
                        </li>
                        <li class="dropdown">
                             <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-solid fa-arrow-right-arrow-left fa-3x"></i>
                                <span>Transfers</span>
                            </a>
                            <!--<a class="nav-link" href="/transfer"><i class="fas fa-solid fa-arrow-right-arrow-left fa-3x"></i>-->
                            <!--    <span>Transfer</span>-->
                            <!--</a>-->
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/transfer">Transfer</a></li>
                                <li><a class="nav-link" href="/sortedtransfer">Sorted Transfer</a></li>
                            </ul>
                        </li>
                        <!--<li>-->
                        <!--    <a class="nav-link" href="/factory"><i-->
                        <!--            class="fas fa-solid fa-industry-windows fa-3x"></i>-->
                        <!--        <span>Factory</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="/users" data-toggle="dropdown"><i class="fas fa-solid fa-users fa-3x"></i>
                                <span>Users</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/users">Create Users</a></li>
                                <li><a class="nav-link" href="/manage/role">Create Role</a></li>
                                <li><a class="nav-link" href="/customers">Customers</a></li>
                                <li><a class="nav-link" href="/agents">Agents</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/recycle"><i class="fas fa-solid fa-recycle fa-3x"></i>
                                <span>Recycle</span>
                            </a>
                        </li>
                         
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="/sales" data-toggle="dropdown"><i class="fas fa-solid fa-messages-dollar fa-3x"></i>
                                <span>Sales</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/sales">Flesk Sales</a></li>
                                <li><a class="nav-link" href="/salesBailed">Bailed Sales</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="#"><i
                                    class="fas fa-solid fa-file-chart-column fa-3x"></i>
                                <span>Report</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/collection_report">Collection Report</a></li>
                                <li><a class="nav-link" href="/bailed_report">Bailing Report</a></li>
                                <li><a class="nav-link" href="/sorting_report">Sorting Report</a></li>
                                <li><a class="nav-link" href="/transfered_report">Transfered Report</a></li>
                                <li><a class="nav-link" href="/recycled_report">Recycled Report</a></li>
                                <li><a class="nav-link" href="/sales_report">Flesk Sales Report</a></li>
                                <li><a class="nav-link" href="/salesbailed_report">Bailed Sales Report</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/update-password"><i
                            <i class="fa-solid fa-unlock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/logout"><i
                                    class="fas fa-solid fa-arrow-right-from-bracket fa-3x"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                        @elseif(Auth::user()->role->name == 'IT Manager')
                        <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="/dashboard"><i class="fas fa-solid fa-grid-horizontal fa-3x"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Items</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/item">Create Items</a></li>
                                <!--<li><a class="nav-link" href="/bailing_item"> Create Bailing Items</a></li>-->
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-solid fa-map-location fa-3x"></i>
                                <span>Factory / Collections</span>
                            </a>
                          
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/locations">Create Location</a></li>
                                <li><a class="nav-link" href="/addCollection">Add Collection</a></li>
                                <li><a class="nav-link" href="/collectioncenter">Collection Center List</a></li>
                                <li><a class="nav-link" href="/factory">Factory List</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/sorting"><i class="fas fa-solid fa-filter-list fa-3x"></i>
                                <span>Sorting</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/bailing"><i class="fas fa-solid fa-grid-2-plus fa-3x"></i>
                                <span>Bailing</span>
                            </a>
                        </li>
                        <li class="dropdown">
                             <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-solid fa-arrow-right-arrow-left fa-3x"></i>
                                <span>Transfers</span>
                            </a>
                            <!--<a class="nav-link" href="/transfer"><i class="fas fa-solid fa-arrow-right-arrow-left fa-3x"></i>-->
                            <!--    <span>Transfer</span>-->
                            <!--</a>-->
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/transfer">Transfer</a></li>
                                <li><a class="nav-link" href="/sortedtransfer">Sorted Transfer</a></li>
                            </ul>
                        </li>
                        <!--<li>-->
                        <!--    <a class="nav-link" href="/factory"><i-->
                        <!--            class="fas fa-solid fa-industry-windows fa-3x"></i>-->
                        <!--        <span>Factory</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="/users" data-toggle="dropdown"><i class="fas fa-solid fa-users fa-3x"></i>
                                <span>Users</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/users">Create Users</a></li>
                                <li><a class="nav-link" href="/manage/role">Create Role</a></li>
                                <li><a class="nav-link" href="/customers">Customers</a></li>
                                <li><a class="nav-link" href="/agents">Agents</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/recycle"><i class="fas fa-solid fa-recycle fa-3x"></i>
                                <span>Recycle</span>
                            </a>
                        </li>
                         
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="/sales" data-toggle="dropdown"><i class="fas fa-solid fa-messages-dollar fa-3x"></i>
                                <span>Sales</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/sales">Flesk Sales</a></li>
                                <li><a class="nav-link" href="/salesBailed">Bailed Sales</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="#"><i
                                    class="fas fa-solid fa-file-chart-column fa-3x"></i>
                                <span>Report</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/collection_report">Collection Report</a></li>
                                <li><a class="nav-link" href="/bailed_report">Bailing Report</a></li>
                                <li><a class="nav-link" href="/sorting_report">Sorting Report</a></li>
                                <li><a class="nav-link" href="/transfered_report">Transfered Report</a></li>
                                <li><a class="nav-link" href="/recycled_report">Recycled Report</a></li>
                                <li><a class="nav-link" href="/sales_report">Flesk Sales Report</a></li>
                                <li><a class="nav-link" href="/salesbailed_report">Bailed Sales Report</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/update-password"><i
                            <i class="fa-solid fa-unlock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/logout"><i
                                    class="fas fa-solid fa-arrow-right-from-bracket fa-3x"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                        @elseif(Auth::user()->role->name == 'Operations Manager')
                        <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="/dashboard"><i class="fas fa-solid fa-grid-horizontal fa-3x"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i>
                                <span>Items</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/item">Create Items</a></li>
                                <!--<li><a class="nav-link" href="/bailing_item"> Create Bailing Items</a></li>-->
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-solid fa-map-location fa-3x"></i>
                                <span>Factory / Collections</span>
                            </a>
                          
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/locations">Create Location</a></li>
                                <li><a class="nav-link" href="/addCollection">Add Collection</a></li>
                                <li><a class="nav-link" href="/collectioncenter">Collection Center List</a></li>
                                <li><a class="nav-link" href="/factory">Factory List</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/sorting"><i class="fas fa-solid fa-filter-list fa-3x"></i>
                                <span>Sorting</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/bailing"><i class="fas fa-solid fa-grid-2-plus fa-3x"></i>
                                <span>Bailing</span>
                            </a>
                        </li>
                        <li class="dropdown">
                             <a class="nav-link has-dropdown" href="#" data-toggle="dropdown"><i class="fas fa-solid fa-arrow-right-arrow-left fa-3x"></i>
                                <span>Transfers</span>
                            </a>
                            <!--<a class="nav-link" href="/transfer"><i class="fas fa-solid fa-arrow-right-arrow-left fa-3x"></i>-->
                            <!--    <span>Transfer</span>-->
                            <!--</a>-->
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/transfer">Transfer</a></li>
                                <li><a class="nav-link" href="/sortedtransfer">Sorted Transfer</a></li>
                            </ul>
                        </li>
                        <!--<li>-->
                        <!--    <a class="nav-link" href="/factory"><i-->
                        <!--            class="fas fa-solid fa-industry-windows fa-3x"></i>-->
                        <!--        <span>Factory</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="/users" data-toggle="dropdown"><i class="fas fa-solid fa-users fa-3x"></i>
                                <span>Users</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/users">Create Users</a></li>
                                <li><a class="nav-link" href="/manage/role">Create Role</a></li>
                                <li><a class="nav-link" href="/customers">Customers</a></li>
                                <li><a class="nav-link" href="/agents">Agents</a></li>

                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/recycle"><i class="fas fa-solid fa-recycle fa-3x"></i>
                                <span>Recycle</span>
                            </a>
                        </li>
                         
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="/sales" data-toggle="dropdown"><i class="fas fa-solid fa-messages-dollar fa-3x"></i>
                                <span>Sales</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/sales">Flesk Sales</a></li>
                                <li><a class="nav-link" href="/salesBailed">Bailed Sales</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link has-dropdown" href="#"><i
                                    class="fas fa-solid fa-file-chart-column fa-3x"></i>
                                <span>Report</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/collection_report">Collection Report</a></li>
                                <li><a class="nav-link" href="/bailed_report">Bailing Report</a></li>
                                <li><a class="nav-link" href="/sorting_report">Sorting Report</a></li>
                                <li><a class="nav-link" href="/transfered_report">Transfered Report</a></li>
                                <li><a class="nav-link" href="/recycled_report">Recycled Report</a></li>
                                <li><a class="nav-link" href="/sales_report">Flesk Sales Report</a></li>
                                <li><a class="nav-link" href="/salesbailed_report">Bailed Sales Report</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="/update-password"><i
                            <i class="fa-solid fa-unlock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/logout"><i
                                    class="fas fa-solid fa-arrow-right-from-bracket fa-3x"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                        @endif


                    </ul>

                </aside>
            </div>

            <!-- Dashboard wrapper start -->
           
                



                @yield('content')

                <footer class="main-footer">
                    <div class="footer-left">
                        Copyright &copy; 2022
                    </div>
                    <div class="footer-right">

                    </div>
                </footer>
            </div>
        </div>
        
        
            <script>
                
                
            
                </script>
        <!-- General JS Scripts -->
        <script src="assets/modules/jquery.min.js"></script>
        <script src="assets/modules/popper.js"></script>
        <script src="assets/modules/tooltip.js"></script>
        <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="assets/modules/moment.min.js"></script>
        <script src="assets/js/stisla.js"></script>

        <!-- JS Libraies -->
        <script src="assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
        <script src="assets/modules/chart.min.js"></script>
       
        
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <!-- Template JS File -->
        <script src="assets/js/scripts.js"></script>
        <script src="assets/js/custom.js"></script>
</body>

</html>
