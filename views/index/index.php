<div>
	<p class="bg-info"><?=Session::get('fname')?></p>
	<p class="bg-info"><?=Session::get('lname')?></p>
	<p class="bg-info"><?=Session::get('email')?></p>
	<p class="bg-info">To use any function of Megatron's RestAPI, follow this url &lt;your host&gt;/Megatron/restAPI/&lt;method you want to call&gt;?token=&lt;your token&gt;</p>
	<p class="bg-info">REST TOKEN: <?=Session::get('token')?></p>
</div>