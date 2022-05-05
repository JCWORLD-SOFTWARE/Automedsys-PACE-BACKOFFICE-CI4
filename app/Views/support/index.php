<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?= base_url(route_to('home')); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Support</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Contact Us</span>
        </li>
    </ul>
</div>

<h3 class="page-title">Contact Us</h3>

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
                <div class="row">
                    <div class="col-md-2 caption font-green-jungle">
                        <span class="caption-subject bold">Contact us</span>
                    </div>
                    <div class="col-md-5 text-center page-toolbar" >
                        <!-- Date Filter -->
                        <div class="page-toolbar">
                            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                                <i class="icon-calendar"></i>&nbsp;
                                <span class="thin uppercase hidden-xs"></span>&nbsp;
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                        <table style="width: 90%; display: none;">
                            <tr>
                                <td class="form-group">
                                    <div class="row">
                                        <label for="search_fromdate" class="col-md-3 btn">From </label>
                                        <div class="col-md-8">
                                            <input type='date' id='search_fromdate' class="datepicker date-filter form-control btn btn-primary">
                                        </div>
                                    </div>
                                </td>
                                <td class="form-group">
                                    <div class="row">
                                        <label for="search_todate" class="col-md-2 text-center btn"> To </label>
                                        <div class="col-md-9">
                                            <input type='date' id='search_todate' class="datepicker date-filter form-control btn btn-primary">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input type='button' id="btn_search" class="btn btn-success" value="Search">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 text-right actions">
                        <button data-toggle="collapse" data-target="#filter" class="btn blue btn-outline">
                            Search <i class="fa fa-search icon-black"></i>
                        </button>
                    </div>
                </div>
            
                <div class="portlet-body">
                    <form id="filter" class="filter-panel bg-default form-horizontal collapse <?= $isFiltered ? "in" : "" ?>">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email Address</label>
                                <div class="col-md-4">
                                    <input type="text" name="emailAddress" value="<?= old('emailAddress', $filter["emailAddress"]) ?>" class="form-control" placeholder="Enter Email Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Firstname</label>
                                <div class="col-md-4">
                                    <input type="text" name="firstName" value="<?= old('firstName', $filter["firstName"]) ?>" class="form-control" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Lastname</label>
                                <div class="col-md-4">
                                    <input type="text" name="lastName" value="<?= old('lastName', $filter["lastName"]) ?>" class="form-control" placeholder="Enter Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Message</label>
                                <div class="col-md-4">
                                    <input type="text" name="message" value="<?= old('message', $filter["message"]) ?>" class="form-control" placeholder="Enter Message">
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-4">
                                        <button type="submit" class="btn green">Filter Results <i class="fa fa-filter icon-black"></i></button>
                                        <?php if ($isFiltered) : ?>
                                            <a href="<?= base_url(route_to('contact_us')); ?>" class="btn red btn-outline">
                                                Remove Filters <i class="fa fa-times icon-black"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <?= $pager->links() ?>

                        <table class="table table-bordered"  style="font-size: 12px;">
                            <thead>
                                <tr>

                                <th style="width: 100px; overflow: hidden">Date Created</th>
                                    <th style="width: 60px; overflow: hidden">Email Address</th>
                                    <th style="width: 80px; overflow: hidden">Firstname</th>
                                    <th style="width: 80px; overflow: hidden">Lastname</th>
                                    <th style="width: 85px; overflow: hidden">Phone number</th>
                                    <th style="width: 125px; overflow: hidden">Message</th>

                                    <th style="width: 100px; overflow: hidden">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $ii = 0;
                                    foreach ($prospectivePractices as $practice) :
                                        $ii++;
                                        $color = ($ii % 2 === 0) ? "#ffffff" : "#efefef";
                                        ?>
                                        <tr style="background-color: <?= $color ?>;">

                                        <td class="center" nowrap="" style="width: 100px; overflow: hidden"><?= date("dS M y \n h:i a", strtotime($practice["created_dt"])) ?></td>
                                        
                                      
                                            <td style="width: 60px; overflow: hidden"><?= $practice["emailAddress"] ?></td>

                                            <td style="width: 80px; overflow: hidden"><?= ucfirst($practice["firstName"]); ?></td>
                                            <td style="width: 80px; overflow: hidden"><?= ucfirst($practice["lastName"]); ?></td>
                                            <td style="width: 85px; overflow: hidden"><?= $practice["phoneNumber"] ?></td>
                                            <td style="width: 25px; height: 15px; overflow: hidden"><?php 
                                            
                                            $mess = $practice["message"];
                                             
                                            for($i = 0; $i < 35; $i++) {
                                                print($mess[$i]);
                                            }
                                               if (strlen($mess) >= 35){
                                                
                                            print("...");
                                        }
                                        else{
                                            print("");
                                        }

                                       
                                            
                                            ?>
                                            
                                        
                                        </td>
                                            <td>
                                                <button type="button" onclick="showModal<?= $ii; ?>()" class="btn btn-primary"><i class="fa fa-eye "></i></button>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <!-- Modal -->
                                      

                                        <div class="modal" style="display: none; background: rgba(0, 0, 0, 0.5);" id="exampleModal<?= $ii; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="text-align: center;">
                                                        <style>
                                                            .mb20{
                                                                margin-bottom: 20px;
                                                            }
                                                        </style>
                                                        <div class="form-inline">
                                                            <label for="date">Date: </label>
                                                            <input type="text" name="date" value="<?= date("d/m/Y h:i a", strtotime($practice["created_dt"])) ?>" style="border: none;" />
                                                            <label for="IP">IP: </label>
                                                            <input type="text" name="IP" value="000.000.000.00:0000" style="border: none;"/>
                                                            <label for="status">Customer's status: </label>
                                                            <input type="text" name="status" value="None" style="border: none;"/>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="form-group row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12 mb20">
                                                                    <label for="firstname">First name <i class="text-danger">*</i></label>
                                                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="firstname" value="<?= $practice["firstName"] ?>" aria-describedby="helpId">
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 mb20">
                                                                    <label for="lastname">Last name <i class="text-danger">*</i></label>
                                                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="lastname" value="<?= $practice["lastName"] ?>" aria-describedby="helpId">
                                                                </div>
                                                                <div class="col-lg-12 mb20">
                                                                    <label for="email">Email Address<i class="text-danger">*</i></label>
                                                                    <input type="text" name="email" id="email" class="form-control" placeholder="email" value="<?= $practice["emailAddress"] ?>" aria-describedby="helpId">
                                                                </div>
                                                                <div class="col-lg-12 mb20">
                                                                    <label for="phone">Phone number<i class="text-danger">*</i></label>
                                                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="phone" value="<?= $practice["phoneNumber"] ?>" aria-describedby="helpId">
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 mb20">
                                                                    <label for="pcategory">Product Category <i class="text-danger">*</i></label>
                                                                    <select class="form-control" name="" id="">
                                                                        <option>Product Category </option>
                                                                        <option>Product Category </option>
                                                                        <option>Product Category </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 mb20">
                                                                    <label for="ptype">Practice Type<i class="text-danger">*</i></label>
                                                                    <select class="form-control" name="" id="">
                                                                        <option>Practice Type</option>
                                                                        <option>Practice Type</option>
                                                                        <option>Practice Type</option>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <div class="col-lg-12 mb20">
                                                                    <label for="message">Message</label>
                                                                    <textarea class="form-control" name="message" id="message" rows="6"><?= $practice["message"] ?></textarea>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" onclick="closeModal<?= $ii; ?>()" data-dismiss="modal">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            function closeModal<?= $ii; ?>(){
                                                $("#exampleModal<?= $ii; ?>").css("display", "none");
                                            }
                                            function showModal<?= $ii; ?>(){
                                                $("#exampleModal<?= $ii; ?>").css("display", "block");
                                            }
                                        </script>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $pager->links() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
