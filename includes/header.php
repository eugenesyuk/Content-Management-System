<?php 
    ob_start();
    session_start();
    include( dirname(__FILE__). '/config.php');
    include( ABSPATH. 'includes/functions.php'); 
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- META DATA -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- GOOGLE FONT -->
        <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300italic,400italic,300,700,700italic,900italic,900' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,400italic,600italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
        <!-- MENU CSS -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>css/menuzord.css">
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- ICON FONT STROKE 7-->
        <link rel="stylesheet" href="<?= HOMEURL; ?>css/pe-icon-7-stroke.css">
        <!-- ICON FONT ETLINE -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>css/etline.css">
        <!-- BUTTON STYLE CSS -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>css/hover.css">
        <!-- Bootstrap -->
        <link href="<?= HOMEURL; ?>css/bootstrap.css" rel="stylesheet">
        <!-- STYLESHEET -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>css/style.css">
        <!-- LOADER -->
        <link rel="stylesheet" href="<?= HOMEURL; ?>css/loader.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
    </head>

    <body>
        <?php include( ABSPATH. 'includes/preloader.php'); ?>
            <!-- SEARCH OVERLAY -->
            <div class="full-page-search">
                <form action="<?= HOMEURL; ?>search.php" method="post">
                    <input class="form-control" type="text" name="search" placeholder="Search...">
                    <button class="fa fa-search src_btn" type="submit" name="submit" id="searchsubmit"></button>
                </form>
                <div class="sr-overlay"></div>
            </div>

            <!-- HEADER SECTION-->
            <header>
                <?php include( ABSPATH. "includes/navigation.php"); ?>
            </header>
            <!-- END HEADER SECTION-->