function showcreate() {
	document.getElementById('data_event').style.display='block';
}
function create_event(){
	var form= new FormData();
	form.append("title",document.getElementById('title').value);
	form.append('type',document.getElementById('type').value);
	form.append('fee',document.getElementById('fee').value);
	form.append('date',document.getElementById('date').value);
	form.append('description',document.getElementById('description').value);
	form.append('mode','create_event');
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState == 4 && xhttp.status == 200 ){
			console.log(xhttp.responseText);
		}
	};
	xhttp.open("POST","event_manager.php",true);
	xhttp.send(form);
}
function show_regi(){
	var form= new FormData();
	form.append("event",document.getElementById('event').value);
	form.append("mode","show_participants");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState == 4 && xhttp.status == 200 ){
			document.getElementById("op").innerHTML = xhttp.responseText;
			console.log(xhttp.responseText);
		}
	};
	xhttp.open("POST","event_manager.php",true);
	xhttp.send(form);
}
function search(str){
	if(str==""){
		document.getElementById("op").innerHTML="";
	}
	else{
		var form= new FormData();
		form.append("key",str);
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(xhttp.readyState == 4 && xhttp.status == 200 ){
				document.getElementById("op").innerHTML = xhttp.responseText;
				console.log(xhttp.responseText);
			}
		};
		xhttp.open("POST","search_respond.php",true);
		xhttp.send(form);
	}
}
function showform(str){
	var x = document.getElementsByClassName('input_container');
	var i = 0;
	for(; i < x.length; i++){
		x[i].style.display='none';
	}
	document.getElementById('op').innerHTML='';
	document.getElementById(str).style.display='block';
}