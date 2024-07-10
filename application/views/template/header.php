<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('public/assets/'); ?>images\logo.png">

    <!-- plugin css -->
    <link href="<?php echo base_url('public/assets/'); ?>libs\jquery-vectormap\jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">

    <!-- App css -->
    <link href="<?php echo base_url('public/assets/'); ?>css\bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/'); ?>css\icons.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/'); ?>css\app.min.css" rel="stylesheet" type="text/css">
    <!-- third party css -->

    <link href="<?php echo base_url('public/assets/'); ?>libs\datatables\dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/'); ?>libs\datatables\responsive.bootstrap4.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/'); ?>libs\datatables\buttons.bootstrap4.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/'); ?>libs\datatables\select.bootstrap4.css" rel="stylesheet" type="text/css">
    <!-- third party css end -->
</head>

<body class="left-side-menu-dark">

    <!-- Begin page -->
    <div id="wrapper">

        <?php $this->load->view('template/topbar'); ?>
        <?php $this->load->view('template/leftbar'); ?>