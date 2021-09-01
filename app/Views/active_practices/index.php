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
            <span>Practice Management</span>
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

<h3 class="page-title">Practice Management</h3>

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
                    <span class="caption-subject bold">Active Practices</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <?= $pager->links() ?>

                    <table class="table table-bordered table-striped" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Practice Name<br>(Username)</th>
                                <th>Tax ID</th>
                                <th>Practice NPI<br>(Code)</th>
                                <th>Contact Email<br>(Name)</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($activePractices as $practice) : ?>
                                <tr>
                                    <td rowspan="2"><?= $practice["ID"] ?></td>
                                    <td><?= $practice["PracticeName"] ?> (<?= $practice["PracticeCode"] ?>)</td>
                                    <td><?= $practice["TaxID"] ?></td>
                                    <td><?= $practice["NPI"] ?><br />(<?= $practice["PracticeCode"] ?>)</td>
                                    <td><?= $practice["contact_email"] ?><br />(<?= $practice["contact_firstname"] . ' ' . $practice["contact_firstname"] ?>)</td>
                                    <td class="center" nowrap=""><?= date("d/m/Y h:i a", strtotime($practice["created_dt"])) ?></td>
                                    <td nowrap="">
                                        <a class="btn btn-sm blue" href="<?= base_url(route_to('active_practice_show', $practice["PracticeCode"])); ?>">View</a>
                                        <a class="btn btn-sm green" href="#">Edit</a>
                                        <a class="btn btn-sm red" href="#">Suspend</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6"><?= "{$practice['Street1']} {$practice['Street2']}, {$practice['City']}, {$practice['State']}, {$practice['ZipCode']}, {$practice['Country']}" ?></td>
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