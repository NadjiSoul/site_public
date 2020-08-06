


function list_cgu(){
	var list_cgu = document.getElementById('list-cgu');
list_cgu.addEventListener('click', function(){
	if(this.selectedIndex){
		document.location.href='http://127.0.0.1/Hades/cgu.php?cgu='+ list_cgu.value;
	}
});
}

function list_ml(){

var list_ml = document.getElementById('list-ml');
list_ml.addEventListener('click', function(){
	if(this.selectedIndex){
		document.location.href='http://127.0.0.1/Hades/ml.php?ml='+ list_ml.value;
	}
});
}