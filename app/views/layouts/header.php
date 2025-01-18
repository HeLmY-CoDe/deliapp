<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($view_title ?? 'Título') . ' | ' . APP_NAME; ?></title>
    <!-- Icono personalizado -->
    <link rel="icon" type="image/x-icon" href="<?= APP_URL; ?>favicon.ico">

    <!-- styles CSS -->
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="<?= VENDOR_URL; ?>bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?= VENDOR_URL; ?>bootstrap-icons/bootstrap-icons.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?= VENDOR_URL; ?>datatables/css/datatables.min.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL; ?>assets/css/theme-toggle.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?= VENDOR_URL; ?>animate-css/animate.min.css">
    <!-- main styles -->
    <link rel="stylesheet" href="<?= PUBLIC_URL; ?>assets/css/main.css">

    <!-- scripts JS -->
    <!-- Bootstrap 5 JS -->
    <script defer src="<?= VENDOR_URL; ?>bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script defer src="<?= VENDOR_URL; ?>datatables/js/datatables.min.js"></script>
    <script defer src="<?= PUBLIC_URL; ?>assets/js/theme-toggle.js"></script>
    <!-- globals JS -->
    <script async src="<?= PUBLIC_URL; ?>assets/js/globals.js"></script>
    <!-- main scripts -->
    <script defer src="<?= PUBLIC_URL; ?>assets/js/main.js"></script>
</head>

<body>