<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url(route_to('home')); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Dashboard</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> Dashboard
    <small>dashboard & statistics</small>
</h3>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-briefcase fa-icon-medium"></i>
            </div>
            <div class="details">
                <div class="number">
                    <a class="font-white" href="<?= base_url(route_to('active_practice_index_actice')); ?>">Active Practices</a>
                </div>
                <div class="desc">Manage Practices</div>
            </div>
            <a class="more" href="<?= base_url(route_to('active_practice_index_actice')); ?>"> View more
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="fa fa-group fa-icon-medium"></i>
            </div>
            <div class="details">
                <div class="number">
                    <a class="font-white" href="<?= base_url(route_to('user_registration_index')); ?>">Pending Signup</a>
                </div>
                <div class="desc">Practice Registrations</div>
            </div>
            <a class="more" href="<?= base_url(route_to('user_registration_index')); ?>"> View more
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-group fa-icon-medium"></i>
            </div>
            <div class="details">
                <div class="number">
                    <a class="font-white" href="#">Billing</a>
                </div>
                <div class="desc">Billing</div>
            </div>
            <a class="more" href="#"> View more
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <a class="font-white" href="<?= base_url(route_to('server_index')); ?>">Servers</a>
                </div>
                <div class="desc">Manage Servers</div>
            </div>
            <a class="more" href="<?= base_url(route_to('server_index')); ?>"> View more
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>
<!-- END DASHBOARD STATS 1-->

<div class="row">
    <div class="col-md-6 col-sm-6">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-green">
                    <span class="caption-subject bold">Signup</span>
                </div>
            </div>
            <div class="portlet-body">
                <div id="dashboard_amchart_1" class="CSSAnimationChart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-red">
                    <span class="caption-subject bold">Approvals</span>
                </div>
            </div>
            <div class="portlet-body">
                <div id="dashboard_amchart_3" class="CSSAnimationChart"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="portlet box default">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Portlet3
                </div>
            </div>
            <div class="portlet-body">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                    <div class="scroller" style="height: 200px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible="1" data-rail-color="blue" data-handle-color="red" data-initialized="1">
                        <strong>Scroll is always visible</strong>
                        <br> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula,
                        eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit
                        amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
                    </div>
                    <div class="slimScrollBar" style="background: red; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 200px;"></div>
                    <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: block; border-radius: 7px; background: blue; opacity: 0.2; z-index: 90; right: 1px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet box default">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Portlet4
                </div>
            </div>
            <div class="portlet-body">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                    <div class="scroller" style="height: 200px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green" data-initialized="1">
                        <strong>Scroll and rail are always visible</strong>
                        <br> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula,
                        eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit
                        amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor
                        ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur
                        purus sit amet fermentum.
                    </div>
                    <div class="slimScrollBar" style="background: red; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 200px;"></div>
                    <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: block; border-radius: 7px; background: blue; opacity: 0.2; z-index: 90; right: 1px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>