window.onload = function () {
	formatoTabla("tblInspecciones");
};

//-------------------ELIMINA UNA INSPECCION-------------------
function eliminar(ele) {
	const title = "Eliminar";
	const mensaje = "El acta de inspección N° " + ele.dataset.name + " se eliminará...";
	bajaRegistro(ele, ele.dataset.url, title, mensaje);
}
