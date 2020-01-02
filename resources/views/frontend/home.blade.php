<!-- Tham khảo của https://www.facebook.com/nhquyet -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/github_profile.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style_v2.css') }} ">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background: url('{{ $avatar->image }}') no-repeat center center fixed;">
	<div id="application"></div>
	<div id="drag-container">
		<div id="spin-container">
			<img id="div_1">
			<img id="div_2">
			<img id="div_3">
			<img id="div_4">
			<img id="div_5">
			<img id="div_6">
			<img id="div_7">
			<img id="div_8">


			<!-- Text at center of ground -->
			<p style="font-size: 30px; "><i class="fa fa-heart-o" style="font-size:60px;color:red"></i>{{$text->text}}</p>
		</div>
		<div id="ground"></div>
	</div>
	<div style="position: absolute;right: 0;display: flex;top: 0;margin: 0px;height: 100%;">
		<iframe width="100%" style="margin: auto; max-height: 700px; box-shadow: 6px 6px 8px #999;" height="80%"; scrolling="no" frameborder="no" src="{{$link->link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		{{-- <iframe width="100%" style="margin: auto; max-height: 700px; box-shadow: 6px 6px 8px #999;" height="80%"; scrolling="no" frameborder="no" src="https://www.youtube.com/embed/NvAsZObkAm0?start=241" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
		<!-- <iframe width="100%" style="margin: auto; max-height: 700px; box-shadow: 6px 6px 8px #999;" height="80%"; scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/952298569&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe> -->
		<!-- <iframe width="333" style="margin: auto; max-height: 700px; box-shadow: 6px 6px 8px #999;" height="80%"; scrolling="yes" frameborder="no" src="https://www.nhaccuatui.com/lh/auto/lTlOvn4cSoYq&amp;hide_related=true&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false&amp;visual=true&amp;autoplay=1&loop=1&title=0&byline=0&portrait=0&muted=1" allow="autoplay" autoplay="true" muted></iframe> -->
	</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.1/es6-shim.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/react/15.0.2/react.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/react/15.0.2/react-dom.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fetch/1.0.0/fetch.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery-2.1.4.min.js') }} "></script>
	<script type="text/javascript">		
		var GITHUB_USER = '{{$git_user->git_user}}';
		var link_get_file_name = '{{ route('get_file_name') }}';
		var limit              = 8;
		$(document).ready(function() {
			getImage();
			timedCount();
		});
		function getImage() {
			$.ajax({
				url: link_get_file_name,
				type: 'GET',
				dataType: 'json',
				data: {
					limit: limit
				}
			})
			.done(function(response) {
				var count = 1;
		// console.log(response);
		$(response).each(function(index,value) {
			// $("#div_"+count).attr('src',`${path}/${value}.jpg`);
			$("#div_"+count).css('background-image',`url('${value}')`);
			count++;
		});
	});
		}

		var count = 0;

		function timedCount()
		{
			if(count >= 5) {
				count = 0;
				getImage();
			} else {
				count = count + 1;
			}
			setTimeout(timedCount, 1000);
		}
// Author: Hoang Tran (https://www.facebook.com/profile.php?id=100004848287494)
// Github verson (1 file .html): https://github.com/HoangTran0410/3DCarousel/blob/master/index.html


// You can change global variables here:
var radius = 300; // how big of the radius
var autoRotate = true; // auto rotate or not
var rotateSpeed = -60; // unit: seconds/360 degrees
var imgWidth = 200; // width of images (unit: px)
var imgHeight = 320; // height of images (unit: px)



// ===================== start =======================
// animation start after 1000 milis
setTimeout(init, 1000);

var odrag = document.getElementById('drag-container');
var ospin = document.getElementById('spin-container');
var aImg = ospin.getElementsByTagName('img');
var aEle = [...aImg];

// Size of images
ospin.style.width = imgWidth + "px";
ospin.style.height = imgHeight + "px";

// Size of ground - depend on radius
var ground = document.getElementById('ground');
ground.style.width = radius * 3 + "px";
ground.style.height = radius * 3 + "px";

function init(delayTime) {
	for (var i = 0; i < aEle.length; i++) {
		aEle[i].style.transform = "rotateY(" + (i * (360 / aEle.length)) + "deg) translateZ(" + radius + "px)";
		aEle[i].style.transition = "transform 1s";
		aEle[i].style.transitionDelay = delayTime || (aEle.length - i) / 4 + "s";
	}
}

function applyTranform(obj) {
  // Constrain the angle of camera (between 0 and 180)
  if(tY > 180) tY = 180;
  if(tY < 0) tY = 0;

  // Apply the angle
  obj.style.transform = "rotateX(" + (-tY) + "deg) rotateY(" + (tX) + "deg)";
}

function playSpin(yes) {
	ospin.style.animationPlayState = (yes?'running':'paused');
}

var sX, sY, nX, nY, desX = 0,
desY = 0,
tX = 0,
tY = 10;

// auto spin
if (autoRotate) {
	var animationName = (rotateSpeed > 0 ? 'spin' : 'spinRevert');
	ospin.style.animation = `${animationName} ${Math.abs(rotateSpeed)}s infinite linear`;
}


// setup events
document.onpointerdown = function (e) {
	clearInterval(odrag.timer);
	e = e || window.event;
	var sX = e.clientX,
	sY = e.clientY;

	this.onpointermove = function (e) {
		e = e || window.event;
		var nX = e.clientX,
		nY = e.clientY;
		desX = nX - sX;
		desY = nY - sY;
		tX += desX * 0.1;
		tY += desY * 0.1;
		applyTranform(odrag);
		sX = nX;
		sY = nY;
	};

	this.onpointerup = function (e) {
		odrag.timer = setInterval(function () {
			desX *= 0.95;
			desY *= 0.95;
			tX += desX * 0.1;
			tY += desY * 0.1;
			applyTranform(odrag);
			playSpin(false);
			if (Math.abs(desX) < 0.5 && Math.abs(desY) < 0.5) {
				clearInterval(odrag.timer);
				playSpin(true);
			}
		}, 17);
		this.onpointermove = this.onpointerup = null;
	};

	return false;
};

document.onmousewheel = function(e) {
	e = e || window.event;
	var d = e.wheelDelta / 20 || -e.detail;
	radius += d;
	init(1);
};

</script>
<script type="text/javascript" src="{{ asset('frontend/js/github_profile.js') }} "></script>
</body>
</html>