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

//-------------------CARGA LOCALIDADES POR PROVINCIA-------------------
// Function to load localidades
function cargarLocalidades(provinciaId, preserveSelection = false) {
	const localidadSelect = $('#localidad');
	
	if (!provinciaId || provinciaId === '') {
		localidadSelect.html('<option value="">Seleccione una localidad</option>');
		localidadSelect.prop('disabled', true);
		return;
	}
	
	// Save the currently selected localidad_id BEFORE any changes (for edit mode)
	// This must be done before disabling or clearing the dropdown
	const currentLocalidadId = preserveSelection && localidadSelect.length ? localidadSelect.val() : null;
	
	// Enable localidad dropdown
	localidadSelect.prop('disabled', false);
	
	// Show loading state (this clears the selected value, so we saved it above)
	localidadSelect.html('<option value="">Cargando...</option>');
	
	// Construct URL - try multiple approaches
	let url = null;
	
	// Method 1: Extract from form action URL
	const form = localidadSelect.closest('form');
	if (form.length && form.attr('action')) {
		const actionUrl = form.attr('action');
		// Extract base path (e.g., /glosoft/admin/expedientes/crear -> /glosoft/admin/expedientes/getLocalidades)
		url = actionUrl.replace(/\/crear$/, '').replace(/\/actualizar$/, '') + '/getLocalidades';
	}
	
	// Method 2: Use BASE_URL constant if available
	if (!url && typeof BASE_URL !== 'undefined') {
		// Remove trailing slash if present
		const base = BASE_URL.endsWith('/') ? BASE_URL.slice(0, -1) : BASE_URL;
		url = base + '/admin/expedientes/getLocalidades';
	}
	
	// Method 3: Construct from current page URL
	if (!url) {
		const currentPath = window.location.pathname;
		// If we're on the expedientes index page, use relative path
		if (currentPath.includes('/expedientes')) {
			const basePath = currentPath.substring(0, currentPath.lastIndexOf('/expedientes') + '/expedientes'.length);
			url = window.location.origin + basePath + '/getLocalidades';
		} else {
			// Fallback: try to construct admin/expedientes path
			url = window.location.origin + '/admin/expedientes/getLocalidades';
		}
	}
	
	// AJAX call to get localidades
	$.ajax({
		url: url,
		method: 'POST',
		data: {
			provincia_id: provinciaId
		},
		success: function(resp) {
			try {
				let data = typeof resp === 'string' ? JSON.parse(resp) : resp;
				
				if (data.status === 'ok' && data.data && data.data.localidades) {
					// Populate localidad dropdown
					localidadSelect.html('<option value="">Seleccione una localidad</option>');
					
					if (data.data.localidades.length > 0) {
						$.each(data.data.localidades, function(index, localidad) {
							localidadSelect.append(
								$('<option></option>')
									.attr('value', localidad.id_localidad)
									.text(localidad.nombre)
							);
						});
						
						// Restore the previously selected localidad_id if we're preserving selection (edit mode)
						if (preserveSelection && currentLocalidadId) {
							// Check if the saved localidad_id exists in the loaded options
							if (localidadSelect.find('option[value="' + currentLocalidadId + '"]').length > 0) {
								localidadSelect.val(currentLocalidadId);
							}
						}
					} else {
						localidadSelect.html('<option value="">No hay localidades disponibles</option>');
					}
				} else {
					localidadSelect.html('<option value="">No hay localidades disponibles</option>');
				}
			} catch (e) {
				console.error('Error parsing response:', e, resp);
				localidadSelect.html('<option value="">Error al cargar localidades</option>');
			}
		},
		error: function(xhr, status, error) {
			console.error('Error loading localidades:', error, xhr);
			localidadSelect.html('<option value="">Error al cargar localidades</option>');
		}
	});
}

// Use event delegation to handle dynamically loaded modal content
$(document).on('change', '#provincia', function() {
	const provinciaId = $(this).val();
	// When user manually changes provincia, don't preserve selection (clear it)
	cargarLocalidades(provinciaId, false);
});

// Also handle when modal is shown to ensure handler is ready
$(document).on('shown.bs.modal', '.modal', function() {
	// Small delay to ensure modal content is fully loaded
	setTimeout(function() {
		// Check if provincia is already selected (for edit mode)
		const provinciaSelect = $(this).find('#provincia');
		const localidadSelect = $(this).find('#localidad');
		
		if (provinciaSelect.length && provinciaSelect.val()) {
			// Check if there's already a selected localidad value (edit mode)
			// This happens when PHP has already populated the dropdown with the selected value
			// We need to save this BEFORE loading new options
			const currentLocalidadValue = localidadSelect.length && localidadSelect.val() ? localidadSelect.val() : null;
			const hasSelectedLocalidad = currentLocalidadValue && currentLocalidadValue !== '';
			
			// Always load localidades if provincia is selected (they might need refreshing)
			// But preserve the selection if we're in edit mode
			cargarLocalidades(provinciaSelect.val(), hasSelectedLocalidad);
		}
	}.bind(this), 50);
});