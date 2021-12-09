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
            <span>Application Management</span>
        </li>
    </ul>
</div>

<h3 class="page-title">Application Management</h3>

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
                    <span class="caption-subject bold">Applications</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <?= $pager->makeLinks($pagination['page'], $pagination['perPage'], $pagination['total']) ?>

                    <table class="table table-bordered" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th width="30">ID</th>
                                <th>Practice Name<br>(Username)</th>
                                <th>Tax ID</th>
                                <th>Practice NPI<br>(Code)</th>
                                <th>Type / Status</th>
                                <th>Phone (Fax)</th>
                                <th>Contact Email<br>(Name)</th>
                                <th>Created</th>
                                <th>Edit / Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($practiceRequests as $pr) : ?>
                                <tr>
                                    <td rowspan="2"><?= $pr["ID"] ?></td>
                                    <td><?= $pr["PracticeName"] ?> (<?= $pr["PracticeName"] ?>)</td>
                                    <td><?= $pr["TaxID"] ?></td>
                                    <td><?= $pr["NPI"] ?><br />(<?= $pr["PracticeCode"] ?>)</td>
                                    <td><?= $pr["PracticeType"] ?></td>
                                    <td><?= $pr["phone"] ?> (<?= $pr["fax"] ?>)</td>
                                    <td><?= $pr["contact_email"] ?><br />(<?= $pr["contact_firstname"] . ' ' . $pr["contact_firstname"] ?>)</td>
                                    <td class="center" nowrap=""><?= str_replace(' ', '<br/>', strtok($pr["created_dt"], '.')) ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-block green" href="/crud/applicationupdate?id=2">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><?= "{$pr["Street1"]} {$pr["Street2"]}, {$pr["City"]}, {$pr["State"]}, {$pr["ZipCode"]}, {$pr["Country"]}" ?></td>
                                    <td class="center"><?= $pr["status"] ?></td>
                                    <td class="server-db-name" colspan="2"><?= $pr["Server"] ?> / <?= $pr["DBName"] ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-block green-jungle" href="<?= base_url(route_to('practice_request_show', $pr["PracticeCode"])); ?>" onclick="return confirm('Are you sure you want to approve this practice?')">Approve Practice</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-block red" href="#" onclick="return confirm('Are you sure you want to delete this application?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?= $pager->makeLinks($pagination['page'], $pagination['perPage'], $pagination['total']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>