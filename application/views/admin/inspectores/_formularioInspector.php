<!-- === User form === -->
<form id="userForm" autocomplete="off">
  <!-- Fake hidden fields to absorb autofill -->
  <input type="text" name="fakeusernameremembered" style="display:none">
  <input type="password" name="fakepasswordremembered" style="display:none">

  <div class="row g-3">
    <div class="col-md-6">
      <label for="nombre" class="form-label" title="Obligatorio">
        Nombre <span class="text-danger">*</span>
      </label>
      <input type="text"
             class="form-control"
             id="nombre"
             name="nombre"
             placeholder="Nombre"
             value="<?= isset($usuarios->nombre) ? $usuarios->nombre : ''; ?>"
             required
             autocomplete="off">
    </div>

    <div class="col-md-6">
      <label for="apellido" class="form-label" title="Obligatorio">
        Apellido <span class="text-danger">*</span>
      </label>
      <input type="text"
             class="form-control"
             id="apellido"
             name="apellido"
             placeholder="Apellido"
             value="<?= isset($usuarios->apellido) ? $usuarios->apellido : ''; ?>"
             required
             autocomplete="off">
    </div>

    <div class="col-md-6">
      <label for="user_email" class="form-label" title="Obligatorio">
        Email <span class="text-danger">*</span>
      </label>
      <input type="email"
             class="form-control"
             id="user_email"
             name="user_email"
             placeholder="Email"
             value=""
             required
             autocomplete="off">
    </div>

    <div class="col-md-6">
      <label for="user_pass" class="form-label" title="Obligatorio">
        Contraseña <span class="text-danger">*</span>
      </label>
      <div class="input-group">
        <input type="password"
               class="form-control"
               id="user_pass"
               name="user_pass"
               placeholder="Contraseña"
               value=""
               autocomplete="new-password"
               oninput="handlePasswordInput(this)">
        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
          <i class="toggle-password bi bi-eye-fill"></i>
        </button>
      </div>
    </div>

    <div class="col-md-6">
      <label for="telefono" class="form-label" title="Obligatorio">
        Teléfono <span class="text-danger">*</span>
      </label>
      <input type="tel"
             class="form-control"
             id="telefono"
             name="telefono"
             placeholder="Teléfono"
             value="<?= isset($usuarios->telefono) ? $usuarios->telefono : ''; ?>"
             autocomplete="off">
    </div>
  </div>

  <div class="text-center mt-3">
    <small class="text-muted">
      <span class="text-danger">*</span> Campos obligatorios
    </small>
  </div>
</form>

<script>
  // Ensure browsers don't auto-fill modal-injected forms
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('#userForm input').forEach(el => {
      el.setAttribute('autocomplete', 'off');
    });
  });

  // Convert password field to type="password" when typing begins
  function handlePasswordInput(input) {
    if (input.type !== 'password') input.type = 'password';
  }

  // Toggle password visibility
  function togglePassword() {
    const passwordInput = document.getElementById('user_pass');
    const toggleIcon = document.querySelector('.toggle-password');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      toggleIcon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
    } else {
      passwordInput.type = 'password';
      toggleIcon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
    }
  }
</script>
