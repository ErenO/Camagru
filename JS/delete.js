function	deleteImg(post_id, membre_id, photo_id)
{
	if (post_id == membre_id)
	{
		alert(post_id);
		postDelete(photo_id);
	}
	else
	{
		alert (post_id + "Tu ne peux pas supprimer la photo d'un autre utilisateur !" + photo_id);
	}
}
function postDelete(id)
{
	var	params = [];
	params["delete_id"] = id;

	method = "post";
	var form = document.createElement("form");
	form.setAttribute("method", method);
	form.setAttribute("action", "../PHP/delete.php");

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
