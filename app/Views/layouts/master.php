<?php
//comment

$menuArray = [
    [
        'name' => 'Dashboard',
        'route_to' => 'home',
        'iClass' => 'icon-home',
        'tClass' => 'title',
        'subMenu' => [],
        'aClass' => '',
        'aaClass' => '',
        'href' => 'index',
        'liClass' => ''
    ],
    [
        'name' => 'Signup',
        'route_to' => 'user_registration_index',
        'iClass' => 'icon-users',
        'tClass' => 'title',
        'subMenu' => [],
        'aClass' => '',
        'aaClass' => '',
        'href' => 'user-registrations',
        'liClass' => ''
    ],
    [
        'name' => 'Billing',
        'route_to' => '/',
        'iClass' => 'icon-cloud-upload',
        'tClass' => 'title',
        'subMenu' => [],
        'aClass' => '',
        'aaClass' => '',
        'href' => 'billing',
        'liClass' => ''
    ],
    //Practice Management
    [
        'name' => 'Practice Management',
        'route_to' => '',
        'iClass' => 'icon-diamond',
        'tClass' => 'title',
        'aClass' => 'nav-link nav-toggle',
        'aaClass' => 'arrow',
        'href' => 'javascript:;',
        'liClass' => 'nav-item',
        'subMenu' => [
            [
                'name' => 'Prospective Practices',
                'route_to' => 'prospective_practice_index',
                'tClass' => 'title',
                'href' => 'prospective-practices'
            ],
            [
                'name' => 'Active Practices',
                'route_to' => 'active_practice_index_active',
                'tClass' => 'title',
                'href' => 'active'
            ],
            [
                'name' => 'Suspended Practices',
                'route_to' => 'active_practice_index_suspended',
                'tClass' => 'title',
                'href' => 'suspended'
            ],
        ]
    ],
    //End of it

    //System Administration
    [
        'name' => 'System Administration',
        'route_to' => '',
        'iClass' => 'icon-cloud-upload',
        'tClass' => 'title',
        'aClass' => 'nav-link nav-toggle',
        'aaClass' => 'arrow',
        'href' => 'javascript:;',
        'liClass' => 'nav-item',
        'subMenu' => [
            [
                'name' => 'Deployment Server',
                'route_to' => 'server_index',
                'tClass' => 'title',   
                'href' => 'servers'
            ],
            [
                'name' => 'Database Template',
                'route_to' => 'database_server_template_index',
                'tClass' => 'title',
                'href' => 'database-server-templates'
            ],
        ]
    ],
    //end of it

     //API management
     [
        'name' => 'API Management',
        'route_to' => '',
        'iClass' => 'icon-diamond',
        'tClass' => 'title',
        'aClass' => 'nav-link nav-toggle',
        'aaClass' => 'arrow',
        'href' => 'javascript:;',
        'liClass' => 'nav-item',
        'subMenu' => [
            [
                'name' => 'Organization Management',
                'route_to' => 'organization_index',
                'tClass' => 'title',
                'href' => 'organizations'
            ],
            [
                'name' => 'Scope Management',
                'route_to' => 'scope_index',
                'tClass' => 'title',
                'href' => 'scopes'
            ],
            [
                'name' => 'API Onboarding',
                'route_to' => '/',
                'tClass' => 'title',
            ],
        ]
    ],
    //end of it

    //support
    [
        'name' => 'Support',
        'route_to' => '',
        'iClass' => 'icon-support',
        'tClass' => 'title',
        'aClass' => 'nav-link nav-toggle',
        'aaClass' => 'arrow',
        'href' => 'javascript:;',
        'liClass' => 'nav-item',
        'subMenu' => [
            [
                'name' => 'Contact Us',
                'route_to' => 'contact_us',
                'tClass' => 'title',
                'href' => 'contact_us'
            ],
        ]
    ],
    //end of it



];




