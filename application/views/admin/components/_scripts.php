<!-- REQUIRED SCRIPTS -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="<?= base_url(ADMIN_PLUGINS . '/sweetalert2/sweetalert2.all.min.js'); ?>"></script> -->
<script src="<?= base_url(ADMIN_JS . '/template/adminlte.min.js'); ?>"></script>
<!-- <script src="<?= base_url(ADMIN_JS . '/index.js') ?>"></script> -->
<script src="<?= base_url('assets/js/admin/index.js') ?>"></script>

<script>
// Initialize Bootstrap dropdowns
document.addEventListener('DOMContentLoaded', function() {
  var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
  var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
    return new bootstrap.Dropdown(dropdownToggleEl);
  });
});

</script>
<!-- Modal chico -->
		<div class="modal fade" id="small" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content" id="modal-small">
					<!-- Contenido modal -->
				</div>
			</div>
		</div>

		<!-- Modal grande-->
		<div class="modal fade" id="large" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content" id="modal-large">
					<!-- Contenido modal -->
				</div>
			</div>
		</div>

		<!-- Modal extra grande-->
		<div class="modal fade" id="extra-large" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-xl">
				<div class="modal-content" id="modal-extra-large">
					<!-- Contenido modal -->
				</div>
			</div>
		</div>
</body>

</html>