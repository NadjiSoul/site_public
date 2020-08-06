
var url = document.location.href;

if (window.location.href.indexOf('?color=') > -1 
	&& (
		window.location.href.indexOf('type=') > -1 || 
		window.location.href.indexOf('category=') > -1 || 
		window.location.href.indexOf('chapter=') > -1 ||
		window.location.href.indexOf('artwork=') > -1
		)
	) {
	var replace = url.replace('?color','&color');
	document.location.href = replace;
}
else if(window.location.href.indexOf('color') > -1){
	var sub = url.substr(-8);
	var newUrl = url.replace(sub, '');
	document.location.href = newUrl;
}