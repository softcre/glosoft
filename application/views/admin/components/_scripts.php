<!-- REQUIRED SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS core -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Bootstrap 5 integration JS -->
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Bootstrap 5 CSS -->
<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- Bootstrap bundle (v5.x) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="<?= base_url(ADMIN_JS . '/template/adminlte.min.js'); ?>"></script>
<script src="<?= base_url(ADMIN_JS . '/index.js'); ?>"></script>

<script>
// Initialize Bootstrap dropdowns
document.addEventListener('DOMContentLoaded', function() {
  var dropdownElementList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="dropdown"]'));
  var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
    return new bootstrap.Dropdown(dropdownToggleEl);
  });
});
</script>
