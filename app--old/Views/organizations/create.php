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
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
</div>

<h3 class="page-title">API Management</h3>

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
                    <span class="caption-subject bold">Create New Organization</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?= base_url(route_to('organization_store')); ?>" method="POST" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Organization Name</label>
                            <div class="col-md-4">
                                <input type="text" name="organization_name" value="<?= old('organization_name') ?>" class="form-control" placeholder="Enter Organization Name">
                                <?php if (isset(session('errors')['organization_name'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['organization_name'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Organization Description</label>
                            <div class="col-md-4">
                                <input type="text" name="organization_description" value="<?= old('organization_description') ?>" class="form-control" placeholder="Enter Organization Description">
                                <?php if (isset(session('errors')['organization_description'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['organization_description'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address Line 1</label>
                            <div class="col-md-4">
                                <input type="text" name="address_line_1" value="<?= old('address_line_1') ?>" class="form-control" placeholder="Enter Address 1">
                                <?php if (isset(session('errors')['address_line_1'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['address_line_1'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address Line 2</label>
                            <div class="col-md-4">
                                <input type="text" name="address_line_2" value="<?= old('address_line_2') ?>" class="form-control" placeholder="Enter Address 2">
                                <?php if (isset(session('errors')['address_line_2'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['address_line_2'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">City</label>
                            <div class="col-md-4">
                                <input type="text" name="city" value="<?= old('city') ?>" class="form-control" placeholder="Enter City">
                                <?php if (isset(session('errors')['city'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['city'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">State</label>
                            <div class="col-md-4">
                                <input type="text" name="state" value="<?= old('state') ?>" class="form-control" placeholder="Enter State">
                                <?php if (isset(session('errors')['state'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['state'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Zip Code</label>
                            <div class="col-md-4">
                                <input type="text" name="zip_code" value="<?= old('zip_code') ?>" class="form-control" placeholder="Enter Zip Code">
                                <?php if (isset(session('errors')['zip_code'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['zip_code'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Country</label>
                            <div class="col-md-4">
                                <input type="text" name="country" value="<?= old('country') ?>" class="form-control" placeholder="Enter Country">
                                <?php if (isset(session('errors')['country'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['country'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Name</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_name" value="<?= old('contact_name') ?>" class="form-control" placeholder="Enter Contact Name">
                                <?php if (isset(session('errors')['contact_name'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['contact_name'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Phone</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_phone" value="<?= old('contact_phone') ?>" class="form-control" placeholder="Enter Contact Phone">
                                <?php if (isset(session('errors')['contact_phone'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['contact_phone'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Email</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_email" value="<?= old('contact_email') ?>" class="form-control" placeholder="Enter Contact Email">
                                <?php if (isset(session('errors')['contact_email'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['contact_email'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-4">
                                <button type="submit" class="btn green-jungle">Submit <i class="fa fa-check icon-black"></i></button>
                                <button type="reset" class="btn default">Cancel <i class="fa fa-times icon-black"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>