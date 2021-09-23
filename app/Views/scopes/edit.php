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
                    <span class="caption-subject bold">Edit Scope [<?= "{$scope["ScopeID"]}" ?>]</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?= base_url(route_to('scope_update', $scope["UniqueId"])); ?>" method="POST" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Scope Name</label>
                            <div class="col-md-4">
                                <input type="text" name="scope_name" value="<?= old('scope_name', $scope["OrgName"]) ?>" class="form-control" placeholder="Enter Scope Name">
                                <?php if (isset(session('errors')['scope_name'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['scope_name'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Scope Description</label>
                            <div class="col-md-4">
                                <input type="text" name="scope_description" value="<?= old('scope_description', $scope["OrgDescr"]) ?>" class="form-control" placeholder="Enter Scope Description">
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
                                <input type="text" name="requested_grant_types" value="<?= old('requested_grant_types', $scope["ReqdGrantTypes"]) ?>" class="form-control" placeholder="Enter Scope Description">
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