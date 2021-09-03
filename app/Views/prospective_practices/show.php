<?= $this->extend('layouts/master') ?>

<?= $this->section('head') ?>
<style>
    .server-db-name {
        word-break: break-word;
    }

    .npi-data-output {
        max-height: 300px;
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
</div>

<h3 class="page-title">Practice Management</h3>

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
                    <span class="caption-subject bold">Prospective Practice [<?= $practice['PracticeCode'] ?>]</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td><?= $practice['ID'] ?></td>
                                <th>Address</th>
                            </tr>
                            <tr>
                                <th>Practice Name (Username)</th>
                                <td><?= $practice['PracticeName'] ?></td>
                                <td rowspan="4">
                                    <?= $practice['Street1'] ?>
                                    <br />
                                    <?= $practice['Street2'] ?>
                                    <br />
                                    <?= $practice['City'] ?>
                                    <br />
                                    <?= $practice['State'] ?>
                                    <br />
                                    <?= $practice['ZipCode'] ?>
                                    <br />
                                    <?= $practice['Country'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Tax ID</th>
                                <td><?= $practice['TaxID'] ? $practice['TaxID'] : "N/A" ?></td>
                            </tr>
                            <tr>
                                <th>Practice NPI (Reference)</th>
                                <td><?= $practice['NPI'] ?> (<?= $practice['PracticeCode'] ?>)<br /></td>
                            </tr>
                            <tr>
                                <th>Provider NPI</th>
                                <td><?= $practice['NPI'] ?></td>
                            </tr>
                            <tr>
                                <th>Phone (Fax)</th>
                                <td colspan="2"><?= $practice['phone'] ?> (<?= $practice['fax'] ? $practice['fax'] : "N/A" ?>)</td>
                            </tr>
                            <tr>
                                <th>Contact Email (Name)</th>
                                <td colspan="2"><?= $practice['contact_email'] ?> (<?= ($practice['contact_prefix'] != null ? ($practice['contact_prefix'] . " ") : "") . $practice['contact_firstname'] . ' ' . $practice['contact_firstname'] . ($practice['contact_suffix'] != null ? (" " . $practice['contact_suffix']) : "") ?>)</td>
                            </tr>
                            <tr>
                                <th>Created Date</th>
                                <td colspan="2"><?= strtok($practice['created_dt'], ' ') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>