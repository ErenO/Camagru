<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta content="stuff, to, help, search, engines, not" name="keywords">
	<meta content="What this page is about." name="description">
	<meta content="Display Webcam Stream" name="title">
	<title>camagru</title>

	</head>

	<body>
		<video id="video" width="640" height="480" autoplay></video>
		<button id="snap">Snap Photo</button>
		<canvas id="canvas" width="640" height="480"></canvas>
		<script src="bollachcam.js">
			// var video = document.getElementById('video');
			//
			// if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
			// 	navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
			// 		video.src = window.URL.createObjectURL(stream);
			// 		video.play();
			// 	});
			// }
			// else if(navigator.getUserMedia) {
			// 	navigator.getUserMedia({ video: true }, function(stream) {
			// 		video.src = stream;
			// 		video.play();
			// 	}, errBack);
			// } else if(navigator.webkitGetUserMedia) {
			// 	navigator.webkitGetUserMedia({ video: true }, function(stream){
			// 		video.src = window.webkitURL.createObjectURL(stream);
			// 		video.play();
			// 	}, errBack);
			// } else if(navigator.mozGetUserMedia) {
			// 	navigator.mozGetUserMedia({ video: true }, function(stream){
			// 		video.src = window.URL.createObjectURL(stream);
			// 		video.play();
			// 	}, errBack);
			// }
			// var context = canvas.getContext('2d');
			//
			// document.getElementById("snapButton").addEventListener("click", function() {
			// 	context.drawImage(video, 0, 0, 640, 480);
			// });
		</script>
	</body>
</html>
