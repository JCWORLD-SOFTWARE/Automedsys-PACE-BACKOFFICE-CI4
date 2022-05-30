<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url(route_to('home')); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>User Registration Management</span>
        </li>
    </ul>
</div>

<h3 class="page-title">User Registration Management</h3>

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
                        <span class="caption-subject bold">Sign Ups</span>
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
                        <button disabled class="btn btn-disabled green-jungle">
                            New Sign Up <i class="fa fa-plus icon-black"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <form id="filter" class="filter-panel bg-default form-horizontal collapse <?= $isFiltered ? "in" : "" ?>">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">First Name</label>
                            <div class="col-md-6">
                                <input type="text" name="first_name" value="<?= old('first_name', $filter['FirstName']) ?>" class="form-control" placeholder="Enter First Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-6">
                                <input type="text" name="last_name" value="<?= old('last_name', $filter['LastName']) ?>" class="form-control" placeholder="Enter Last Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">NPI</label>
                            <div class="col-md-6">
                                <input type="text" name="npi" value="<?= old('npi', $filter['Provider_Npi']) ?>" class="form-control" placeholder="Enter NPI">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email Address</label>
                            <div class="col-md-6">
                                <input type="text" name="email_address" value="<?= old('email_address', $filter['email']) ?>" class="form-control" placeholder="Enter Email Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Phone Number</label>
                            <div class="col-md-6">
                                <input type="text" name="phone_number" value="<?= old('phone_number', $filter['telephone']) ?>" class="form-control" placeholder="Enter Phone Number">
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-4">
                                    <button type="submit" class="btn green">Search Results <i class="fa fa-filter icon-black"></i></button>
                                    <?php if ($isFiltered) : ?>
                                        <a href="<?= base_url(route_to('user_registration_index')); ?>" class="btn red btn-outline">
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

                    <?php if (session('errors') !== null) : ?>
                        <div class="alert alert-danger">
                            <?= session('errors') ?>
                        </div>
                    <?php endif; ?>

                    <table class="table table-bordered" style="font-size: 12px; ">
                        <thead>
                            <tr>
                                <th width="45">ID</th>
                                <th width="180">Signup Date</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                                <th>Telephone</th>
                                <th>NPI</th>
                                <th>Affiliated Practice</th>
                                <th>Email Verified</th>
                                <th>Date Verified</th>
                              
                                <th width="120">Edit / Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userRegistrations as $user) : ?>
                                <tr>
                                    <td><?= $user["Id"] ?></td>
                                    <td nowrap=""><?= date("dS M y \n h:i a", strtotime($user["created_dt"])) ?></td>
                                    <td><?= $user["FirstName"] ?></td>
                                    <td><?= $user["LastName"] ?></td>
                                    <td><?= $user["UsernameEmail"] ?></td>
                                    <td><?= $user["Telephone"] ?></td>
                                    <td><?= $user["ProviderNPI"] ? $user["ProviderNPI"] : "N/A" ?></td>
                                    <td><?= $user["Telephone"] ?></td>
                                    <td>  <?php
                                     $esm =  $user["Email_verified"]; 
                                     if($esm == 1){
                                         echo "True";
                                     } else{
                                        echo "False";
                                     }  ?>  </td>

                                    <td> <?= $user["Email_verified_dt"] ? $user["Email_verified_dt"] : "N/A"  ?> </td>
                                    
                                    <td nowrap="">
                                        <a class="btn btn-sm blue" href="<?= base_url(route_to('user_registration_show', $user["UniqueId"])); ?>"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-sm green" href="<?= base_url(route_to('user_registration_edit', $user["UniqueId"])); ?>"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-sm red" href="<?= base_url(route_to('user_registration_delete', $user["UniqueId"])); ?>" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                                    </td>
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
