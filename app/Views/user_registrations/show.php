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
            <span>User Registration Management</span>
        </li>
    </ul>
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
                    <span class="caption-subject bold">User Registration [<?= "{$user['FirstName']} {$user['LastName']}" ?>]</span>
                </div>
            </div>
            <form class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="200">ID</th>
                                <td>
                                    <input type="text" value="<?= old('record_id', $user['Id']) ?>" name="record_Id" id="" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <th width="200">First Name</th>
                                <td>
                                    <input type="text" name="first_name" value="<?= old('first_name', $user["FirstName"]) ?>" class="form-control" placeholder="Enter First Name">
                                    <?php if (isset(session('errors')['first_name'])) : ?>
                                        <span class="help-block text-danger font-sm">
                                            <?= session('errors')['first_name'] ?>
                                        </span>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="200">Last Name</th>
                                <td>
                                    <input type="text" name="last_name" value="<?= old('last_name', $user["LastName"]) ?>" class="form-control" placeholder="Enter Last Name">
                                    <?php if (isset(session('errors')['last_name'])) : ?>
                                        <span class="help-block text-danger font-sm">
                                            <?= session('errors')['last_name'] ?>
                                        </span>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="200">Provider NPI</th>
                                <td>
                                    <input type="text" name="npi" value="<?= old('npi', $user["ProviderNPI"]) ?>" class="form-control" placeholder="Enter NPI">
                                    <?php if (isset(session('errors')['npi'])) : ?>
                                        <span class="help-block text-danger font-sm">
                                            <?= session('errors')['npi'] ?>
                                        </span>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="200">Telephone</th>
                                <td>
                                    <input type="text" name="phone_number" value="<?= old('phone_number', $user["Telephone"]) ?>" class="form-control" placeholder="Enter Phone Number">
                                    <?php if (isset(session('errors')['phone_number'])) : ?>
                                        <span class="help-block text-danger font-sm">
                                            <?= session('errors')['phone_number'] ?>
                                        </span>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="200">Created Date</th>
                                <td><?= date("d/m/Y h:i a", strtotime($user["created_dt"])) ?></td>
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
                    <a class="btn red" href="<?= base_url(route_to('user_registration_delete', $user["UniqueId"])); ?>" onclick="return confirm('Are you sure you want to delete this record?')">
                        Delete <i class="fa fa-times icon-black"></i>
                    </a>

                    <div id="resend-notification-response" class="margin-top-10">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-green-jungle">
                    <span class="caption-subject bold">NPI Validation</span>
                </div>
            </div>
            <div class="portlet-body">
                <button id="validate-npi-button" type="button" class="btn green-jungle">
                    Validate NPI <i class="fa fa-database icon-black"></i>
                </button>

                <div class="row  margin-top-20">
                    <div class="col-md-12">
                        <div class="note note-info">
                            <h4 class="block"> Provider NPI (<?= $user['ProviderNPI'] ?>)</h4>
                            <p>
                            <pre id="provider-npi-data" class="npi-data-output">N/A</pre>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function formatObjectToPrettyJson(data) {
        return JSON.stringify(data, '', 4)
            .replace(/\n( *)/g, function(match, p1) {
                return '<br>' + '&nbsp;'.repeat(p1.length);
            })
    }

    $(document).ready(function() {
        var resendNotificationButton = $('#resend-notification-button');
        var resendNotificationResponseContainer = $('#resend-notification-response');
        var validateNpiButton = $('#validate-npi-button');
        var providerNpiDataContainer = $('#provider-npi-data');

        resendNotificationButton.on('click', function() {
            resendNotificationButton.html("Resending notification...").prop("disabled", true);
            resendNotificationResponseContainer.html("");

            $.ajax({
                    method: "POST",
                    url: "/user-registrations/resend-notification/<?= $user['UniqueId'] ?>",
                })
                .done(function(data) {
                    resendNotificationResponseContainer.html(`<span class="font-green-jungle">Notification resent successfully!</span>`);
                })
                .fail(function(error) {
                    resendNotificationResponseContainer.html(`<span class="font-red">${error.responseJSON.error}</span>`);
                })
                .always(function() {
                    resendNotificationButton
                        .html('Resend Notification <i class="fa fa-bell icon-black"></i>')
                        .prop("disabled", false);
                });
        });

        validateNpiButton.on('click', function() {
            validateNpiButton.html("Validating NPI...").prop("disabled", true);
            providerNpiDataContainer.html("Fetching data...");

            $.getJSON("/practice-requests/validate-npi/<?= $user['ProviderNPI'] ?>")
                .done(function(data) {
                    providerNpiDataContainer.html(formatObjectToPrettyJson(data));
                })
                .fail(function(error) {
                    providerNpiDataContainer.html('Validation Failed <i class="fa fa-database icon-black"></i>');
                })
                .always(function() {
                    validateNpiButton
                        .html('Validate NPI <i class="fa fa-database icon-black"></i>')
                        .prop("disabled", false);
                })
        });
    });
</script>
<?= $this->endSection() ?>