<?= $this->extend('layouts/master') ?>

<?= $this->section('head') ?>
<style>
    .server-db-name {
        word-break: break-word;
    }
</style>
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
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
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
                    <span class="caption-subject bold">Sign Ups</span>
                </div>
                <div class="actions">
                    <a href="javascript:;" class="btn green-jungle pull-right">
                        New Sign Up <i class="fa fa-plus icon-black"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <?= $pager->links() ?>

                    <table class="table table-bordered" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Telephone</th>
                                <th>Provider NPI</th>
                                <th>Created</th>
                                <th>Edit / Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userRegistrations as $user) : ?>
                                <tr>
                                    <td><?= $user["Id"] ?></td>
                                    <td><?= $user["FirstName"] ?> <?= $user["LastName"] ?></td>
                                    <td><?= $user["UsernameEmail"] ?></td>
                                    <td><?= $user["Telephone"] ?></td>
                                    <td><?= $user["ProviderNPI"] ? $user["ProviderNPI"] : "N/A" ?></td>
                                    <td nowrap=""><?= date("d/m/Y h:i a", strtotime($user["created_dt"])) ?></td>
                                    <td>
                                        <a class="btn btn-sm blue" href="<?= base_url(route_to('user_registration_show', $user["UniqueId"])); ?>">View</a>
                                        <a class="btn btn-sm green" href="/crud/applicationupdate?id=2">Edit</a>
                                        <a class="btn btn-sm red" href="<?= base_url(route_to('user_registration_delete', $user["UniqueId"])); ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
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