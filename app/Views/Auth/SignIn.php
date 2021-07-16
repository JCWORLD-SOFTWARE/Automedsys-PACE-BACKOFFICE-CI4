<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Metronic | User Login 3</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?= base_url(); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?= base_url(); ?>/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?= base_url(); ?>/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?= base_url(); ?>/assets/pages/css/login-3.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />

        <style>
            body {
                min-height: 100vh;
                background-image: url(https://dev-pace.automedsys.net/webtool/img/practice/slider/1.jpg);
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;
            }
        </style>
    </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="<?= base_url(); ?>/assets/pages/img/logo-big.png" alt="" height="80" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="index.html" method="post">
                <h3 class="form-title">Login to your account</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                
                <div class="form-group">
                    <a href="<?= base_url(route_to('initiate_google_oauth')); ?>" class="btn default btn-circle btn-block btn-lg">
                        <span>Google</span> <img src="https://www.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" height="24">
                    </a>
                </div>

                <div class="form-group">
                    <a href="#" class="btn default btn-circle btn-block btn-lg">
                        <span>Identrust</span> <img src="data:image/jpeg;base64,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QDwrrI4u7fYBzJm7gVm3Wix4HZ9hHrn8Odf5Sv8Axrfx/wBuSSrpBZZrq60x8FfwyqccbGoC77qc8EDOF85Uza6/aprdaqq2uuI3yqsFCoDjeZm4DjwA4kzMo/bYnJCV6z2Xguz3A8zkf7cy3Wix4HZ9hHzh/Dk11O1iiV71TfCLeCVBlLbwGWy2d0KAMk/fMX7Xaug23Usj7wRU3lYszMFXDLw4kxkxBfyjr/2w/wAX9qdqdZ7KMLs91HcHIH2Vyd6zaYrsoq3S1l7MAAfJVE3nc94GVHpYTXbS6SGvwzLQ1lWn+OcOox4oZgqni2ARNEX/ACpv+4P/ADD+HOrUdZW+pWzZrOp5hnJH1GuTfX7YKtUlVRustUuq7wTdRQMsS3rAYmNVtd660aygi6xxWlYdTljk538YAwpP0QK403S/T1tv17GVH7wQD3/svNNm/WYW4Ns5mA5ZfOPrrkz0W2ma/wCD3UtTaUNiZZWV0VgrbrL2gsOB75uxAq5esgA5GzSCORD/ANud35Un/cH/AJh/DlmRAqPWdOKrvjdkh8895gf9qearpVpUOV2Mit3g8f8ASlyxArGvrOZRhdnOqjkA5H2eDnL8qT/uD/zD+HLMiBVes6xVtXdt2Yzr3M+R9tc19XSnSqd5diop7xj8KXJECsK+swqoVNnOqgYADkAfQK5I9j6ejaFA1FtDIbHZijMxwyFa88hzFKHl7ZLIgdGloVFCIMKvAcc9uec74iAiIgIiICIiAiIgIiICaXpRc66ZxUrNY+K03QSQbDu73DsAJOfNN1MYgQ/VBadRpamRzTp62cFK3cGwruKPFBHAFj6TPS/hGdtZZWyrTWy6dCMuxbiWZVzgnCgDnz75J4gQzobpKwEO9qheF37Vc3JUbH4sdxsITk/ZOna2ge6rWagK3hVdW043TvbmkO8AoPHLk2Dz7wk4xM4gRFDbVoLLFRvhd+84UKd5bLm3UB7fFBXn+rPfrqTptD4LTqWda1qrCgkliAgY45cTkmb/ABMYgRnamhK6fT6OoMVdkrZgCQK6xvOzHl4wXHn3pvdbaEqdgpYIrEKoJJ3V8kAdvZPTiMQNF0R2QNNp0BGLGUNYTknJ4hePILnGJz6QvYwXT07yvdkM4BxXX+k29y3uwDzzdiDAhNWyrKddolLGymuq9UIrCqmVrG6zLwyd0c+fGctvYvdW0qX165GCI+66IFDje8IT4rpjeOOMmeJmBFOkz125rFeoOpr40PWjrhyvArYPF3ew5PLImNqC1RofhAewVlW1DVqWzateASqjO6WJP1SWYjECN6MO99mssV1RK/B6dCp3yud93KcwWIUAc8LNJptk2B9GbPCuuosss1NbZNSncd13wB2MEADEjOJP5jECD37lutua/wCFJulKaTUL0Vl5sxdAAQWbHPHiz3a/VBdbWHS01UVEoVrscNbad3ygCCVReef0zJXiYAgaLZulezUNqrlKeJ4KhD5SoW3mZu5mIHDsCib4TMQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQERED/2Q==" height="24">
                    </a>
                </div>
                
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <!-- END LOGIN -->
        <!--[if lt IE 9]>
<script src="<?= base_url(); ?>/assets/global/plugins/respond.min.js"></script>
<script src="<?= base_url(); ?>/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?= base_url(); ?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?= base_url(); ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?= base_url(); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>