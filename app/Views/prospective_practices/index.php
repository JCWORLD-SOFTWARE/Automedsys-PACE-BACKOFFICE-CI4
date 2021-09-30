<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url(route_to('home')); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Practice Management</span>
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

<h3 class="page-title">Practice Management</h3>

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
                <div class="caption font-green-jungle">
                    <span class="caption-subject bold">Prospective Practices</span>
                </div>
                <div class="actions">
                    <button data-toggle="collapse" data-target="#filter" class="btn blue btn-outline">
                        Filter <i class="fa fa-filter icon-black"></i>
                    </button>
                </div>
            </div>
            <div class="portlet-body">

                <form id="filter" class="filter-panel bg-default form-horizontal collapse <?= $isFiltered ? "in" : "" ?>">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Practice NPI</label>
                            <div class="col-md-4">
                                <input type="text" name="practice_npi" value="<?= old('practice_npi', $filter["NPI"]) ?>" class="form-control" placeholder="Enter Practice NPI">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Practice Name</label>
                            <div class="col-md-4">
                                <input type="text" name="practice_name" value="<?= old('practice_name', $filter["PracticeName"]) ?>" class="form-control" placeholder="Enter Practice Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address Line 1</label>
                            <div class="col-md-4">
                                <input type="text" name="address_line_1" value="<?= old('address_line_1', $filter["Street1"]) ?>" class="form-control" placeholder="Enter Address Line 1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address Line 2</label>
                            <div class="col-md-4">
                                <input type="text" name="address_line_2" value="<?= old('address_line_2', $filter["Street2"]) ?>" class="form-control" placeholder="Enter Address Line 2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Country</label>
                            <div class="col-md-4">
                                <input type="text" name="country" value="<?= old('country', $filter["Country"]) ?>" class="form-control" placeholder="Enter Country">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">State</label>
                            <div class="col-md-4">
                                <input type="text" name="state" value="<?= old('state', $filter["State"]) ?>" class="form-control" placeholder="Enter State">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">City</label>
                            <div class="col-md-4">
                                <input type="text" name="city" value="<?= old('city', $filter["City"]) ?>" class="form-control" placeholder="Enter City">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Zip Code</label>
                            <div class="col-md-4">
                                <input type="text" name="zip_code" value="<?= old('zip_code', $filter["ZipCode"]) ?>" class="form-control" placeholder="Enter Zip Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Prefix</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_prefix" value="<?= old('contact_prefix', $filter["contact_prefix"]) ?>" class="form-control" placeholder="Enter Contact Prefix">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact First Name</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_firstname" value="<?= old('contact_firstname', $filter["contact_firstname"]) ?>" class="form-control" placeholder="Enter Contact First Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Middle Name</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_middlename" value="<?= old('contact_middlename', $filter["contact_middlename"]) ?>" class="form-control" placeholder="Enter Contact Middle Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Last Name</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_lastname" value="<?= old('contact_lastname', $filter["contact_lastname"]) ?>" class="form-control" placeholder="Enter Contact Last Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Suffix</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_suffix" value="<?= old('contact_suffix', $filter["contact_suffix"]) ?>" class="form-control" placeholder="Enter Contact Suffix">
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-4">
                                    <button type="submit" class="btn green">Filter Results <i class="fa fa-filter icon-black"></i></button>
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

                    <table class="table table-bordered" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th width="50">ID</th>
                                <th>Practice Name<br>(Username)</th>
                                <th>Tax ID</th>
                                <th>Practice NPI<br>(Code)</th>
                                <th>Phone (Fax)</th>
                                <th>Contact Email<br>(Name)</th>
                                <th>Created</th>
                                <th>Edit / Delete</th>
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
                                    <td rowspan="2"><?= $practice["ID"] ?></td>
                                    <td><?= $practice["PracticeName"] ?> (<?= $practice["PracticeName"] ?>)</td>
                                    <td><?= $practice["TaxID"] ? $practice["TaxID"] : "N/A" ?></td>
                                    <td><?= $practice["NPI"] ?><br />(<?= $practice["PracticeCode"] ?>)</td>
                                    <td><?= $practice["phone"] ?> (<?= $practice["fax"] ?>)</td>
                                    <td><?= $practice["contact_email"] ?><br />(<?= $practice["contact_firstname"] . ' ' . $practice["contact_firstname"] ?>)</td>
                                    <td class="center" nowrap=""><?= date("d/m/Y h:i a", strtotime($practice["created_dt"])) ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-block green" href="<?= base_url(route_to('prospective_practice_edit', $practice["PracticeCode"])); ?>">Edit</a>
                                        <a class="btn btn-sm btn-block blue margin-top-10" href="<?= base_url(route_to('prospective_practice_show', $practice["PracticeCode"])); ?>">View</a>
                                    </td>
                                </tr>
                                <tr style="background-color: <?= $color ?>;">
                                    <td colspan="3"><?= "{$practice["Street1"]} {$practice["Street2"]}, {$practice["City"]}, {$practice["State"]}, {$practice["ZipCode"]}, {$practice["Country"]}" ?></td>
                                    <td class="server-db-name" colspan="2"><?= $practice["Server"] ?> / <?= $practice["DBName"] ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-block green-jungle" href="<?= base_url(route_to('practice_request_show', $practice["PracticeCode"])); ?>" onclick="return confirm('Are you sure you want to approve this practice?')">Approve Practice</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-block red" href="<?= base_url(route_to('prospective_practice_delete', $practice["PracticeCode"])); ?>" onclick="return confirm('Are you sure you want to delete this application?')">Delete</a>
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