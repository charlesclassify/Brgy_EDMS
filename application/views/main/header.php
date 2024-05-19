<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>BRGY KPEDMS</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/kp_brand.png" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <link href="<?= base_url('assets/css/styles1.css'); ?>" rel="stylesheet" />

</head>

<style>
    /* Active sidebar item style */
    .nav-link.active {
        background-color: #5BB14D;
        /* Change the background color to red */
    }
</style>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?= base_url('main/dashboard'); ?>"></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <span style="color:white;">Hello, Brgy User!</span>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= base_url('') ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Modules</div>
                        <a id="nav-link" class="nav-link" href="<?= base_url('main/dashboard') ?>">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                            Dashboard
                        </a>
                        <a id="nav-link" class="nav-link" href="<?= base_url('main/user') ?>">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            User Management
                        </a>
                        <a id="nav-link" class="nav-link" href="<?= base_url('main/criminal_cases') ?>">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-handcuffs"></i></div>
                            Criminal Cases
                        </a>
                        <a id="nav-link" class="nav-link" href="<?= base_url('main/civil_cases') ?>">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-scale-unbalanced"></i></div>
                            Civil Cases
                        </a>
                        <a id="nav-link" class="nav-link" href="<?= base_url('main/reports') ?>">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file-lines"></i></div>
                            Reports
                        </a>
                        <a id="nav-link" class="nav-link" href="<?= base_url('main/logs') ?>">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-shoe-prints"></i></div>
                            Logs
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">