?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>autoMedSys | Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?= base_url(); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?= base_url(); ?>/assets/global/css/components-rounded.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?= base_url(); ?>/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?= base_url(); ?>/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="<?= base_url(); ?>/favicon.ico" />

    <style>
        .page-header.navbar .page-logo .logo-default {
            margin: 0;
        }

        .page-content-white .page-title {
            margin: 25px 0;
            font-size: 22px;
            font-weight: 600;
        }

        .logo-default {
            height: 50px;
        }

        .page-sidebar .page-sidebar-menu>li.active>a>.selected,
        .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.active>a>.selected {
            display: none;
        }

        .filter-panel {
            padding: 20px;
        }
        .date-filter{
            padding: 2px;
            text-align: center;
        }
    </style>

    <?= $this->renderSection('head') ?>
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-fixed page-sidebar-closed-hide-logo page-content-white page-container-bg-solid">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="/">
                    <img src="<?= base_url(); ?>/assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
                <div class="menu-toggler sidebar-toggler"> </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="<?= session('profilePicture'); ?>" />
                            <span class="username username-hide-on-mobile"><?= session('lastName') . " " . session('firstName'); ?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="#">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            <li>
                                <a href="<?= base_url(route_to('logout')); ?>">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                    <li class="sidebar-toggler-wrapper hide">
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <div class="sidebar-toggler"> </div>
                        <!-- END SIDEBAR TOGGLER BUTTON -->
                    </li>
                    <?php
                        $uri = pathinfo(basename($_SERVER['PHP_SELF']), PATHINFO_FILENAME); 
                        foreach ( $menuArray as $menuRow){
                            $aClass = (strlen($menuRow['aClass']) > 0) ? 'class='.$menuRow['aClass']."" : '';
                            ?>
                                <li class="<?= $menuRow['liClass'];?> <?php if($uri == $menuRow['href']){echo "active"; } ?>">
                                
                              
                                <a href="<?= (is_array($menuRow['subMenu']) &&  strlen($menuRow['subMenu']) > 0) ? 'javascript:;': base_url(route_to($menuRow['route_to'])); ?>" class='<?= $menuRow['aClass'];?>'> 

                                        <i class="<?=$menuRow['iClass']?>"></i>
                                        <span class="<?=$menuRow['tClass']?>"><?= $menuRow['name']; ?></span>
                                        <span class='<?= $menuRow['aaClass']?>'></span>
                                    </a>
                                    <?php
                                        if (count ($menuRow['subMenu']) > 0){
                                            ?>
                                                <ul class="sub-menu">
                                                    <?php
                                                        foreach ( $menuRow['subMenu'] as $subMenuRow){
                                                        ?> 
                                                            <li class="nav-item <?php if($uri == $subMenuRow['href']){echo "active"; } ?>">
                                                                <a href="<?= base_url(route_to($subMenuRow['route_to'])); ?>" class="nav-link">
                                                                    <span class="<?=$subMenuRow['tClass']?>"><?=$subMenuRow['name']?></span>
                                                                </a>
                                                            </li>
                                                        <?php
                                                        }    
                                                        ?>      
                                                </ul>
                                            <?php 
                                        }
                                    ?>
                                </li>
                            <?php
                        }
                    ?>
            
<!--
     

            <li class="nav-item">
                        <a href="javascript:;"  class="nav-link nav-toggle">
                            <i active='true' class="icon-cloud-upload"></i>
                            <span class="title">System Admin
                                 Test</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                        
                            <li  class="nav-item">
                                <a href=""  class="nav-link">
                                    <span class="title">Deployment Server</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <span class="title">Database Template</span>
                                </a>
                            </li>

                        </ul>
                    </li>


               <li class="nav-item">
                        <a href="

                        ">
                            <i class="icon-home"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="
                       
                        ">
                            <i class="icon-users"></i>
                            <span class="title">Signup</span>
                        </a>
                    </li>
                    

                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-diamond"></i>
                            <span class="title">Practice Management</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <span class="title">Prospective Practices</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link ">
                                    <span class="title">Active Practices</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<" class="nav-link ">
                                    <span class="title">Suspended Practices</span>
                                </a>
                            </li>
                        </ul>
                    </li>
            -->

                <!-- 
                    <li class="nav-item">
                        <a href="#">
                            <i class="icon-cloud-upload"></i>
                            <span class="title">Billing</span>
                        </a>
                    </li>
                    

                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-cloud-upload"></i>
                            <span class="title">System Administration</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="" class="nav-link ">
                                    <span class="title">Deployment Server</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link ">
                                    <span class="title">Database Template</span>
                                </a>
                            </li>
                        </ul>
                    </li>

           
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-diamond"></i>
                            <span class="title">API Management</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="" class="nav-link ">
                                    <span class="title">Organization Management</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link ">
                                    <span class="title">Scope Management</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    <span class="title">API Onboarding</span>
                                </a>
                            </li>
                        </ul>
                    </li>
 


                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-support"></i>
                            <span class="title">Support</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item">
                                <a href="" class="nav-link ">
                                    <span class="title">Contact us</span>
                                </a>
                            </li>
                        </ul>
                    </li>

            -->
                </ul>
                <!-- END SIDEBAR MENU -->
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <?= $this->renderSection('content') ?>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner">
            <?= date('Y') ?> &copy; autoMedSys.
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
    <!--[if lt IE 9]>
<script src="<?= base_url(); ?>/assets/global/plugins/respond.min.js"></script>
<script src="<?= base_url(); ?>/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="<?= base_url(); ?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?= base_url(); ?>/assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>/assets/global/plugins/jquery.repeater/jquery.repeater.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->

    <?= $this->renderSection('scripts') ?>
</body>

</html>