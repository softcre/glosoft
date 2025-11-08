window.onload = function() {
    formatoTabla('tblLiquidadores');
  };
  
  //-CAMBIO EL FORMATO DE INGRESO DE VALOR EN BASE A UNIDAD DE MEDIDA-
  function changeFormatoPresentacion() {
    /* let unidad_medida = document.getElementById('unidad_medida');
    let valor = document.getElementById('valor');
  
    if (unidad_medida.value == 3) { // unidad de medida (3 => UNIDADES)
      valor.step = 0;
    } else {
      valor.step = 0.001;
    } */
  }
  
  //-------------------ELIMINA UNA PRESENTACION-------------------
  function eliminarUser(ele) {
      const title = "Eliminar";
      const mensaje = "El liquidador " + ele.dataset.name + " se eliminará...";
      bajaRegistro(ele, ele.dataset.url, title, mensaje);
  }
  