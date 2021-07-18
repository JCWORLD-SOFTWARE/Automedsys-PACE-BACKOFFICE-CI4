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
            <span>Application Management</span>
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

<h3 class="page-title">Application Management</h3>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-green-jungle">
                    <span class="caption-subject bold">Application [<?= $application['PracticeCode'] ?>]</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td><?= $application['ID'] ?></td>
                                <th>Address</th>
                            </tr>
                            <tr>
                                <th>Practice Name (Username)</th>
                                <td><?= $application['PracticeName'] ?> (<?= $application['username'] ?>)</td>
                                <td rowspan="4">
                                    <?= $application['Street1'] ?>
                                    <br />
                                    <?= $application['Street2'] ?>
                                    <br />
                                    <?= $application['City'] ?>
                                    <br />
                                    <?= $application['State'] ?>
                                    <br />
                                    <?= $application['ZipCode'] ?>
                                    <br />
                                    <?= $application['Country'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Tax ID</th>
                                <td><?= $application['TaxID'] ?></td>
                            </tr>
                            <tr>
                                <th>Practice NPI (Reference)</th>
                                <td><?= $application['NPI'] ?> (<?= $application['PracticeCode'] ?>)<br /></td>
                            </tr>
                            <tr>
                                <th>Provider NPI</th>
                                <td><?= $application['provider_NPI'] ?></td>
                            </tr>
                            <tr>
                                <th>Type / Status</th>
                                <td><?= $application['PracticeType'] ?></td>
                                <td><?= $application['status'] ?></td>
                            </tr>
                            <tr>
                                <th>Phone (Fax)</th>
                                <td><?= $application['phone'] ?> (<?= $application['fax'] ?>)</td>
                                <th>Username / Password</th>
                            </tr>
                            <tr>
                                <th>Contact Email (Name)</th>
                                <td><?= $application['contact_email'] ?><br />(<?= ($application['contact_prefix'] != NULL ? ($application['contact_prefix'] . " ") : "") . $application['contact_firstname'] . ' ' . $application['contact_firstname'] . ($application['contact_suffix'] != NULL ? (" " . $application['contact_suffix']) : "") ?>)</td>
                                <td><?= $application['username'] . "/" . $application['userpwd'] ?></td>
                            </tr>
                            <tr>
                                <th>Promotion Code / Extcode</th>
                                <td><?= $application['promotion_code'] ?></td>
                                <td><?= $application['extCode'] ?></td>
                            </tr>
                            <tr>
                                <th>Created Date</th>
                                <td><?= strtok($application['created_dt'], ' ') ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-green-jungle">
                    <span class="caption-subject bold">Deployment</span>
                </div>
            </div>
            <div class="portlet-body">
                <button id="validate-npi-button" type="button" class="btn green-jungle">
                    Validate NPI <i class="fa fa-database icon-black"></i>
                </button>

                <div class="row  margin-top-20">
                    <div class="col-md-6">
                        <div class="note note-info">
                            <h4 class="block">Practice NPI (<?= $application['NPI'] ?>)</h4>
                            <p>
                            <pre id="practice-npi-data" class="npi-data-output">N/A</pre>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="note note-info">
                            <h4 class="block"> Provider NPI (<?= $application['provider_NPI'] ?>)</h4>
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
                    <div class="col-md-6">
                        <div class="note note-info">
                            <h4 class="block">Practice NPI (<?= $application['NPI'] ?>)</h4>
                            <p>
                            <pre id="practice-npi-data" class="npi-data-output">N/A</pre>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="note note-info">
                            <h4 class="block"> Provider NPI (<?= $application['provider_NPI'] ?>)</h4>
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
        var validateNpiButton = $('#validate-npi-button');
        var practiceNpiDataContainer = $('#practice-npi-data');
        var providerNpiDataContainer = $('#provider-npi-data');

        validateNpiButton.on('click', function() {
            validateNpiButton.html("Validating NPI...").prop("disabled", true);
            practiceNpiDataContainer.html("Fetching data...");
            providerNpiDataContainer.html("Fetching data...");

            $.when($.getJSON("/practice-requests/validate-npi/<?= $application['NPI'] ?>"),
                    $.getJSON("/practice-requests/validate-npi/<?= $application['provider_NPI'] ?>"))
                .then(function(practiceNpiData, providerNpiData) {
                    practiceNpiDataContainer.html(formatObjectToPrettyJson(practiceNpiData));
                    providerNpiDataContainer.html(formatObjectToPrettyJson(providerNpiData));
                }).done(function() {
                    validateNpiButton
                        .html('Validate NPI <i class="fa fa-database icon-black"></i>')
                        .prop("disabled", false);
                });
        });
    });
</script>
<?= $this->endSection() ?>