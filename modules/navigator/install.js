var navLinks = document.createElement('link');
navLinks.href='/FreeSpot/Megatron/public/css/nav.css';
navLinks.rel='stylesheet';
navLinks.type="text/css";

var html = '<nav id="navigation">' +
		'<div id="cssmenu">' +
			"<ul >" + 
				'<li><a href="<?php echo URL ?>index">Home</a></li>' + 
				'<!-- <li><a href="<?php echo URL ?>freeSpots">Customers</a></li> -->' + 
				'<!-- <li><a href="<?php echo URL ?>googleMap">Maps</a></li> -->' + 
				'<li><a href="<?php echo URL ?>disciplines">Home</a></li>' + 
				'<li><a href="<?php echo URL ?>students">Customers</a></li>' +
				'<li><a href="<?php echo URL ?>marks">Maps</a></li>' + 
				'<li><a href="<?php echo URL ?>users">Users</a></li>' +
			'</ul>' + 
		'</div>' + 
	'</nav>';

document.head.appendChild(navLinks);
var modules = document.querySelectorAll('[megatron-module="navigator"]');
for (var i in modules) {
  modules[i].innerHTML = html;
}
console.log('navigator');


