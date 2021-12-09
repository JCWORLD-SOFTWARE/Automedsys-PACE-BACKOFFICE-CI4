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
                    <span class="caption-subject bold">Create New Scope</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?= base_url(route_to('scope_store')); ?>" method="POST" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Scope ID</label>
                            <div class="col-md-4">
                                <input type="text" name="scope_id" value="<?= old('scope_id') ?>" class="form-control" placeholder="Enter Scope Name">
                                <?php if (isset(session('errors')['scope_id'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['scope_id'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Scope Description</label>
                            <div class="col-md-4">
                                <input type="text" name="scope_description" value="<?= old('scope_description') ?>" class="form-control" placeholder="Enter Scope Description">
                                <?php if (isset(session('errors')['scope_description'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['scope_description'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Requested Grant Types</label>
                            <div class="col-md-4">
                                <input type="text" name="requested_grant_types" value="<?= old('requested_grant_types') ?>" class="form-control" placeholder="Enter Scope Description">
                                <?php if (isset(session('errors')['requested_grant_types'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['requested_grant_types'] ?>
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