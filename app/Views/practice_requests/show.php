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
                                <td><?= $application['contact_email'] ?><br />(<?= ($application['contact_prefix'] != null ? ($application['contact_prefix'] . " ") : "") . $application['contact_firstname'] . ' ' . $application['contact_firstname'] . ($application['contact_suffix'] != null ? (" " . $application['contact_suffix']) : "") ?>)</td>
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
            <div class="portlet-body form">
                <form action="<?= base_url(route_to('practice_request_approve', $application['ID'])) ?>" method="POST" class="horizontal-form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Deployment Type</label>
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="deployment_type" value="dedicated_server" checked>Dedicated Server
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="deployment_type" value="co_tenant">Co-tenant
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div id="database-form-section" class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Database Server & Template</label>
                                    <select name="template" class="form-control">
                                        <option value="">Please select...</option>
                                        <?php foreach ($databaseServerTemplates as $dst) : ?>
                                            <option value="<?= $dst['ID'] ?>">
                                                <?= "{$dst['server_name']} => {$dst['template_name']} => {$dst['template_description']}" ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="servers-form-section" class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Server</label>
                                    <select name="server" class="form-control">
                                        <option value="">Please select...</option>
                                        <?php foreach ($servers as $s) : ?>
                                            <option value="<?= $dst['ID'] ?>">
                                                <?= "{$s['name']} => {$s['endpoint_address']} => {$s['host_address']}" ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="stamps-form-section" class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Attach to tenant (Overrides Server)</label>
                                    <select name="stamp" class="form-control">
                                        <option value="">No parent tenant (must select Server)</option>
                                        <?php foreach ($stamps as $name => $stamp) : ?>
                                            <option value="<?= $name ?>">
                                                <?= "{$name} =>  (Deployments: {$stamp['Deployments']}) =>  ({$stamp['name']})" ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="parent-practices-form-section" class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="parent_practice" class="form-control">
                                        <option value="" selected="selected">No parent tenant (set primary, must select Server)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button id="deploy-button" type="submit" class="btn green-jungle">
                            Deploy <i class="fa fa-cloud-upload"></i>
                        </button>
                        <button type="button" class="btn red">
                            Cancel <i class="fa fa-times"></i>
                        </button>
                    </div>
                </form>
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
        var deploymentTypeInput = $('input[name=deployment_type]');
        var templateSelect = $('select[name=template]');
        var serverSelect = $('select[name=server]');
        var stampSelect = $('select[name=stamp]');
        var parentPracticeSelect = $('select[name=parent_practice]');
        var dedicatedServerFormSections = $('#database-form-section, #servers-form-section');
        var coTenantFormSections = $('#stamps-form-section, #parent-practices-form-section');
        var deployButton = $('#deploy-button');

        var selectedParentPractice = "";

        function validateDeploymentOptions() {
            let isValidOptions = false;

            var selectedDeploymentType = $('input[name=deployment_type]:checked').val();

            if (selectedDeploymentType === "dedicated_server") {
                isValidOptions = templateSelect.val() === "" || serverSelect.val() === ""
            } else if (selectedDeploymentType === "co_tenant") {
                isValidOptions = stampSelect.val() === "" || parentPracticeSelect.val() === ""
            }

            deployButton.prop("disabled", isValidOptions);
        }

        function setPracticesSelectOption(practices) {
            parentPracticeSelect.empty();
            parentPracticeSelect.append('<option value="">No parent tenant (set primary, must select Server)</option>');

            practices.forEach(function(practice) {
                var option = $('<option />');
                option.attr('value', practice.ID)
                    .text(`${practice.PracticeConfig_ID} (${practice.name})`);

                if (practice.id == selectedParentPractice) {
                    option.attr('selected', 'selected');
                }

                parentPracticeSelect.append(option);
            });
        }

        function handleOnChangeStamp() {
            validateDeploymentOptions();

            var stamp = stampSelect.val();

            if (!stamp) return false;

            $.getJSON(`/deployed-practices/filter/${stamp}`)
                .done(setPracticesSelectOption);
        }

        function handleOnChangeDeploymentType() {
            var selectedDeploymentType = $('input[name=deployment_type]:checked').val();

            if (selectedDeploymentType === "dedicated_server") {
                parentPracticeSelect.add(stampSelect).val("").change();
                dedicatedServerFormSections.show();
                coTenantFormSections.hide();
            } else if (selectedDeploymentType === "co_tenant") {
                serverSelect.add(templateSelect).val("").change();
                dedicatedServerFormSections.hide();
                coTenantFormSections.show();
            }
        }

        handleOnChangeDeploymentType();
        validateDeploymentOptions();

        deploymentTypeInput.on('change', handleOnChangeDeploymentType);
        templateSelect.on('change', validateDeploymentOptions);
        serverSelect.on('change', validateDeploymentOptions);
        stampSelect.on('change', handleOnChangeStamp);
        parentPracticeSelect.on('change', validateDeploymentOptions);

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