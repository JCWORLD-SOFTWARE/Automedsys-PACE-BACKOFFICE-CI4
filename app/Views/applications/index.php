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
                    <span class="caption-subject bold">[<?= $organization['OrgName'] ?>] Applications</span>
                </div>
                <div class="actions">
                    <button data-toggle="collapse" data-target="#filter" class="btn blue btn-outline">
                        Filter <i class="fa fa-filter icon-black"></i>
                    </button>
                    <a href="<?= base_url(route_to('application_create', $organization['Id'])); ?>" class="btn green-jungle">
                        New Application <i class="fa fa-plus icon-black"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <form id="filter" class="filter-panel bg-default form-horizontal collapse <?= $isFiltered ? "in" : "" ?>">
                    <div class="form-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Application Name</label>
                                <div class="col-md-4">
                                    <input type="text" name="application_name" value="<?= old('application_name', $filter['APPName']) ?>" class="form-control" placeholder="Enter Application Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Application Description</label>
                                <div class="col-md-4">
                                    <input type="text" name="application_description" value="<?= old('application_description', $filter['APPDescr']) ?>" class="form-control" placeholder="Enter Application Description">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">User ID</label>
                                <div class="col-md-4">
                                    <input type="text" name="user_id" value="<?= old('user_id', $filter['UserId']) ?>" class="form-control" placeholder="Enter User ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Client ID</label>
                                <div class="col-md-4">
                                    <input type="text" name="client_id" value="<?= old('client_id', $filter['APPClientId']) ?>" class="form-control" placeholder="Enter Client ID">
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-4">
                                    <button type="submit" class="btn green">Filter Results <i class="fa fa-filter icon-black"></i></button>
                                    <?php if ($isFiltered) : ?>
                                        <a href="<?= base_url(route_to('application_index', $organization["Id"])); ?>" class="btn red btn-outline">
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

                    <?php if (count($applications)) : ?>
                        <table class="table table-bordered" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th width="50">ID</th>
                                    <th>Application Name</th>
                                    <th>Application Key</th>
                                    <th>Client ID</th>
                                    <th width="150">Created</th>
                                    <th width="180">Edit / Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($applications as $application) : ?>
                                    <tr>
                                        <td><?= $application["Id"] ?></td>
                                        <td><?= $application["APPName"] ?></td>
                                        <td><?= $application["APPKey"] ?></td>
                                        <td><?= $application["APPClientId"] ?></td>
                                        <td nowrap=""><?= date("d/m/Y h:i a", strtotime($application["CreatedDt"])) ?></td>
                                        <td nowrap="">
                                            <a class="btn btn-sm blue" href="<?= base_url(route_to('application_show', $organization["Id"], $application["Id"])); ?>">Manage</a>
                                            <a class="btn btn-sm green" href="<?= base_url(route_to('application_edit', $organization["Id"], $application["Id"])); ?>">Edit</a>
                                            <a class="btn btn-sm red" href="<?= base_url(route_to('application_delete', $organization["Id"], $application["Id"])); ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <div class="alert alert-warning">
                            No application has been added for this organization.
                        </div>
                    <?php endif; ?>

                    <?= $pager->links() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>