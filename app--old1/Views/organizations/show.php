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
                    <span class="caption-subject bold">Organization [<?= $organization['OrgName'] ?>]</span>
                </div>
                <div class="actions">
                    <a href="<?= base_url(route_to('application_index', $organization['Id'])); ?>" class="btn green-jungle pull-right">
                        Manage Applications <i class="fa fa-database icon-black"></i>
                    </a>
                </div>
            </div>
            <form class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="200">ID</th>
                                <td>
                                    <input type="text" class="form-control" value="<?= $organization['Id'] ?>" name="record_ID" id="record_id" />
                                </td>
                            </tr>
                            <tr>
                                <th width="200">Organization Name</th>
                                <td><?= $organization['OrgName'] ?></td>
                            </tr>
                            <tr>
                                <th width="200">Organization Description</th>
                                <td>
                                    <input type="text" class="form-control" value="<?= $organization['OrgDescr'] ?>" name="OrgDescr" id="OrgDescr" />
                                </td>
                            </tr>
                            <tr>
                                <th width="200">Address</th>
                                <td>
                                    <?= "{$organization["AddressLine1"]}, {$organization["AddressLine2"]}, {$organization["City"]}, {$organization["State"]}, {$organization["ZipCode"]}, {$organization["Country"]}" ?>
                                </td>

                            </tr>
                            <tr>
                                <th width="200">Zip Code</th>
                                <td>
                                    <input type="text" class="form-control" value="<?= $organization['ZipCode'] ?>" name="ZipCode" id="ZipCode" />
                                </td>
                            </tr>
                            <tr>
                                <th width="200">Contact Name</th>
                                <td>
                                    <input type="text" class="form-control" value="<?= $organization['ContactName'] ?>" name="ContactName" id="ContactName" />
                                </td>
                            </tr>
                            <tr>
                                <th width="200">Contact Phone</th>
                                <td>
                                    <input type="text" class="form-control" value="<?= $organization['ContactPhone'] ?>" name="ContactPhone" id="ContactPhone" />
                                </td>
                            </tr>
                            <tr>
                                <th width="200">Contact Email</th>
                                <td>
                                    <input type="text" class="form-control" value="<?= $organization['ContactEmail'] ?>" name="ContactEmail" id="ContactEmail" />
                                </td>
                            </tr>
                            <tr>
                                <th width="200">Created Date</th>
                                <td><?= date("d/m/Y h:i a", strtotime($organization["CreatedDt"])) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="margin-top-20">
                    <button id="resend-notification-button" type="button" class="btn blue">
                        Resend Notification <i class="fa fa-bell icon-black"></i>
                    </button>
                    <button id="submit" type="submit" class="btn blue">
                        Submit <i class="fa fa-paper-plane icon-black"></i>
                    </button>
                    <a class="btn red" href="<?= base_url(route_to('organization_delete', $organization["Id"])); ?>" onclick="return confirm('Are you sure you want to delete this record?')">
                        Delete <i class="fa fa-times icon-black"></i>
                    </a>

                    <div id="resend-notification-response" class="margin-top-10">
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

<?= $this->endSection() ?>