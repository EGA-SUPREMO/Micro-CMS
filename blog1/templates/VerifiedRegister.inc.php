<label>Nombre de usuario</label>
<input type="text" class="form-control" name="name" <?php $verifier->showName();?> autofocus required>
<?php $verifier-> showNameError();?>
<label>Email</label>
<input type="email" class="form-control" name="email" <?php $verifier->showEmail();?> required>
<?php $verifier-> showEmailError();?>
<label>Contasena</label>
<input type="password" class="form-control" name="password" required>
<?php $verifier-> showPasswordError();?>
<label>Repite tu contasena</label>
<input type="password" class="form-control" name="password2" required>
<?php $verifier-> showPassword2Error();?>
<br>
<button type="submit" class="btn btn-default btn-primary" name="submit">Registrarse</button>