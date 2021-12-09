<?= $this->extend('layouts/master') ?>

<?= $this->section('head') ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?= $this->endSection() ?>

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
                    <span class="caption-subject bold">Create New Signup</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?= base_url(route_to('user_registration_store')); ?>" method="POST" class="form-horizontal">
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
                        <div class="form-group">
                            <label class="col-md-3 control-label">First Name</label>
                            <div class="col-md-4">
                                <input type="text" name="first_name" value="<?= old('first_name') ?>" class="form-control" placeholder="Enter First Name">
                                <?php if (isset(session('errors')['first_name'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['first_name'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-4">
                                <input type="text" name="last_name" value="<?= old('last_name') ?>" class="form-control" placeholder="Enter Last Name">
                                <?php if (isset(session('errors')['last_name'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['last_name'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
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
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email Address</label>
                            <div class="col-md-4">
                                <input type="text" name="email_address" value="<?= old('email_address') ?>" class="form-control" placeholder="Enter Email Address">
                                <?php if (isset(session('errors')['email_address'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['email_address'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-3">
                                <input type="button" name="notification_resend" id="notification_resend" value="Resend Notification" class="btn btn-primary form-control">
                            </div>
                        </div>
                        <div class="form-group">
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
                            <label class="col-md-3 control-label">Affiliated Practice</label>
                            <div class="col-md-4">
                                <input type="text" readonly name="affiliated_practice" value="1239833000" class="form-control bg-" placeholder="Enter Affiliated Practice">
                                <?php if (isset(session('errors')['affiliated_practice'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['affiliated_practice'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
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

                        <div class="form-group">
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