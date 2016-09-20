
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
	form.setAttribute("action", "../PHP/like.php");
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
	form.setAttribute("action", "../PHP/delete.php");
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
	var div_id = "div" + String(id);
	var coeur_id = "coeur" + String(id);
	var link_id = "link" + String(id);
	var btn_id = "btn" + String(id);
	var text_id = "text" + String(id);
	var div_id = "div" + String(id);
	var photo_id = "img" + String(id);
	var comment_id = "comment" + String(id);
	var hide_id = "hide" + String(id);
	var coeur_disp = document.getElementById(coeur_id).style.display;
	var elem_none = "photo_info" + id;
	var elements = document.getElementsByClassName('photo_info');
	if (coeur_disp != 'block')
	{
		document.getElementById(div_id).style.float = 'none';
		document.getElementById(coeur_id).style.display = 'block';
		document.getElementById(btn_id).style.display = 'block';
		document.getElementById(text_id).style.display = 'block';
		document.getElementById(link_id).style.display = 'block';
	}
	else
	{
		document.getElementById(hide_id).style.display = 'none';
		document.getElementById(comment_id).style.display = 'none';
		document.getElementById(div_id).style.float = 'left';
		document.getElementById(coeur_id).style.display = 'none';
		document.getElementById(btn_id).style.display = 'none';
		document.getElementById(text_id).style.display = 'none';
		document.getElementById(link_id).style.display = 'none';
	}
}

function	finish_display()
{
	document.getElementById("div_center").style.display = 'none';
}

function comment_display(id)
{
	var hide_id = "hide" + String(id);
	var link_id = "link" + String(id);
	var comment_id = "comment" + String(id);
	document.getElementById(link_id).style.display = 'none';
	document.getElementById(comment_id).style.display = 'block';
	document.getElementById(hide_id).style.display = 'block';
}

function comment_none(id)
{
	var hide_id = "hide" + String(id);
	var link_id = "link" + String(id);
	var comment_id = "comment" + String(id);
	document.getElementById(comment_id).style.display = 'none';
	document.getElementById(hide_id).style.display = 'none';
	document.getElementById(link_id).style.display = 'block';
}

function	save_comment()
{
	var input_text = "text" + String(id);
	var text = document.getElementById(input_text).value;
	var numero = document.getElementById("hidid").value;
	if (text)
	{
		postComment(numero, text);
	}
}

function	postComment(numero, text)
{
	var	params = [];
	params["numero"] = numero;
	params["comment"] = text;
	method = "post";
	var form = document.createElement("form");
	form.setAttribute("method", method);
	form.setAttribute("action", "../PHP/comment.php");
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

function	postId(id)
{
	var	params = [];

	params["id"] = id;
	method = "post";
	var form = document.createElement("form");
	form.setAttribute("method", method);
	form.setAttribute("action", "../PHP/gallery.php");
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
