// Function to check if an element is visible (including Bootstrap tab panes)
function isElementVisible(selector) {
	const element = $(selector);
	if (!element.length) return false;
	
	// Check if element itself is visible
	if (!element.is(':visible')) return false;
	
	// Check if any parent is hidden
	if (element.parents(':hidden').length > 0) return false;
	
	// Check if it's in a Bootstrap tab pane that's not active
	const tabPane = element.closest('.tab-pane');
	if (tabPane.length && !tabPane.hasClass('active') && !tabPane.hasClass('show')) {
		return false;
	}
	
	return true;
}

// Function to initialize expedientes tables
function inicializarTablasExpedientes(forceVisibleOnly = true) {
	// Initialize only the visible table (first tab)
	if ($("#tblExpedientesEnProgreso").length) {
		// Check if table is visible or if we're forcing visible only
		if (!forceVisibleOnly || isElementVisible("#tblExpedientesEnProgreso")) {
			if ($.fn.dataTable.isDataTable("#tblExpedientesEnProgreso")) {
				$("#tblExpedientesEnProgreso").DataTable().destroy();
			}
			formatoTabla("tblExpedientesEnProgreso");
		}
	}
	
	// Only initialize cerrados table if it's visible (not hidden in tab)
	if (!forceVisibleOnly && $("#tblExpedientesCerrados").length) {
		if (isElementVisible("#tblExpedientesCerrados")) {
			if ($.fn.dataTable.isDataTable("#tblExpedientesCerrados")) {
				$("#tblExpedientesCerrados").DataTable().destroy();
			}
			formatoTabla("tblExpedientesCerrados");
		}
	}
	
	// Set up event listener for the second tab if not already set
	const cerradosTab = document.getElementById('cerrados-tab');
	if (cerradosTab && !cerradosTab.hasAttribute('data-listener-attached')) {
		cerradosTab.setAttribute('data-listener-attached', 'true');
		cerradosTab.addEventListener('shown.bs.tab', function (event) {
			// Check if table exists and DataTable is not already initialized
			if ($("#tblExpedientesCerrados").length && !$.fn.dataTable.isDataTable("#tblExpedientesCerrados")) {
				// Small delay to ensure tab is fully visible
				setTimeout(function() {
					if (isElementVisible("#tblExpedientesCerrados")) {
						formatoTabla("tblExpedientesCerrados");
					}
				}, 50);
			}
		});
	}
}

window.onload = function () {
	inicializarTablasExpedientes();
	
	// Watch for AJAX content updates in expedientes-main div
	const expedientesMain = document.getElementById('expedientes-main');
	if (expedientesMain) {
		let observerTimeout;
		const observer = new MutationObserver(function(mutations) {
			// Debounce to avoid multiple rapid calls
			clearTimeout(observerTimeout);
			observerTimeout = setTimeout(function() {
				// Only reinitialize visible tables after AJAX update
				// This prevents initializing hidden tables
				if ($("#tblExpedientesEnProgreso").length || $("#tblExpedientesCerrados").length) {
					inicializarTablasExpedientes(true); // true = only visible tables
				}
			}, 150);
		});
		
		observer.observe(expedientesMain, {
			childList: true,
			subtree: true
		});
	}
	
	// Also intercept formatoTabla calls for the old table ID
	// This handles the AJAX response handler's call
	if (typeof window.formatoTabla === 'function') {
		const originalFormatoTabla = window.formatoTabla;
		window.formatoTabla = function(tabla) {
			// Prevent initializing hidden expedientes tables
			if (tabla === 'tblExpedientesCerrados' && !isElementVisible("#tblExpedientesCerrados")) {
				// Table is hidden, skip initialization to avoid DataTables column count error
				return;
			}
			
			// If trying to initialize old table ID that doesn't exist, use new tables
			if (tabla === 'tblExpedientes' && !$("#tblExpedientes").length) {
				// Check if we're on the expedientes page
				if ($("#tblExpedientesEnProgreso").length || $("#tblExpedientesCerrados").length) {
					inicializarTablasExpedientes(true); // true = only visible tables
					return;
				}
			}
			// Otherwise use original function
			originalFormatoTabla(tabla);
		};
	}
}

//-------------------ELIMINA UN EXPEDIENTE-------------------
function eliminar(ele) {
	const title = "Eliminar";
	const mensaje = "El expediente N° " + ele.dataset.name + " se eliminará...";
	bajaRegistro(ele, ele.dataset.url, title, mensaje);
}
