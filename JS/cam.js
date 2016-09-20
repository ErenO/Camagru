var		img;
var		tmp;
var		numerofiltre = 1;
var		vid = 0;
var		ok = 0;

window.addEventListener("DOMContentLoaded", function() {
	var canvas = document.getElementById("canvas"),
		context = canvas.getContext("2d"),
		video = document.getElementById("video"),
		videoObj = { "video": true },
		errBack = function(error) {
			console.log("Video capture error: ", error.code);
		};
	if (navigator.getUserMedia)
	{
		navigator.getUserMedia(videoObj, function(stream)
		{
			video.src = stream;
			video.play();
		}, errBack);
	}
	else if (navigator.webkitGetUserMedia)
	{
		navigator.webkitGetUserMedia(videoObj, function(stream)
		{
			video.src = window.URL.createObjectURL(stream);
			video.play();
		}, errBack);
	}
	else if (navigator.mozGetUserMedia)
	{
		navigator.mozGetUserMedia(videoObj, function(stream)
		{
			video.src = window.URL.createObjectURL(stream);
			video.play();
		}, errBack);
	}
	document.getElementById("video").src.onchange = function()
	{
		ok = 1;
	};
	document.getElementById("snap").addEventListener("click", function()
	{
		document.getElementById("snap_photo").value = "ok";
		if (document.getElementById("video").src)
		{
			context.drawImage(video, 0, 0, 640, 480);
		}
	});
	document.getElementById("chevron_gauche").addEventListener("click", function()
	{
		numerofiltre--;
		if (numerofiltre < 1)
			numerofiltre = 7;
		document.getElementById("filtre").src = "../filtres/" + numerofiltre + ".png";
		document.getElementById("filtre2").src = "../filtres/" + numerofiltre + ".png";
		document.getElementById("png").value = "../filtres/" + numerofiltre + ".png";
	});
	document.getElementById("chevron_droit").addEventListener("click", function() {
		numerofiltre++;
		if (numerofiltre > 7)
			numerofiltre = 1;
		document.getElementById("filtre").src = "../filtres/" + numerofiltre + ".png";
		document.getElementById("filtre2").src = "../filtres/" + numerofiltre + ".png";
		document.getElementById("png").value = "../filtres/" + numerofiltre + ".png";
	});
	document.getElementById("upload").onchange = function() {
		var fileInput = document.getElementById("upload");
		var reader  = new FileReader();
		reader.addEventListener('load', function() {
			var ext = fileInput.files[0].name.split('.');
			ext = ext[ext.length - 1];
			if (ext != 'png' && ext != 'jpg' && ext != 'jpeg') {
				document.getElementById("upload").value = "";
				alert("You must choose png, jpg or jpeg file only");
			} else {
				canvas.width = 640;
				canvas.height = 480;
				var b64 = reader.result;
				var img = new Image();
				img.onload = function() {
					context.drawImage(img, 0, 0, 640, 480);
					snapped = true;
				};
				img.src = b64;
			}
		});
		if (fileInput.files.length == 1) {
			reader.readAsDataURL(fileInput.files[0]);
		}
	};
}, false);

function postthat()
{
	var	params = [];
	img = canvas.toDataURL("../filtre");
	params["image"] = img;
	params["png"] = document.getElementById('png').value;
	params["png"] == "filtres/1.png" ? "" : params["png"];
	method = "post";
	if (document.getElementById("snap_photo").value != "ok")
	{
		params["image"] = "";
	}
	if (params["image"] && params["png"])
	{
		var form = document.createElement("form");
		form.setAttribute("method", method);
		form.setAttribute("action", "../PHP/post.php");
		for (var key in params)
		{
			if (params.hasOwnProperty(key))
			{
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
	else
	{
		document.getElementById('show_text_msg').innerHTML = "Prend ou télécharge une photo et met un filtre !";
	}
}

function	deleteImg(photo_id)
{
	postDelete(photo_id);
}

function postDelete(id)
{
	var	params = [];
	params["delete_id"] = id;
	params["location"] = "cam";
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
