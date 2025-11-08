<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Devuelve fecha actual del sistema
 * 
 * @param string $format Formato de salida a eleccion
 * 
 * @return string Fecha y hora actual del sistema en formato indicado
 */
function fechaHoraHoy($format = 'Y-m-d H:i:s')
{
  return date($format);
}

/**
 * Devuelve una fecha en el formato elegido
 * 
 * @param string $fecha Fecha en cualquier formato
 * @param string $format Formato de salida a eleccion
 * 
 * @return string Fecha en formato elegido
 */
function formatearFecha($fecha, $format = 'd/m/Y')
{
  return date($format, strtotime($fecha));
}

/**
 * Devuelve un string en minuscula
 * 
 * @param string $texto
 * 
 * @return string en minúscula
 */
function minuscula($texto)
{
  return mb_strtolower($texto, 'UTF-8');
}

/**
 * Devuelve un string en mayuscula
 * 
 * @param string $texto
 * 
 * @return string en mayuscula
 */
function mayuscula($texto)
{
  return mb_strtoupper($texto, 'UTF-8');
}

/**
 * Recibe el stock de ingredientes y devuelve decimal o int en
 * base al id_unidad_medida
 * @param float $stock numero en cualquier formato
 * @param int $simbolo_id id de unidad de medida
 * @return string stock
 */
function tipoStock($stock, $simbolo_id)
{
  if ($simbolo_id == UM_ID_UNIDAD)
    return intval($stock);
  else
    return $stock;
}

/**
 * Recibe el stock de ingredientes y devuelve formateado en
 * base al id_unidad_medida
 * @param float $stock numero en cualquier formato
 * @param int $simbolo_id id de unidad de medida
 * @return string stock formateado
 */
function formatearStock($stock, $simbolo_id)
{
  if ($simbolo_id == UM_ID_UNIDAD)
    return formatearNumero($stock, 0);
  else
    return formatearNumero($stock, 3);
}

/**
 * Recibe un numero y lo devuelve con formato ###,##
 * @param float $numero numero en cualquier formato
 * @param int $decimales numero de decimales
 * @return string numero formateado
 */
function formatearNumero($numero, $decimales = 2)
{
  if ($numero == 0) {
    return '$ 0,00'; // Return a specific format for zero values
  } else {
    return number_format($numero, $decimales, ',', '.');
  }
}
/**
 * Recibe un numero y lo devuelve con formato ###,##
 * @param float $numero numero en cualquier formato
 * @param int $decimales numero de decimales
 * @return string numero formateado
 */
function formatearNumeroSolo($numero, $decimales = 2)
{
  if ($numero == 0) {
    return '0,00'; // Return a specific format for zero values
  } else {
    return number_format($numero, $decimales, ',', '.');
  }
}
/**
 * Recibe un porcentaje y lo devuelve con formato ###,##
 * @param float $porcentaje porcentaje en cualquier formato
 * @param int $decimales porcentaje de decimales
 * @return string porcentaje formateado
 */
function formatearPorcentaje($porcentaje, $decimales = 2)
{
  if ($porcentaje == 0) {
    return '0,00 %'; // Return a specific format for zero values
  } else {
    return  number_format($porcentaje, $decimales, ',', '.').' %';
  }
}

/**
 * Recibe un precio y lo devuelve con formato ###,##
 * @param float $precio precio en cualquier formato
 * @param int $decimales precio de decimales
 * @return string precio formateado
 */
function formatearPrecio($precio, $decimales = 2)
{
  if ($precio == 0) {
    return '$ 0,00'; // Return a specific format for zero values
  } else {
    return '$ ' . number_format($precio, $decimales, ',', '.');
  }
}

/**
 * Recibe una cantidad y lo devuelve con formato ###,##
 * @param float $cantidad cantidad en cualquier formato
 * @param int $decimales cantidad de decimales
 * @return string cantidad formateado
 */
function formatearCantidad($cantidad, $decimales = 2)
{
  if ($cantidad == 0) {
    return '0,00 Kg'; // Return a specific format for zero values
  } else {
    return number_format($cantidad, $decimales, ',', '.').' Kg';
  }
}


/**
 * Indica el color correspondiente para el estado de la observacion
 * 
 * @param int $estado_id Estado de la observacion
 * 
 * @return string Color perteneciente al estado
 */
function colorEstadoPago($estado)
{
  switch ($estado) {
    case 'paid':
      $color = 'badge-success';
      break;
    case 'pending':
      $color = 'badge-warning';
      break;
    case 'debin_created':
      $color = 'badge-warning';
      break;
    case 'transfer_created':
      $color = 'badge-warning';
      break;
    case 'transfer_canceled':
      $color = 'badge-danger';
      break;
    case 'transfer_rejected':
      $color = 'badge-danger';
      break;
    case 'rejected':
      $color = 'badge-danger';
      break;
    case 'expired':
    $color = 'badge-danger';
    break;
    default:
      $color = '';
      break;
  }
  return $color;
}

