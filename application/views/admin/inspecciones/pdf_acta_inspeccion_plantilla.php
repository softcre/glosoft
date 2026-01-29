<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Acta de Inspección</title>

<style>
  body {
    font-family: sans-serif;
    font-size: 11px;
    color: #333;
    margin: 0;
    padding: 10px;
  }

  @page {
    size: A4;
    margin: 10px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 6px;
  }

  td, th {
    border: 1px solid #000;
    padding: 4px;
  }

  .header {
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    padding: 6px;
    border: 1px solid #000;
    margin-bottom: 6px;
  }

  .section-title {
    background: #e0e0e0;
    font-weight: bold;
    text-align: left;
    padding: 4px;
  }

</style>
</head>

<body>

<div class="header">
  ACTA DE INSPECCIÓN DE ESTABLECIMIENTO <br>
  Nº <?= $inspeccion->id_inspeccion; ?>
</div>

<!-- DATOS DEL EMPLEADOR -->
<table>
  <tr><td class="section-title" colspan="2">DATOS DEL EMPLEADOR</td></tr>
  <tr>
    <td><strong>Razón Social / Nombre:</strong><br><?= $inspeccion->establecimiento_nombre; ?></td>
    <td><strong>C.U.I.L / C.U.I.T (si existiera):</strong><br><?= $inspeccion->cuit; ?></td>
  </tr>
</table>

<!-- FECHA INSPECCIÓN -->
<table>
  <tr><td class="section-title" colspan="2">DATOS DE INSPECCIÓN</td></tr>
  <tr>
    <td><strong>Fecha Inspección:</strong><br><?= formatearfecha($inspeccion->fecha_inspeccion); ?></td>
    <td><strong>Inspector Actuante:</strong><br><?= $inspeccion->inspector_nombre; ?></td>
  </tr>
</table>

<!-- DATOS DEL ESTABLECIMIENTO -->
<table>
  <tr><td class="section-title" colspan="2">DATOS DEL ESTABLECIMIENTO</td></tr>
  <tr>
    <td><strong>Nombre del Establecimiento:</strong><br><?= $inspeccion->establecimiento_nombre; ?></td>
    <td><strong>Actividad Principal:</strong><br><?= $inspeccion->actividad_principal; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Ubicación / Dirección:</strong><br><?= $inspeccion->ubicacion; ?></td>
  </tr>
</table>

<!-- SUPERFICIE -->
<table>
  <tr><td class="section-title" colspan="2">SUPERFICIE Y EXPLOTACIÓN</td></tr>
  <tr>
    <td><strong>Superficie Total (ha):</strong><br><?= $inspeccion->superficie_ha; ?></td>
    <td><strong>Tipo de Explotación:</strong><br><?= $inspeccion->actividad_principal; ?></td>
  </tr>
</table>

<!-- PERSONAL -->
<table>
  <tr><td class="section-title" colspan="3">PERSONAL OCUPADO</td></tr>
  <tr>
    <td><strong>Permanentes:</strong><br><?= $inspeccion->cantidad_personal_perm; ?></td>
    <td><strong>Transitorios:</strong><br><?= $inspeccion->cantidad_personal_trans; ?></td>
    <td><strong>Total:</strong><br><?= $inspeccion->cantidad_personal_perm + $inspeccion->cantidad_personal_trans; ?></td>
  </tr>
</table>

<!-- OBSERVACIONES -->
<table>
  <tr><td class="section-title">OBSERVACIONES</td></tr>
  <tr>
    <td style="height:120px; vertical-align: top;">
      <?= nl2br($inspeccion->observaciones ?? ''); ?>
    </td>
  </tr>
</table>

<!-- FIRMAS -->
<table>
  <tr>
    <td style="height:60px; vertical-align: bottom; text-align:center;">
      _______________________________<br>
      Firma Inspector<br><?= $inspeccion->inspector_nombre; ?>
    </td>
    <td style="height:60px; vertical-align: bottom; text-align:center;">
      _______________________________<br>
      Firma Empleador / Responsable
    </td>
  </tr>
</table>

</body>
</html>
