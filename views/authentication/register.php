<div id="reg_form">
	<form method="post" action="<?php echo URL ?>register/user_registration">
	  <div class="form-group">
	    <label for="uname">Потребителско име</label>
	    <input type="text" class="form-control" name="uname" id="uname" placeholder="Потребителско име">
	    <label for="fname">Име</label>
	    <input type="text" class="form-control" name="fname" id="fname" placeholder="Име">
	    <label for="lname">Фамилия</label>
	    <input type="text" class="form-control" name="lname" id="lname" placeholder="Фамилия">
	  </div>
	  <div class="form-group">
	    <label for="email">Емайл адрес</label>
	    <input type="email" class="form-control" name="email" id="email" placeholder="Емайл адрес">
	  </div>
	  <div class="form-group">
	    <label for="pass1">Парола</label>
	    <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Парола">
	    <label for="pass2">Потвърждение на паролата</label>
	    <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Потвърждение на паролата">
	  </div>
	  <button type="submit" class="btn btn-default" name="submit">Submit</button>
	</form>
</div>