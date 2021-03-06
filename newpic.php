<?php
	require_once 'db/connect.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>New Pic</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/pic.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/w3.css" />

	<script src="js/pic.js"></script>
</head>
<body>
	<div class="navbar">
	<?php
        if ($_SESSION["logged"] == 0){
          header("location: index.php");
        }
       ?>
	</div>
	<img class="logo" src="images/site_images/logo.png" alt="logo">	
	<div class="main_container">
		<div class="top_container">
			<div id="overlay" class="overlay">
				<img class="text" height='300px' width='300px' id="emoji1" name="emoji1" onclick="off()">
				<img onclick="off2()" class="text" height='300px' width='300px' id="emoji2" name="emoji2"  >
			</div>
			<div class="video">
				<img class="uploaded_image" height='375px' width='500px' id="uploaded_image" name="uploaded_image">
				<video class="video" id='video'>Stream not available...</video>
			</div>
			<div class="emo_list">
			<img id="e1" src="images/emojis/emoji1.png" height='50px' width='50px' style="margin: 19px">
			<img id="e2" src="images/emojis/emoji2.png" height='50px' width='50px' style="margin: 19px">
			<img id="e3" src="images/emojis/emoji3.png" height='50px' width='50px' style="margin: 19px">
			<img id="e4" src="images/emojis/emoji4.png" height='50px' width='50px' style="margin: 19px">
			<img id="e5" src="images/emojis/emoji5.png" height='50px' width='50px' style="margin: 19px">
			<img id="e6" src="images/emojis/emoji6.png" height='50px' width='50px' style="margin: 19px">
			<img id="e7" src="images/emojis/emoji7.png" height='50px' width='50px' style="margin: 19px">
			<img id="e8" src="images/emojis/emoji8.png" height='50px' width='50px' style="margin: 19px">
			<img id="e9" src="images/emojis/emoji9.png" height='50px' width='50px' style="margin: 19px">
			<img id="e10" src="images/emojis/emoji10.png" height='50px' width='50px' style="margin: 19px">
			<br>
			</div>
			<button id="photo_button" class="button">Take Photo</button>
			<button id="Uploadbtn" class="button">Upload</button>
			<input type="file" id="fileupload" style="display: none" accept="image/*">
			<canvas id="canvas2"></canvas>
			<button id="save_photo" class="button">save</button>
			<canvas id="canvas"></canvas>
		</div>
		

		<div class="thumb_nail">
			<?php
				/*$db->get("gallery",array('user_id', '=', $user->data()->user_id));
				$images = $db->results();
				$num_images = $db->count() - 1;
				for ($i=0; $i < 3 && $num_images >= 0; $i++) { 
					$img = $images[$num_images]->img_name;
					echo "<img src='$img' style='margin: 5px; margin-bottom: 1px; margin-top: 1px'>";
					$num_images--;
				*/} 
			 ?>
		</div>
	</div>
    <div class="footer">
		<p class='right' style="color: white">&copyktwomey</p>	
		<ul class="footer">
			<li><a href="index.php">Home</a></li>
			<?php
			?>
		</ul>
	</div>
</body>

<script>
	
	function off() {
		document.getElementById("emoji1").style.visibility = "hidden";
		document.getElementById("emoji1").removeAttribute('src');
	}
	function off2() {
		document.getElementById("emoji2").style.visibility = "hidden";
		document.getElementById("emoji2").removeAttribute('src');
	}
	emo1 = document.getElementById("e1");
	emo2 = document.getElementById("e2");
	emo3 = document.getElementById("e3");
	emo4 = document.getElementById("e4");
	emo5 = document.getElementById("e5");
	emo6 = document.getElementById("e6");
	emo7 = document.getElementById("e7");
	emo8 = document.getElementById("e8");
	emo9 = document.getElementById("e9");
	emo10 = document.getElementById("e10");
	
	emo1.addEventListener("click", function(){switchsrc(emo1);}, false);
	emo2.addEventListener("click", function(){switchsrc(emo2);}, false);
	emo3.addEventListener("click", function(){switchsrc(emo3);}, false);
	emo4.addEventListener("click", function(){switchsrc(emo4);}, false);
	emo5.addEventListener("click", function(){switchsrc(emo5);}, false);
	emo6.addEventListener("click", function(){switchsrc(emo6);}, false);
	emo7.addEventListener("click", function(){switchsrc(emo7);}, false);
	emo8.addEventListener("click", function(){switchsrc(emo8);}, false);
	emo9.addEventListener("click", function(){switchsrc(emo9);}, false);
	emo10.addEventListener("click", function(){switchsrc(emo10);}, false);
	function switchsrc(emonew)
	{
		document.getElementById("emoji1").style.visibility = "visible";
		if (document.getElementById("emoji1").hasAttribute("src"))
		{
			document.getElementById("emoji2").style.visibility = "visible";
			var emoswitch = document.getElementById("emoji2");
		}
		else
		{
			var emoswitch = document.getElementById("emoji1");
		}
		var ovl = document.getElementById("overlay");
		switch (emonew.id)
		{
			case "e1" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "0px";
				emoswitch.style.left = "200px";
				break;
			case "e2" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "0px";
				emoswitch.style.left = "0px";
				break;
			case "e3" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "0px";
				emoswitch.style.left = "200px";
				break;
			case "e4" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "0px";
				emoswitch.style.left = "0px";
				break;
			case "e5" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "0px";
				emoswitch.style.left = "200px";
				break;
			case "e6" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "0px";
				emoswitch.style.left = "0px";
				break;
			case "e7" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "0px";
				emoswitch.style.left = "200px";
				break;
			case "e8" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "0px";
				emoswitch.style.left = "0px";
				break;
			case "e9" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "0px";
				emoswitch.style.left = "200px";
				break;
			case "e10" :
				emoswitch.setAttribute('src', emonew.src);
				emoswitch.style.top = "0px";
				emoswitch.style.left = "0px";
				break;
		}
	} 
</script>
</html>