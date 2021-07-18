<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url(route_to('home')); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Server Management</span>
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

<h3 class="page-title">Server Management</h3>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-green-jungle">
                    <span class="caption-subject bold">Servers</span>
                </div>
                <div class="actions">
                    <a href="javascript:;" class="btn green-jungle pull-right">
                        Add Server <i class="fa fa-plus icon-black"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body flip-scroll">
                <table class="table table-striped flip-content">
                    <thead class="flip-content">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Host Address</th>
                            <th>Port</th>
                            <th>Binding</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Edit</th>
                            <th>Delete</th>
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