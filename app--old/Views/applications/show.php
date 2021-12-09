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

<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-green-jungle">
                    <span class="caption-subject bold">Application [<?= $application['APPName'] ?>]</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="200">ID</th>
                                <td><?= $application['Id'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">Application Name</th>
                                <td><?= $application['APPName'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">Application Description</th>
                                <td><?= $application['APPDescr'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">Created Date</th>
                                <td><?= date("d/m/Y h:i a", strtotime($application["CreatedDt"])) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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
                    <span class="caption-subject bold">Manage Scopes</span>
                </div>
            </div>
            <div class="portlet-body row form">
                <form action="<?= base_url(route_to('scope_assignment_store', $organization['Id'], $application["Id"])); ?>" method="POST" class="form-horizontal col-md-6">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Scopes</label>
                            <div class="col-md-9">
                                <select name="scopes[]" class="form-control scopes-select" multiple>
                                    <?php foreach ($unassignedScopes as $scope) : ?>
                                        <option value="<?= $scope['ID'] ?>"><?= $scope['ScopeID'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset(session('errors')['scopes'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['scopes'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green-jungle">Submit <i class="fa fa-check icon-black"></i></button>
                                <button type="reset" class="btn default">Cancel <i class="fa fa-times icon-black"></i></button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="col-md-6 well">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="200">Scope</th>
                                <th>Grant Type</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($assignedScopes as $scope) : ?>
                                <tr>
                                    <td><?= $scope['ScopeID'] ?></td>
                                    <td><?= $scope['ReqdGrantTypes'] ?></td>
                                    <td>
                                        <a href="<?= base_url(route_to('scope_assignment_delete', $organization["Id"], $application["Id"], $scope['ID'])); ?>" class="btn btn-xs red" onclick="return confirm('Are you sure you want to unassign this scope?')">
                                            Unassign <i class="fa fa-times icon-black"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $(".scopes-select").select2({
            placeholder: 'Select scopes',
            width: null
        });
    });
</script>
<?= $this->endSection() ?>