// function	reply_click(clicked_id)
// {
// 	alert(clicked_id);
// }
window.addEventListener("DOMContentLoaded", function() {

	// <button id="1" onClick="reply_click(this.id)">B1</button>
	// <button id="2" onClick="reply_click(this.id)">B2</button>
	// <button id="3" onClick="reply_click(this.id)">B3</button>

	document.getElementById("div_comment").addEventListener("click", function()
	{
	// 	var id = document.getElementById("photo_id").value;
		// document.getElementById(id).style.display = 'none';
	// 	// alert(document.getElementById("photo_id").value);
	//
	});
	document.getElementById("photo_like").addEventListener("click", function()
	{
		// alert('ekfe');
		document.getElementById("bg").innerHTML = "hello";
	});
}, false);
