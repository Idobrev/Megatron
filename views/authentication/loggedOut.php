	<div class="unautheticated">
		<p>Трябва да сте логнат за да виждате тази страница</p>
		<form class="form-inline" method="post" action="<?php echo URL ?>login/authenticate">
		  <div class="form-group">
				<label class="sr-only" for="uname">Потребителско име</label>
				<input type="text" class="form-control" name="uname" id="uname" placeholder="Потребителско име">
		  </div>
		  <div class="form-group">
				<label class="sr-only" for="pass">Парола</label>
				<input type="password" class="form-control" name="pass" id="pass" placeholder="Парола">
		  </div>
		  <!-- <div class="checkbox">
		    <label>
		      <input type="checkbox" name="checkbox"> Запомни ме
		    </label>
		  </div> -->
		  <button type="submit" class="btn btn-default">Впиши ме</button>
		</form>
		<a href="<?php echo URL ?>register">Регистрация</a>
	</div>