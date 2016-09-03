var		img;
var		tmp;
var		numerofiltre = 1;
var		vid = 0;
var		filternames = [];
var		ok = 0;

filternames["1"] = "TOD champignon";
filternames["2"] = "Ballon basket";
// filternames["3"] = "Fckin fly";
// filternames["4"] = "Hat & Glasses";
// filternames["5"] = "ET";
// filternames["6"] = "Surgery";
// filternames["7"] = "Leprechaun";
// filternames["8"] = "Unicorn";
// filternames["9"] = "Chimpokomon";
window.addEventListener("DOMContentLoaded", function() {
		// alert('hello');
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
	document.getElementById("video").src.onchange = function() {
	ok = 1;
};
	document.getElementById("snap").addEventListener("click", function()
	{
		if(document.getElementById("video").src)
		{
			context.drawImage(video, 0, 0, 640, 480);
		}
	});
	// document.getElementById("cancel").addEventListener("click", function()
	// {
	// 	document.getElementById('upload').value = [];
	// 	numerofiltre = 1;
	// 	img = 0;
	// 	document.getElementById("upload").value = "";
	// });
	//
	// document.getElementById("video").addEventListener("click", function() {
	// 	numerofiltre++;
	// 	if (numerofiltre >= 10)
	// 		numerofiltre = 1;
	// 	document.getElementById("filtre").src = "filtres/" + numerofiltre + ".png";
	// 	document.getElementById("png").value = "filtres/" + numerofiltre + ".png";
	// 	document.getElementById("nomfiltre").innerHTML = filternames[numerofiltre];
	// });
	//
	document.getElementById("chevron_gauche").addEventListener("click", function() {
		numerofiltre--;
		if (numerofiltre < 2)
			numerofiltre = 2;
		// alert(numerofiltre);
		document.getElementById("filtre").src = "filtres/" + numerofiltre + ".png";
		document.getElementById("png").value = "filtres/" + numerofiltre + ".png";
		document.getElementById("nomfiltre").innerHTML = filternames[numerofiltre];
	});
	document.getElementById("chevron_droit").addEventListener("click", function() {
		numerofiltre++;
		if (numerofiltre >= 7)
			numerofiltre = 2;
		// alert(numerofiltre);
		document.getElementById("filtre").src = "filtres/" + numerofiltre + ".png";
		document.getElementById("png").value = "filtres/" + numerofiltre + ".png";
		document.getElementById("nomfiltre").innerHTML = filternames[numerofiltre];
	});
	// document.getElementById("canvas").addEventListener("click", function() {
	// 	numerofiltre++;
	// 	if (numerofiltre >= 10)
	// 		numerofiltre = 1;
	// 	document.getElementById("filtre").src = "filtres/" + numerofiltre + ".png";
	// 	document.getElementById("png").value = "../filtres/" + numerofiltre + ".png";
	// 	document.getElementById("nomfiltre").innerHTML = filternames[numerofiltre];
	// });
	document.getElementById("upload").onchange = function() {
		// alert("BON")
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
//
// function masquer(id)
// {
// 	document.getElementById(id).style.display = 'none';
// }
//
// function afficher(id)
// {
// 	document.getElementById(id).style.display = 'inline';
// }

function postthat()
{
	var	params = [];
	img = canvas.toDataURL("image/png");
	// params["titre"] = document.getElementById('title').value;
	params["image"] = img;
	// params["lieu"] = document.getElementById('place').value;
	params["png"] = document.getElementById('png').value;

	method = "post";
	var form = document.createElement("form");
	form.setAttribute("method", method);
	form.setAttribute("action", "./post.php");

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
//
// $cle = md5(microtime(TRUE)*100000);
//
//
// $message = "Hello. To authenticate your email click <a href='http://localhost:8080/Camagru/User/creation/validated.php?user_id=".$_POST['email']."&cle=".$cle."'>this link.</a>";