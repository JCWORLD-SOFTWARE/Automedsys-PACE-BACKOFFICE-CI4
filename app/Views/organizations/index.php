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
                    <span class="caption-subject bold">Organizations</span>
                </div>
                <div class="actions">
                    <a href="<?= base_url(route_to('organization_create')); ?>" class="btn green-jungle pull-right">
                        New Organization <i class="fa fa-plus icon-black"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <?= $pager->links() ?>

                    <table class="table table-bordered" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th width="50">ID</th>
                                <th>Organization Name</th>
                                <th>Organization Description</th>
                                <th>Contact Name</th>
                                <th width="150">Created</th>
                                <th width="180">Edit / Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($organizations as $organization) : ?>
                                <tr>
                                    <td><?= $organization["Id"] ?></td>
                                    <td><?= $organization["OrgName"] ?></td>
                                    <td><?= $organization["OrgDescr"] ?></td>
                                    <td><?= $organization["ContactName"] ?? "N/A" ?></td>
                                    <td nowrap=""><?= date("d/m/Y h:i a", strtotime($organization["CreatedDt"])) ?></td>
                                    <td nowrap="">
                                        <a class="btn btn-sm blue" href="<?= base_url(route_to('organization_show', $organization["Id"])); ?>">Manage</a>
                                        <a class="btn btn-sm green" href="<?= base_url(route_to('organization_edit', $organization["Id"])); ?>">Edit</a>
                                        <a class="btn btn-sm red" href="<?= base_url(route_to('organization_delete', $organization["Id"])); ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?= $pager->links() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>