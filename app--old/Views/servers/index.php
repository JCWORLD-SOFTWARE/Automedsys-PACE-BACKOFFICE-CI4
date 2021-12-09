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
                    <span class="caption-subject bold">Servers</span>
                </div>
            </div>
            <div class="portlet-body flip-scroll">
                <table class="table table-striped flip-content">
                    <thead class="flip-content">
                        <tr>
                            <th width="50">ID</th>
                            <th>Name</th>
                            <th>Host Address</th>
                            <th>Port</th>
                            <th>Binding</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th width="50">Edit</th>
                            <th width="50">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servers as $s) : ?>
                            <tr>
                                <td><?= $s['ID'] ?></td>
                                <td><?= $s['name'] ?></td>
                                <td><?= $s['host_address'] ?></td>
                                <td><?= $s['port_no'] ?></td>
                                <td><?= $s['binding'] ?></td>
                                <td><?= $s['status'] ?></td>
                                <td><?= date_format(date_create($s['created_dt']), "Y/m/d H:i a") ?></td>
                                <td><a href="#" class="btn btn-sm blue-sharp">Edit</a></td>
                                <td><a href="#" class="btn btn-sm red">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>