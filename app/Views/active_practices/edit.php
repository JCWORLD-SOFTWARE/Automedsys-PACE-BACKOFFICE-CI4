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
</div>

<h3 class="page-title">Practice Management</h3>

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
                    <span class="caption-subject bold">Edit Active Practice [<?= $practice["PracticeName"] ?>]</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?= base_url(route_to('active_practice_update', $practice["PracticeCode"])); ?>" method="POST" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Practice NPI</label>
                            <div class="col-md-4">
                                <input type="text" name="practice_npi" value="<?= old('practice_npi', $practice["NPI"]) ?>" class="form-control" placeholder="Enter Practice NPI">
                                <?php if (isset(session('errors')['practice_npi'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['practice_npi'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Practice Name</label>
                            <div class="col-md-4">
                                <input type="text" name="practice_name" value="<?= old('practice_name', $practice["PracticeName"]) ?>" class="form-control" placeholder="Enter Practice Name">
                                <?php if (isset(session('errors')['practice_name'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['practice_name'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address Line 1</label>
                            <div class="col-md-4">
                                <input type="text" name="address_line_1" value="<?= old('address_line_1', $practice["Street1"]) ?>" class="form-control" placeholder="Enter Address Line 1">
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
                                <input type="text" name="address_line_2" value="<?= old('address_line_2', $practice["Street2"]) ?>" class="form-control" placeholder="Enter Address Line 2">
                                <?php if (isset(session('errors')['address_line_2'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['address_line_2'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Country</label>
                            <div class="col-md-4">
                                <input type="text" name="country" value="<?= old('country', $practice["Country"]) ?>" class="form-control" placeholder="Enter Country">
                                <?php if (isset(session('errors')['country'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['country'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">State</label>
                            <div class="col-md-4">
                                <input type="text" name="state" value="<?= old('state', $practice["State"]) ?>" class="form-control" placeholder="Enter State">
                                <?php if (isset(session('errors')['state'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['state'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">City</label>
                            <div class="col-md-4">
                                <input type="text" name="city" value="<?= old('city', $practice["City"]) ?>" class="form-control" placeholder="Enter City">
                                <?php if (isset(session('errors')['city'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['city'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Zip Code</label>
                            <div class="col-md-4">
                                <input type="text" name="zip_code" value="<?= old('zip_code', $practice["ZipCode"]) ?>" class="form-control" placeholder="Enter Zip Code">
                                <?php if (isset(session('errors')['zip_code'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['zip_code'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Prefix</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_prefix" value="<?= old('contact_prefix', $practice["contact_prefix"]) ?>" class="form-control" placeholder="Enter Contact Prefix">
                                <?php if (isset(session('errors')['contact_prefix'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['contact_prefix'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact First Name</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_firstname" value="<?= old('contact_firstname', $practice["contact_firstname"]) ?>" class="form-control" placeholder="Enter Contact First Name">
                                <?php if (isset(session('errors')['contact_firstname'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['contact_firstname'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Middle Name</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_middlename" value="<?= old('contact_middlename', $practice["contact_middlename"]) ?>" class="form-control" placeholder="Enter Contact Middle Name">
                                <?php if (isset(session('errors')['contact_middlename'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['contact_middlename'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Last Name</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_lastname" value="<?= old('contact_lastname', $practice["contact_lastname"]) ?>" class="form-control" placeholder="Enter Contact Last Name">
                                <?php if (isset(session('errors')['contact_lastname'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['contact_lastname'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contact Suffix</label>
                            <div class="col-md-4">
                                <input type="text" name="contact_suffix" value="<?= old('contact_suffix', $practice["contact_suffix"]) ?>" class="form-control" placeholder="Enter Contact Suffix">
                                <?php if (isset(session('errors')['contact_suffix'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['contact_suffix'] ?>
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