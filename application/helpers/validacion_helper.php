<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Verifica si hay una sesion de usuario 'admin' en curso
 */
function verificarSesionAdmin()
{
  if (isset($_SESSION['usuario_tipo_id']) && $_SESSION['usuario_tipo_id'] == 2)
    return;

  show_404();
}

/**
 * Verifica si hay una sesion en curso
 */
function verificarSesion()
{
  if (isset($_SESSION['usuario_tipo_id']))
    return;

  show_404();
}

/**
 * Verifica si es una llamada (request) desde Ajax
 */
function verificarConsulAjax()
{
  $CI = &get_instance();

  if (!$CI->input->is_ajax_request()) {
    show_404();
  }
}

function permisoAdmin()
{
  return ($_SESSION['usuario_tipo_id'] == 2);
}

function permisoInspector()
{
  return ($_SESSION['usuario_tipo_id'] == 3);
}

function permisoInspector_Admin()
{
  return ($_SESSION['usuario_tipo_id'] == 3 || $_SESSION['usuario_tipo_id'] == 2);
}

function permisoVerificador()
{
  return ($_SESSION['usuario_tipo_id'] == 4);
}
function permisoLiquidador()
{
  return ($_SESSION['usuario_tipo_id'] == 5);
}

