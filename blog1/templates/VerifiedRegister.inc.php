<input type="text" placeholder="Choose a username" class="form-control" name="name" <?php $verifier->showName();?> autofocus required>
<?php $verifier-> showNameError();?>
<br>
<input type="email" placeholder="Your email address" class="form-control" name="email" <?php $verifier->showEmail();?> required>
<?php $verifier-> showEmailError();?>
<br>
<input type="password" placeholder="Choose a password" class="form-control" name="password" required>
<?php $verifier-> showPasswordError();?>
<br>
<input type="password" placeholder="Confirm password" class="form-control" name="password2" required>
<?php $verifier-> showPassword2Error();?>
<br>
<br>
<button type="submit" class="btn btn-default btn-primary" name="submit">Register</button>