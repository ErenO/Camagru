function	reply_click(clicked_id, nb_like, photo_id)
{
	if (nb_like == 0)
	{
		postForm(clicked_id, photo_id);
	}
}

function postForm(id, photo_id)
{
	var	params = [];
	params["like_id"] = id;
	params["photo_id"] = photo_id;
	method = "post";
	var form = document.createElement("form");
	form.setAttribute("method", method);
	form.setAttribute("action", "./like.php");
	for (var key in params)
	{
		if (params.hasOwnProperty(key)) {
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

function	deleteImg(post_id, membre_id, photo_id)
{
	if (post_id == membre_id)
	{
		postDelete(photo_id);
	}
	else
	{
		alert ("Tu ne peux pas supprimer la photo d'un autre utilisateur !");
	}
}

function postDelete(id)
{
	var	params = [];
	params["delete_id"] = id;
	params["location"] = "gallery";
	method = "post";
	var form = document.createElement("form");
	form.setAttribute("method", method);
	form.setAttribute("action", "./delete.php");
	for (var key in params)
	{
		if (params.hasOwnProperty(key)) {
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

function input_display(id)
{
	var coeur_id = "coeur" + String(id);
	var link_id = "link" + String(id);
	var btn_id = "btn" + String(id);
	var text_id = "text" + String(id);
	var div_id = "div" + String(id);
	alert(coeur_id);
	// document.getElementsByClassName("div_comment").style.display = 'block';
	// document.getElementById(div_id).style.display = 'block';
	var photo_id = "photo" + String(id);

	document.getElementById(coeur_id).style.display = 'block';
	document.getElementById(btn_id).style.display = 'block';
	document.getElementById(text_id).style.display = 'block';
	document.getElementById(link_id).style.display = 'block';
	document.getElementById("big_photo").src = document.getElementById(photo_id).value;
	document.getElementById("div_center").style.display = 'inline';
	document.getElementById("hidid").value = id;

	// document.getElementById("upload").style.display = 'none';
}

function	left_arrow()
{
	var id_prev = document.getElementById("hidid").value;
	var photo_id = "photo_previous" + String(id_prev);
	alert(photo_id);
	document.getElementById("big_photo").src = document.getElementById(photo_id).value;
}

function	right_arrow()
{
	var id = document.getElementById("hidid").value;
	// alert(id);
	var photo = "photo_previous" + String(id);
	var id_next = document.getElementById(photo).value;
	alert(id_next);
	var photo_next = "photo" + String(id_next);
	document.getElementById("big_photo").src = document.getElementById(photo_next).value;
}

function comment_display(id)
{
	// alert('hello');
	var link_id = "link" + String(id);
	var comment_id = "comment" + String(id);
	document.getElementById(link_id).style.display = 'none';
	document.getElementById(comment_id).style.display = 'block';
}

// document.getElementById("form").style.display = 'inline';
// document.getElementById("upload").style.display = 'none';
// document.getElementById("snap").style.display = 'none';
// document.getElementById("cancel").style.display = 'inline';
// document.getElementById("video").style.display = 'none';
// document.getElementById("canvas").style.display = 'inline';
