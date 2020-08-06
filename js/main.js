//REFRESH//
if(window.location.href.indexOf("&delete") > -1){
	window.location.href = location.href.split('&')[0];
}
if(window.location.href.indexOf("?delete") > -1){
	window.location.href = location.href.split('?')[0];
}
//////////

var delete_element = document.getElementsByClassName('delete_element');
var delet_element = document.getElementsByClassName('delet_element');
var delete_modal = document.getElementsByClassName('delete');
var lien;

for(i=0; i < delete_element.length; i++){

	delete_element[i].addEventListener("click", function(){
		delete_modal[0].href = location.href+'&delete='+event.target.value;
		delete_modal[0].value = event.target.value;

	})
}

for(i=0; i < delet_element.length; i++){

	delet_element[i].addEventListener("click", function(){
		delete_modal[0].href = location.href+'?delete='+event.target.value;
		delete_modal[0].value = event.target.value;

	})
}

function delet(){
	window.location.href = delete_modal[0].href;
}

