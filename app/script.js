document.addEventListener("DOMContentLoaded", ()=>{
	console.log("Hi");
	let input = document.querySelector("#input");
	let button = document.querySelector("#submitButton");
	let display = document.querySelector("#textArea");
	
	
	function processRequest(data){
		console.log(data);
		let normalDate = data.normal;
		let unixDate = data.unix;
		
		display.innerHTML = `Normal date: ${normalDate} <br> Unix date: ${unixDate}`
	}
	
	function sendRequest(){
		url = `./app/timestamp.php?data=${input.value}`;
		console.log(url);
		fetch(url)
		.then((resp)=> resp.json())
		.then((data)=>{
			processRequest(data);
		})
		.catch((err)=>{
			console.log(err);
		})
	}
	
	button.addEventListener("click", sendRequest);
})