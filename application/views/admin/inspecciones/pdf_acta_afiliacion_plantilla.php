<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Solicitud de Afiliación</title>

<style>
  body {
    font-family: sans-serif;
    font-size: 11px;
    color: #000;
    margin: 0;
    padding: 10px;
  }

  @page { margin: 10px; size: A4; }

  table { width: 100%; border-collapse: collapse; margin-bottom: 6px; }
  td, th { border: 1px solid #000; padding: 4px; }
  .header { text-align:center; font-size:16px; font-weight:bold; padding:6px; border:1px solid #000; }
  .section-title { background:#e0e0e0; font-weight:bold; padding:4px; }
  .no-border td, .no-border th { border:0; }
  .small { font-size:10px; }
</style>

</head>

<body>

<!-- ENCABEZADO UATRE -->
<table>
  <tr>
    <td style="width:20%; height:45px; text-align:center;">AFILIADO:<br><br>__________</td>
    <td style="width:60%; text-align:center; border-left:0; border-right:0;">
      <div style="font-size:22px; font-weight:bold;">UATRE</div>
      Unión Argentina de Trabajadores Rurales y Estibadores <br>
      Personería Gremial Nº 155 – Adherida a la C.G.T. – Reconquista 630 Cap. Fed.
    </td>
    <td style="width:20%; text-align:center;">SECCIONAL:<br><br>__________</td>
  </tr>
</table>

<table>
  <tr>
    <td style="text-align:right; padding-right:6px;">FICHA:</td>
    <td style="width:80px;">_________</td>
  </tr>
</table>

<!-- TEXTO LEGAL -->
<table class="no-border">
  <tr>
    <td style="font-size:10px; text-align:justify;">
      Siendo un trabajador de la actividad y estando en total acuerdo con los estatutos del gremio, solicito mi afiliación al mismo
      y autorizo para que de mis haberes, el empleador me practique la retención de la cuota sindical como afiliado y según los montos
      que resuelva el Congreso de la UATRE, como así también cualquier otro aporte a la Organización dispuesto por autoridad competente
      y/o órganos naturales de la Institución. Presto juramento de ley en relación a la veracidad de los datos que a continuación denuncio:
    </td>
  </tr>
</table>

<!-- DATOS PERSONALES -->
<table>
  <tr>
    <td><strong>APELLIDO:</strong><br><?= $afiliacion->apellido; ?></td>
    <td><strong>NOMBRES:</strong><br><?= $afiliacion->nombre; ?></td>
  </tr>
  <tr>
    <td><strong>NACIONALIDAD:</strong><br><?= $afiliacion->nacionalidad; ?></td>
    <td><strong>ESTADO CIVIL:</strong><br><?= $afiliacion->estado_civil; ?></td>
  </tr>
  <tr>
    <td><strong>FECHA DE NACIMIENTO:</strong><br><?= $afiliacion->fecha_nacimiento; ?></td>
    <td>
      <strong>SEXO:</strong>
      <br>
      Fem: <?= ($afiliacion->sexo === 'F') ? 'X' : ' '; ?> &nbsp;&nbsp;&nbsp;
      Masc: <?= ($afiliacion->sexo === 'M') ? 'X' : ' '; ?>
    </td>
  </tr>
  <tr>
    <td><strong>TIPO Y Nº DE DOCUMENTO:</strong><br><?= $afiliacion->tipo_doc.' '.$afiliacion->nro_doc; ?></td>
    <td><strong>C.U.I.L Nº:</strong><br><?= $afiliacion->cuil; ?></td>
  </tr>
  <tr>
    <td><strong>OFICIO Y ESPECIALIDAD:</strong><br><?= $afiliacion->oficio; ?></td>
    <td><strong>PROVINCIA:</strong><br><?= $afiliacion->provincia; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>ACTIVIDAD QUE DESARROLLA:</strong><br><?= $afiliacion->actividad; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>DOMICILIO REAL:</strong><br><?= $afiliacion->domicilio; ?> — <?= $afiliacion->localidad; ?></td>
  </tr>
</table>

<!-- FIRMA -->
<table>
  <tr>
    <td style="height:60px; text-align:center; vertical-align:bottom;">
      _______________________________<br>
      FIRMA DEL SOLICITANTE
    </td>
  </tr>
</table>

<!-- DATOS EMPLEADOR -->
<table>
  <tr>
    <td><strong>CUIT EMPLEADOR:</strong><br>
      <?= isset($empleador->cuit) ? $empleador->cuit : ''; ?>
    </td>
    <td><strong>CUIT (Alternativo):</strong><br>
      <?= isset($empleador->cuit_alt) ? $empleador->cuit_alt : ''; ?>
    </td>
  </tr>
  <tr>
    <td><strong>EMPLEADOR:</strong><br><?= isset($empleador->nombre) ? $empleador->nombre : ''; ?></td>
    <td><strong>LOCALIDAD:</strong><br><?= isset($empleador->localidad) ? $empleador->localidad : ''; ?></td>
  </tr>
  <tr>
    <td><strong>DOMICILIO EMPLEADOR:</strong><br><?= isset($empleador->domicilio) ? $empleador->domicilio : ''; ?></td>
    <td><strong>LUGAR DE TRABAJO:</strong><br><?= isset($empleador->lugar_trabajo) ? $empleador->lugar_trabajo : ''; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>ACTIVIDAD:</strong><br><?= isset($empleador->actividad) ? $empleador->actividad : ''; ?></td>
  </tr>
</table>

<!-- NOTA RECIBO -->
<table class="no-border">
  <tr>
    <td><strong>SE DEBERÁ ADJUNTAR FOTOCOPIA DEL RECIBO DE SUELDOS Y JORNALES</strong></td>
  </tr>
</table>

<!-- APROBACIÓN SECRETARIADO -->
<table>
  <tr>
    <td style="height:90px; vertical-align:top;">
      El Secretariado aprueba / rechaza, la presente afiliación y ordena su incorporación al Registro de afiliados con el número
      de ficha correspondiente. Reunión del Secretariado Nacional de fecha: .......... / .......... / ..........
      <br><br>
      Se extendió carnet el día: .......... / .......... / ..........
    </td>
    <td style="width:35%; text-align:center; vertical-align:bottom;">
      _______________________________<br>
      SECRETARIO GENERAL<br>
      SELLO Y FIRMA
    </td>
  </tr>
</table>

<!-- NOTA FINAL -->
<table class="no-border">
  <tr>
    <td class="small">
      NOTA: A los efectos de la validez legal de la presente solicitud, la misma debe ser acompañada obligatoriamente con
      fotocopia del último recibo de cobro del causante, caso contrario no será aceptada por las autoridades de la U.A.T.R.E.
      La copia debe ser remitida por la seccional, la cual será devuelta firmada por las autoridades de la U.A.T.R.E para archivo
      de Seccional.
    </td>
  </tr>
</table>

</body>
</html>
