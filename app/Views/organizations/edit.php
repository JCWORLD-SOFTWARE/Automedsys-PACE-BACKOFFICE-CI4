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
                    <span class="caption-subject bold">Edit Organization [<?= "{$organization["OrgName"]}" ?>]</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?= base_url(route_to('organization_update', $organization["Id"])); ?>" method="POST" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Record ID</label>
                            <div class="col-md-4">
                                <input type="text" readonly name="record_id" value="112342" class="form-control" placeholder="Enter Record ID">
                                <?php if (isset(session('errors')['record_id'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['record_id'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label class="col-md-3 control-label">Organization Name</label>
                            <div class="col-md-4">
                                <input type="text" name="organization_name" value="<?= old('organization_name', $organization["OrgName"]) ?>" class="form-control" placeholder="Enter Organization Name">
                                <?php if (isset(session('errors')['organization_name'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['organization_name'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label class="col-md-3 control-label">Organization Description</label>
                            <div class="col-md-4">
                                <input type="text" name="organization_description" value="<?= old('organization_description', $organization["OrgDescr"]) ?>" class="form-control" placeholder="Enter Organization Description">
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
                                <input type="text" name="address_line_1" value="<?= old('address_line_1', $organization["AddressLine1"]) ?>" class="form-control" placeholder="Enter Address 1">
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
                                <input type="text" name="address_line_2" value="<?= old('address_line_2', $organization["AddressLine2"]) ?>" class="form-control" placeholder="Enter Address 2">
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
                                <input type="text" name="city" value="<?= old('city', $organization["City"]) ?>" class="form-control" placeholder="Enter City">
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
                                <input type="text" name="state" value="<?= old('state', $organization["State"]) ?>" class="form-control" placeholder="Enter State">
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
                                <input type="text" name="zip_code" value="<?= old('zip_code', $organization["ZipCode"]) ?>" class="form-control" placeholder="Enter Zip Code">
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
                                <input type="text" name="country" value="<?= old('country', $organization["Country"]) ?>" class="form-control" placeholder="Enter Country">
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
                                <input type="text" name="contact_name" value="<?= old('contact_name', $organization["ContactName"]) ?>" class="form-control" placeholder="Enter Contact Name">
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
                                <input type="text" name="contact_phone" value="<?= old('contact_phone', $organization["ContactPhone"]) ?>" class="form-control" placeholder="Enter Contact Phone">
                                <?php if (isset(session('errors')['contact_phone'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['contact_phone'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        
                        <div class="form-group" style="display: none;">
                            <label class="col-md-3 control-label">NPI</label>
                            <div class="col-md-4">
                                <input type="text" name="npi" value="<?= old('npi') ?>" class="form-control" placeholder="Enter NPI">
                                <?php if (isset(session('errors')['npi'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['npi'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="col-md-2">
                                <input type="button" name="verify_npi" value="Verify NPI" class="btn btn-primary form-control">
                                <?php if (isset(session('errors')['verify_npi'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['verify_npi'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label class="col-md-3 control-label">Phone Number</label>
                            <div class="col-md-4">
                                <input type="text" name="phone_number" value="<?= old('phone_number') ?>" class="form-control" placeholder="Enter Phone Number">
                                <?php if (isset(session('errors')['phone_number'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['phone_number'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Email</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_email" value="<?= old('contact_email', $organization["ContactEmail"]) ?>" class="form-control" placeholder="Enter Contact Email">
                                <?php if (isset(session('errors')['contact_email'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['contact_email'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="col-md-2">
                                <input type="button" name="notification_resend" id="notification_resend" value="Resend Notification" class="btn btn-primary form-control">
                            </div>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label class="col-md-3 control-label">Password</label>
                            <div class="col-md-4">
                                <input type="password" name="password" id='password' value="<?= old('password') ?>" class="form-control" placeholder="Enter Password">
                                <?php if (isset(session('errors')['password'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['password'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="col-md-2">
                                <input type="button" id="reset_password" name="reset_password" id="reset_password" value="Reset Password" class="btn btn-primary form-control">
                            </div>
                        </div>
                        <div class="form-group" style="display: none;">
                            <div class="col-md-4 col-md-offset-3">
                                <div class="g-recaptcha" data-sitekey="6Lc5R8QaAAAAAL9YQcSAazEoCX1q5QgoQOK2aQZf"></div>
                                <?php if (isset(session('errors')['g-recaptcha-response'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['g-recaptcha-response'] ?>
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

<style>
    .d-none{
        display: none;
    }
</style>