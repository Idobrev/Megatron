<div class="user-status">
<form method="post" action="<?php echo URL ?>login/logout">
	<p><b>Добре дошъл:</b> &nbsp;&nbsp;&nbsp;<?php print_r(Session::get('fname') . ' '. Session::get('lname')); ?></p>
	<button type="submit" class="btn btn-default" id="logout" name="logout">Излез</button>
</form>
</div>
