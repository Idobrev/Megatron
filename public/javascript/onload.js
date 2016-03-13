function parseUrl() {
	var active = {
		index:0,
		freeSpots:1,
		googleMap:2,
	};
	
	var url = document.URL;
	url = url.split("/");
	return active[url[url.length - 1]];
}

function makeActiveNav() {
	//$('#cssmenu').find($( "li" )).first().removeAttr('class');
	var activeChild = parseUrl();
	$('#cssmenu').find($( "li" )).each(function(index,obj){
		if (index == activeChild) {
			$(obj).attr('class', 'active');	
		}
	})
}

$(document).ready(function(){
	$('#navigation').append($('.user-status'));
	//hacking like a boss. The problem is that the documents loads slow because of the map. ( when in that controller ) I need the navigation to be displayed properly 
	$('.user-status').show();
	makeActiveNav();
});