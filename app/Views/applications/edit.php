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
                    <span class="caption-subject bold">Edit Application [<?= "{$application["APPName"]}" ?>]</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?= base_url(route_to('application_update', $organization['Id'], $application["Id"])); ?>" method="POST" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Application Name</label>
                            <div class="col-md-4">
                                <input type="text" name="application_name" value="<?= old('application_name', $application["APPName"]) ?>" class="form-control" placeholder="Enter Application Name">
                                <?php if (isset(session('errors')['application_name'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['application_name'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Application Description</label>
                            <div class="col-md-4">
                                <input type="text" name="application_description" value="<?= old('application_description', $application["APPDescr"]) ?>" class="form-control" placeholder="Enter Application Description">
                                <?php if (isset(session('errors')['application_description'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['application_description'] ?>
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