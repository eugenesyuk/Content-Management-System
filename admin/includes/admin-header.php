<?php 
    ob_start();
    session_start();
    require_once( dirname(__DIR__). '/../includes/config.php'); 
    if (!isset($_SESSION['username'])): header("Location: ".ADMINURL."login.php");
    else: 
        require_once( ABSPATH. 'admin/includes/functions.php'); 
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SKmusique | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="apple-touch-icon" sizes="57x57" href="<?= HOMEURL; ?>images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?= HOMEURL; ?>images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= HOMEURL; ?>images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= HOMEURL; ?>images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?= HOMEURL; ?>images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= HOMEURL; ?>images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?= HOMEURL; ?>images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= HOMEURL; ?>images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= HOMEURL; ?>images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?= HOMEURL; ?>images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= HOMEURL; ?>images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= HOMEURL; ?>images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= HOMEURL; ?>images/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?= HOMEURL; ?>images/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?= HOMEURL; ?>images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>admin/css/bootstrap.css">
        <!-- Bootstrap Additional elements -->
        <link href="<?= HOMEURL; ?>admin/css/bootstrap-select.css" rel="stylesheet">
        <link href="<?= HOMEURL; ?>admin/css/bootstrap-tagsinput.css" rel="stylesheet">
        <link href="<?= HOMEURL; ?>admin/css/bootstrap-fileinput.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Main style -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>admin/css/style.css">
        <link rel="stylesheet" href="<?= HOMEURL; ?>admin/css/skin.css">        
        <!-- Loader -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>admin/css/loader.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>admin/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?= HOMEURL; ?>admin/plugins/iCheck/all.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>admin/plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>admin/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>admin/plugins/daterangepicker/daterangepicker-bs3.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    
        <!-- jQuery 2.1.4 -->
        <script src="<?= HOMEURL; ?>admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    </head>

    <body class="hold-transition skin sidebar-mini fixed">
        <?php include( ABSPATH. 'admin/includes/preloader.php'); ?>
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?= ADMINURL; ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>SK</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>SK</b>musique</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <?php include( ABSPATH. 'admin/includes/admin-navigation.php'); ?>
            </header>
<?php endif ?>