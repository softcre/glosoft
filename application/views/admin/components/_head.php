<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?> | <?= APP_NAME; ?></title>

  <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media='all'"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    

	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
	<!-- <link rel="stylesheet" href="<?= base_url(ADMIN_FONTS . '/fontSansPro.css'); ?>">
	<link rel="stylesheet" href="<?= base_url(ADMIN_PLUGINS . '/fontawesome-free/css/all.min.css'); ?>"> -->
	<link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(APP_FAVICON . '/android-icon-192x192.png'); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(APP_FAVICON . '/favicon-32x32.png'); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(APP_FAVICON . '/favicon-16x16.png'); ?>">
	<link rel="stylesheet" href="<?= base_url(ADMIN_CSS . '/template/adminlte.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url(ADMIN_CSS . '/index.css'); ?>">
</head>