function	deleteImg(post_id, membre_id)
{
	photo_id = document.getElementById('photo_id').value;
	if (post_id == membre_id)
	{
		// alert(photo_id);
		postDelete(photo_id);
	}
	else
	{
		alert (post_id + "Tu ne peux pas supprimer la photo d'un autre utilisateur !" + photo_id);
	}
}

function	reply_click(clicked_id)
{
	// alert("hello");
// 	document.getElementById(like_id).innerHTML = "<img src='coeur.png' style='display:block'/>" + toString(nb_like);
// document.getElementById(like_id).innerHTML = "hello";
	postForm(clicked_id);
}

function postDelete(id)
{
	var	params = [];
	// params["titre"] = document.getElementById('title').value;
	params["delete_id"] = id;
	// params["lieu"] = document.getElementById('place').value;

	method = "post";
	var form = document.createElement("form");
	form.setAttribute("method", method);
	form.setAttribute("action", "./delete.php");

	for (var key in params)
	{
		if(params.hasOwnProperty(key)) {
			var hiddenField = document.createElement("input");
			hiddenField.setAttribute("type", "hidden");
			hiddenField.setAttribute("name", key);
			hiddenField.setAttribute("value", params[key]);
			form.appendChild(hiddenField);
		}
	}
	document.body.appendChild(form);
	form.submit();
}

function postForm(id)
{
	var	params = [];
	// params["titre"] = document.getElementById('title').value;
	params["like_id"] = id;
	// params["lieu"] = document.getElementById('place').value;

	method = "post";
	var form = document.createElement("form");
	form.setAttribute("method", method);
	form.setAttribute("action", "./like.php");

	for (var key in params)
	{
		if(params.hasOwnProperty(key)) {
			var hiddenField = document.createElement("input");
			hiddenField.setAttribute("type", "hidden");
			hiddenField.setAttribute("name", key);
			hiddenField.setAttribute("value", params[key]);
			form.appendChild(hiddenField);
		}
	}
	document.body.appendChild(form);
	form.submit();
}

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
	document.getElementById("coeur").addEventListener("click", function()
	{
		// alert('ekfe');
		document.getElementById("pcoeur").innerHTML = "hello";
	});
}, false);
