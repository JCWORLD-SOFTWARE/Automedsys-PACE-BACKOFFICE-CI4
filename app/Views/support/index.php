<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url(route_to('home')); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Suport</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Contact Us</span>
        </li>
    </ul>
</div>

<h3 class="page-title">Contact Us</h3>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="row">
                    <div class="col-md-2 caption font-green-jungle">
                        <span class="caption-subject bold">Contact us</span>
                    </div>
                    <div class="col-md-5 text-center page-toolbar" >
                        <!-- Date Filter -->
                        <div class="page-toolbar">
                            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                                <i class="icon-calendar"></i>&nbsp;
                                <span class="thin uppercase hidden-xs"></span>&nbsp;
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                        <table style="width: 90%; display: none;">
                            <tr>
                                <td class="form-group">
                                    <div class="row">
                                        <label for="search_fromdate" class="col-md-3 btn">From </label>
                                        <div class="col-md-8">
                                            <input type='date' id='search_fromdate' class="datepicker date-filter form-control btn btn-primary">
                                        </div>
                                    </div>
                                </td>
                                <td class="form-group">
                                    <div class="row">
                                        <label for="search_todate" class="col-md-2 text-center btn"> To </label>
                                        <div class="col-md-9">
                                            <input type='date' id='search_todate' class="datepicker date-filter form-control btn btn-primary">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input type='button' id="btn_search" class="btn btn-success" value="Search">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 text-right actions">
                        <button data-toggle="collapse" data-target="#filter" class="btn blue btn-outline">
                            Search <i class="fa fa-search icon-black"></i>
                        </button>
                    </div>
                </div>
            <div class="portlet-body">

                <form id="filter" class="filter-panel bg-default form-horizontal collapse <?= $isFiltered ? "in" : "" ?>">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email Address</label>
                            <div class="col-md-4">
                                <input type="text" name="emailAddress" value="<?= old('emailAddress', $filter["emailAddress"]) ?>" class="form-control" placeholder="Enter Email Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Firstname</label>
                            <div class="col-md-4">
                                <input type="text" name="firstName" value="<?= old('firstName', $filter["firstName"]) ?>" class="form-control" placeholder="Enter First Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Lastname</label>
                            <div class="col-md-4">
                                <input type="text" name="lastName" value="<?= old('lastName', $filter["lastName"]) ?>" class="form-control" placeholder="Enter Last Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Message</label>
                            <div class="col-md-4">
                                <input type="text" name="message" value="<?= old('message', $filter["message"]) ?>" class="form-control" placeholder="Enter Message">
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-4">
                                    <button type="submit" class="btn green">Filter Results <i class="fa fa-filter icon-black"></i></button>
                                    <?php if ($isFiltered) : ?>
                                        <a href="<?= base_url(route_to('contact_us')); ?>" class="btn red btn-outline">
                                            Remove Filters <i class="fa fa-times icon-black"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <?= $pager->links() ?>

                    <table class="table table-bordered" style="font-size: 12px;">
                        <thead>
                            <tr>

                                <th>Email Address</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Phone number</th>
                                <th>Message</th>
                                <th>Created</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ii = 0;
                            ?>
                            <?php foreach ($prospectivePractices as $practice) :
                                $ii++;
                                $color = ($ii % 2 === 0) ? "#ffffff" : "#efefef"
                            ?>
                                <tr style="background-color: <?= $color ?>;">
                                    <td><?= $practice["emailAddress"] ?></td>
                                    <td><?= $practice["firstName"] ?></td>
                                    <td><?= $practice["lastName"] ?></td>
                                    <td><?= $practice["phoneNumber"] ?></td>
                                    <td><?= $practice["message"] ?></td>
                                    <td class="center" nowrap=""><?= date("d/m/Y h:i a", strtotime($practice["created_dt"])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?= $pager->links() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>