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
                <form action="<?= base_url(route_to('application_update', $organization['Id'], $application["Id"])); ?>" method="POST" class="form-horizontal repeater">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Application Name</label>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <input type="text" name="application_description" value="<?= old('application_description', $application["APPDescr"]) ?>" class="form-control" placeholder="Enter Application Description">
                                <?php if (isset(session('errors')['application_description'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['application_description'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Scopes</label>
                            <div class="col-md-6">
                                <select name="scope[]" class="form-control scopes-select" multiple>
                                    <?php foreach ($scopes as $scope) : ?>
                                        <option><?= $scope['ScopeID'] ?> - <?= $scope['ReqdGrantTypes'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset(session('errors')['scope'])) : ?>
                                    <span class="help-block text-danger font-sm">
                                        <?= session('errors')['scope'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-6">
                                <table data-repeater-list="group-scopes" class="table table-striped" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th width="200">Scope</th>
                                            <th>Grant Type</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-repeater-item>
                                            <td>
                                                <select class="form-control">
                                                    <?php foreach ($scopes as $scope) : ?>
                                                        <option><?= $scope['ScopeID'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <button data-repeater-delete type="button" class="btn btn-xs red">
                                                    Remove <i class="fa fa-times icon-black"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button data-repeater-create type="button" class="btn btn-xs blue">
                                    Add <i class="fa fa-plus icon-black"></i>
                                </button>
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

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('.repeater').repeater({
            initEmpty: true,
            defaultValues: {
                'text-input': 'foo'
            },
            show: function() {
                $(this).slideDown();
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to remove this scope?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            ready: function(setIndexes) {
                // $dragAndDrop.on('drop', setIndexes);
            },
            isFirstItemUndeletable: true
        })

        $(".scopes-select").select2({
            placeholder: 'Select scopes',
            width: null
        });
    });
</script>
<?= $this->endSection() ?>