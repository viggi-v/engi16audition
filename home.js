function showinput(){
	document.getElementById('input_panel').style.display="block";
	document.getElementById('op').style.display="none";
}
function update(){
	var mobile= document.getElementById("mobile").value;
	var address=document.getElementById("address").value;
	var college_name=document.getElementById("college_name").value;
	var form = new FormData();
	form.append("mobile",mobile);
	form.append("address",address);
	form.append("college_name",college_name);
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState==4 && xhr.status==200){
			if(xhr.responseText== "ok"){
				document.getElementById('input_panel').style.display="none";
				console.log("db updated");
			}
			else document.getElementById('update_err').innerHTML = xhr.responseText;
		}
	}; 
	xhr.open("POST","update.php",true);
	xhr.send(form);
}
function register(name){
	var form = new FormData;
	form.append('event_id',name);
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState == 4 && xhttp.status == 200 ){
			console.log(xhttp.responseText);
		}
	};
	xhttp.open("POST","event_register.php",true);
	xhttp.send(form);
	var elem = document.getElementById(name);
	elem.innerHTML="registerd";
	elem.disabled=true;
	var att = document.createAttribute("class");      
	att.value = "disabled";                           
	elem.setAttributeNode(att);                          
}
function show_reg(){
	document.getElementById('input_panel').style.display='none';
	document.getElementById('op').style.display="block";
}