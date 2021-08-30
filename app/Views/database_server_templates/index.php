<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url(route_to('home')); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>System Administration</span>
        </li>
    </ul>
</div>

<h3 class="page-title">System Administration</h3>

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
                    <span class="caption-subject bold">Database Server Templates</span>
                </div>
            </div>
            <div class="portlet-body flip-scroll">
                <table class="table table-striped flip-content">
                    <thead class="flip-content">
                        <tr>
                            <th>ID</th>
                            <th>Server ID</th>
                            <th>Template ID</th>
                            <th>Server Name</th>
                            <th>Server Status</th>
                            <th>Template Name / Template Description</th>
                            <th>Template Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($databaseServerTemplates as $dst) : ?>
                            <tr>
                                <td><?= $dst['ID'] ?></td>
                                <td><?= $dst['server_id'] ?></td>
                                <td><?= $dst['template_id'] ?></td>
                                <td><?= $dst['server_name'] ?></td>
                                <td><?= $dst['server_status'] ?></td>
                                <td><?= $dst['template_name'] ?> <?= $dst['template_description'] ?></td>
                                <td><?= $dst['template_status'] ?></td>
                                <td><?= date_format(date_create($dst['created_dt']), "Y/m/d H:i a") ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>