<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url(route_to('home')); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>API Management</span>
        </li>
    </ul>
</div>

<h3 class="page-title">API Management</h3>
tobi
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
                        <span class="caption-subject bold">Organizationss</span>
                    </div>
                    <div class="col-md-6 text-center page-toolbar" >
                        <!-- Date Filter -->
                        <div class="page-toolbar">
                            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                                <i class="icon-calendar"></i>&nbsp;
                                <span class="thin uppercase hidden-xs"></span>&nbsp;
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-right actions">
                        <button data-toggle="collapse" data-target="#filter" class="btn blue btn-outline">
                            Search <i class="fa fa-search icon-black"></i>
                        </button>
                        
                        <button disabled class="btn btn-disabled green-jungle">
                            New Organization <i class="fa fa-plus icon-black"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <form id="filter" class="filter-panel bg-default form-horizontal collapse <?= $isFiltered ? "in" : "" ?>">
                    <div class="form-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Organization Name</label>
                                <div class="col-md-4">
                                    <input type="text" name="organization_name" value="<?= old('organization_name', $filter['OrgName']) ?>" class="form-control" placeholder="Enter Organization Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Organization Description</label>
                                <div class="col-md-4">
                                    <input type="text" name="organization_description" value="<?= old('organization_description', $filter['OrgDescr']) ?>" class="form-control" placeholder="Enter Organization Description">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Address Line 1</label>
                                <div class="col-md-4">
                                    <input type="text" name="address_line_1" value="<?= old('address_line_1', $filter['AddressLine1']) ?>" class="form-control" placeholder="Enter Address 1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Address Line 2</label>
                                <div class="col-md-4">
                                    <input type="text" name="address_line_2" value="<?= old('address_line_2', $filter['AddressLine2']) ?>" class="form-control" placeholder="Enter Address 2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">City</label>
                                <div class="col-md-4">
                                    <input type="text" name="city" value="<?= old('city', $filter['City']) ?>" class="form-control" placeholder="Enter City">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">State</label>
                                <div class="col-md-4">
                                    <input type="text" name="state" value="<?= old('state', $filter['State']) ?>" class="form-control" placeholder="Enter State">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Zip Code</label>
                                <div class="col-md-4">
                                    <input type="text" name="zip_code" value="<?= old('zip_code', $filter['ZipCode']) ?>" class="form-control" placeholder="Enter Zip Code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Country</label>
                                <div class="col-md-4">
                                    <input type="text" name="country" value="<?= old('country', $filter['Country']) ?>" class="form-control" placeholder="Enter Country">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Contact Name</label>
                                <div class="col-md-4">
                                    <input type="text" name="contact_name" value="<?= old('contact_name', $filter['ContactName']) ?>" class="form-control" placeholder="Enter Contact Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Contact Phone</label>
                                <div class="col-md-4">
                                    <input type="text" name="contact_phone" value="<?= old('contact_phone', $filter['ContactPhone']) ?>" class="form-control" placeholder="Enter Contact Phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Contact Email</label>
                                <div class="col-md-4">
                                    <input type="text" name="contact_email" value="<?= old('contact_email', $filter['ContactEmail']) ?>" class="form-control" placeholder="Enter Contact Email">
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-4">
                                    <button type="submit" class="btn green">Search Results <i class="fa fa-filter icon-black"></i></button>
                                    <?php if ($isFiltered) : ?>
                                        <a href="<?= base_url(route_to('organization_index')); ?>" class="btn red btn-outline">
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
                                <th>Signup Date</th>
                                <th>Organization Name</th>
                                <th>Speciality</th>
                                <th>Address</th>
                                <th>Country</th>
                                <th>Organization Description</th>
                                <th>Contact Name</th>
                                <th>Contact Phone</th>
                                <th>Contact Email</th>
                                <th width="150">Edit / Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($organizations as $organization) : ?>
                                <tr>
                                    <td><?= $organization["Id"] ?></td>
                                    <td nowrap=""><?= date("dS M, Y", strtotime($organization["CreatedDt"])) ?></td>
                                    <td><?= $organization["OrgName"] ?></td>
                                    <td>Sehtufred</td>
                                    <td>No <?= $organization["Id"] ?>, street name, City, State </td>
                                    <td>Country</td>
                                    <td><?= $organization["OrgDescr"] ?></td>
                                    <td><?= $organization["ContactName"] ?? "N/A" ?></td>
                                    <td><?= $organization["ContactPhone"] ?? "N/A" ?></td>
                                    <td><?= $organization["ContactEmail"] ?? "N/A" ?></td>
                                    
                                    <td nowrap="">
                                        <a class="btn btn-sm blue" href="<?= base_url(route_to('organization_show', $organization["Id"])); ?>">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-sm green" href="<?= base_url(route_to('organization_edit', $organization["Id"])); ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="btn btn-sm red" href="<?= base_url(route_to('organization_delete', $organization["Id"])); ?>" onclick="return confirm('Are you sure you want to delete this record?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
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