/**
 * Indica el color correspondiente para el estado de la inspeccion
 * 
 * @param int $estado_id Estado de la inspeccion
 * 
 * @return string Color perteneciente al estado
 */
function colorEstadoInspeccion($estado)
{
  switch ($estado) {
    case 'INICIADO':
      $color = 'text-bg-secondary';
      break;
    case 'INSPECCION':
      $color = 'text-bg-primary';
      break;
    case 'VERIFICACION':
      $color = 'text-bg-warning';
      break;
    case 'LIQUIDACION':
      $color = 'text-bg-success';
      break;
    case 'CIERRE':
      $color = 'text-bg-success';
      break;
    default:
      $color = '';
      break;
  }
  return $color;
}

function textoEstadoPago($estado)
{
  switch ($estado) {
    case 'paid':
      $texto = 'ABONADO';
      break;
    case 'pending':
      $texto = 'PENDIENTE';
      break;
    case 'debin_created':
      $texto = 'DEBIN CREADO';
      break;
    case 'transfer_created':
      $texto = 'TRANSFERENCIA CREADA';
      break;
    case 'transfer_canceled':
      $texto = 'TRANSFERENCIA CANCELADA';
      break;
    case 'transfer_rejected':
      $texto = 'TRANSFERENCIA RECHAZADA';
      break;
    case 'rejected':
      $texto = 'RECHAZADO';
      break;
    case 'expired':
      $texto = 'VENCIDO';
      break;
    default:
      $texto = '';
      break;
  }
  return $texto;
}

/**
 * Indica el color correspondiente para el tipo de evento
 * 
 * @param string tipo de eento
 * 
 * @return string Color perteneciente al tipo
 */
function colorTipoEvento($tipo)
{
  switch ($tipo) {
    case 'DEPORTIVO':
      $color = 'badge-success';
      break;
    case 'DIGITAL':
      $color = 'badge-warning';
      break;
    default:
      $color = '';
      break;
  }
  return $color;
}

function textoTipoEvento($tipo)
{
  switch ($tipo) {
    case 'DEPORTIVO':
      $texto = 'TRADICIONAL';
      break;
    case 'DIGITAL':
      $texto = 'ESPORT';
      break;
    default:
      $texto = '';
      break;
  }
  return $texto;
}

/**
 * Indica el color correspondiente para el tipo de torneo
 * 
 * @param string tipo de eento
 * 
 * @return string Color perteneciente al tipo
 */
function colorTipoTorneo($tipo)
{
  switch ($tipo) {
    case 'DEPORTIVO':
      $color = 'badge-success';
      break;
    case 'DIGITAL':
      $color = 'badge-warning';
      break;
    default:
      $color = '';
      break;
  }
  return $color;
}

function textoTipoTorneo($tipo)
{
  switch ($tipo) {
    case 'DEPORTIVO':
      $texto = 'TRADICIONAL';
      break;
    case 'DIGITAL':
      $texto = 'ESPORT';
      break;
    default:
      $texto = '';
      break;
  }
  return $texto;
}

/**
 * Indica el color correspondiente para el estado del torneo
 * 
 * @param string estado torneo
 * 
 * @return string Color perteneciente estado
 */
function colorEstadoTorneo($tipo)
{
  // Handle null or empty values
  if ($tipo === null || $tipo === '') {
    return 'badge-secondary';
  }
  
  switch (strtolower($tipo)) {
    // Challonge status values (English, lowercase)
    case 'pending':
      $color = 'badge-warning';
      break;
    case 'underway':
      $color = 'badge-info';
      break;
    case 'complete':
    case 'completed':
      $color = 'badge-success';
      break;
    // Internal sistema status values (Spanish, uppercase)
    case 'sin iniciar':
      $color = 'badge-secondary';
      break;
    case 'listo':
      $color = 'badge-warning';
      break;
    case 'en curso':
      $color = 'badge-info';
      break;
    case 'finalizado':
      $color = 'badge-success';
      break;
    case 'cancelado':
      $color = 'badge-danger';
      break;
    default:
      $color = 'badge-secondary';
      break;
  }
  return $color;
}

function textoEstadoTorneo($tipo)
{
  // Handle null or empty values
  if ($tipo === null || $tipo === '') {
    return 'SIN ESTADO';
  }
  
  switch (strtolower($tipo)) {
    // Challonge status values (English, lowercase)
    case 'pending':
      $texto = 'PENDIENTE';
      break;
    case 'underway':
      $texto = 'EN CURSO';
      break;
    case 'complete':
    case 'completed':
      $texto = 'COMPLETADO';
      break;
    // Internal sistema status values (Spanish, uppercase)
    case 'sin iniciar':
      $texto = 'SIN INICIAR';
      break;
    case 'listo':
      $texto = 'LISTO';
      break;
    case 'en curso':
      $texto = 'EN CURSO';
      break;
    case 'finalizado':
      $texto = 'FINALIZADO';
      break;
    case 'cancelado':
      $texto = 'CANCELADO';
      break;
    default:
      $texto = strtoupper($tipo);
      break;
  }
  return $texto;
}