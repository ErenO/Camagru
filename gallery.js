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

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// document.getElementById("form").style.display = 'inline';
// document.getElementById("upload").style.display = 'none';
// document.getElementById("snap").style.display = 'none';
// document.getElementById("cancel").style.display = 'inline';
// document.getElementById("video").style.display = 'none';
// document.getElementById("canvas").style.display = 'inline';
