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
                    <span class="caption-subject bold">Organization [<?= $user['OrgName'] ?>]</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="200">ID</th>
                                <td><?= $user['Id'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">First Name</th>
                                <td><?= $user['OrgName'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">Last Name</th>
                                <td><?= $user['OrgDescr'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">Created Date</th>
                                <td><?= date("d/m/Y h:i a", strtotime($user["CreatedDt"])) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>