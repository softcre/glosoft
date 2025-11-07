<!-- <div class="form-group">
	<label for="dni_personal" class="mb-0" title="Obligatorio">DNI <span class="text-danger" title="Obligatorio">*</span></label>
	<input type="text" class="form-control" id="dni_personal" name="dni_personal" placeholder="Introduce DNI" value="<?= (isset($medico->dni_personal)) ? $medico->dni_personal : ''; ?>">
</div> -->

<div class="form-group">
<div class="row">
    <div class="col-6">
	    <label for="nombre" class="mb-0" title="Obligatorio">Nombre <span class="text-danger" title="Obligatorio">*</span></label>
    	<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce Nombre" value="<?= (isset($usuarios->nombre)) ? $usuarios->nombre : ''; ?>">
    </div>
    <div class="col-6">
      <div class="form-group">
	     <label for="apellido" class="mb-0" title="Obligatorio">Apellido<span class="text-danger" title="Obligatorio">*</span></label>
	     <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Introduce Apellido" value="<?= (isset($usuarios->apellido)) ? $usuarios->apellido : ''; ?>">
       </div>
    </div>
 </div>



<div class="form-group">
  <div class="row">
    <div class="col-6">
      <label for="email" class="mb-0">Email<span class="text-danger" title="Obligatorio">*</span></label>
      <input type="email" class="form-control" id="email" name="email"  placeholder="Introduce email" value="<?= (isset($usuarios->email)) ? $usuarios->email : ''; ?>" required autocomplete="off">
    </div>
    <div class="col-6">
      <label for="password" class="mb-0">Contraseña<span class="text-danger" title="Obligatorio">*</span></label>
      <div class="input-group">
        <input type="text" class="form-control" id="password" name="password" placeholder="Introduce contraseña" value="<?= (isset($usuarios->password)) ? $usuarios->password : ''; ?>" autocomplete="off" oninput="handlePasswordInput(this)">
        <div class="input-group-append" onclick="togglePassword()">
            <span class="input-group-text">
                <i class="toggle-password fas fa-eye" ></i>
            </span>
        </div>
      </div>
    </div>
   </div>
</div>
<div class="form-group">
  <div class="row">
    <div class="col-6">
    <label for="telefono" class="mb-0" title="Obligatorio">Teléfono <span class="text-danger" title="Obligatorio">*</span></label>
	  <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Introduce número de telefono" value="<?= (isset($usuarios->telefono)) ? $usuarios->telefono : ''; ?>">
    </div>
</div>



<!-- ///////////////////// -->



<div class="text-center">
	<small class="text-muted"><span class="text-danger" title="Obligatorio">*</span> Campos obligatorios</small>
</div>

<script>
  // Function to set "matricula_usuario" and "password_medico" inputs to empty on page load
 /*  document.addEventListener('DOMContentLoaded', function () {
    var matriculaInput = document.getElementById('matricula_usuario');
    var passwordInput = document.getElementById('password_medico');

    if (matriculaInput) {
      matriculaInput.value = '';
    }

    if (passwordInput) {
      passwordInput.value = '';
    }
  }); */

  /////////
  var passwordInput = document.getElementById('password_medico');
  var isTyping = false;

  // Function to handle password input
  function handlePasswordInput(input) {
    if (!isTyping) {
      isTyping = true;
      input.type = 'password';
      // If you want to clear the placeholder value when the user starts typing
      // input.placeholder = '';
    }
  }
/////////

  // Function to toggle password visibility
  /* function togglePassword() {
    var passwordInput = document.getElementById('password_medico');
    var toggleIcon = document.querySelector('.toggle-password');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      toggleIcon.classList.remove('fa-eye');
      toggleIcon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      toggleIcon.classList.remove('fa-eye-slash');
      toggleIcon.classList.add('fa-eye');
    }
  } */

  //esta ocupo
  function togglePassword() {
        var passwordInput = document.getElementById('password');
        var toggleIcon = document.querySelector('.toggle-password');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
