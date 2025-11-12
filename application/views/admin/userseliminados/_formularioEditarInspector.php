<!-- === User form === -->
<div class="row g-3">
  <div class="col-md-6">
    <label for="nombre" class="form-label" title="Obligatorio">
      Nombre <span class="text-danger" title="Obligatorio">*</span>
    </label>
    <input type="text"
           class="form-control"
           id="nombre"
           name="nombre"
           placeholder="Nombre"
           value="<?= isset($usuarios->nombre) ? $usuarios->nombre : ''; ?>"
           required>
  </div>

  <div class="col-md-6">
    <label for="apellido" class="form-label" title="Obligatorio">
      Apellido <span class="text-danger" title="Obligatorio">*</span>
    </label>
    <input type="text"
           class="form-control"
           id="apellido"
           name="apellido"
           placeholder="Apellido"
           value="<?= isset($usuarios->apellido) ? $usuarios->apellido : ''; ?>"
           required>
  </div>

  <div class="col-md-6">
    <label for="email" class="form-label" title="Obligatorio">
      Email <span class="text-danger" title="Obligatorio">*</span>
    </label>
    <input type="email"
           class="form-control"
           id="user_email"
           name="user_email"
           placeholder="Email"
           value="<?= isset($usuarios->email) ? $usuarios->email : ''; ?>"
           required
           autocomplete="off">
  </div>

 <!--  <div class="col-md-6">
    <label for="password" class="form-label" title="Obligatorio">
      Contraseña <span class="text-danger" title="Obligatorio">*</span>
    </label>
    <div class="input-group">
      <input type="password"
             class="form-control"
             id="user_pass"
             name="user_pass"
             placeholder="Contraseña"
             value="<?= isset($usuarios->password) ? $usuarios->password : ''; ?>"
             autocomplete="off"
             oninput="handlePasswordInput(this)">
      <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
        <i class="toggle-password bi bi-eye-fill"></i>
      </button>
    </div>
  </div> -->

  <div class="col-md-6">
    <label for="telefono" class="form-label" title="Obligatorio">
      Teléfono <span class="text-danger" title="Obligatorio">*</span>
    </label>
    <input type="tel"
           class="form-control"
           id="telefono"
           name="telefono"
           placeholder="Teléfono"
           value="<?= isset($usuarios->telefono) ? $usuarios->telefono : ''; ?>">
  </div>
</div>

<div class="text-center mt-3">
  <small class="text-muted">
    <span class="text-danger" title="Obligatorio">*</span> Campos obligatorios
  </small>
</div>

<script>
  // Convert password field to type="password" when typing begins
  function handlePasswordInput(input) {
    if (input.type !== 'password') {
      input.type = 'password';
    }
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
