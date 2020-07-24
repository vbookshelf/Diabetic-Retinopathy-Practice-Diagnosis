<?php

require '/home/soywoza/Run2Give_createconnection/practice-diagnosis-createconnection.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>Practice DR Diagnosis</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Improve your diabetic retinopathy diagnosis skills by
practicing on 3,662 fundus images.">

<!--CSS Stylesheets-->
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/woza.css">


<!--Link to fonts from google fonts-->
<link href="https://fonts.googleapis.com/css?family=Oswald:300" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

<link rel="shortcut icon" type="image/png" href="robotfavicon.png">

<style>
html,body,h2,h3,h4,p,h5,li {font-family: Roboto, sans-serif}
</style>


</head>





<body class="w3-white">
<!-- w3-content defines a container for fixed size centered content,
and is wrapped around the whole page content. -->
<div class="w3-content" style="max-width:1500px">
<!-- 1. HOME PAGE TAB -->
<div class="w3-animate-opacity w3-padding w3-margin-bottom">
	

	
<!-- Top Bar -->
<div class='normal-bar w3-padding w3-round'>
	
	<p class="w3-text-black w3-opacity w3-padding-left no-margin space-letters w3-left-align unblock">
	</p>
	
	
	<p class="w3-text-black w3-opacity no-margin unblock space-letters w3-right">
	<a class="change-size" href="http://prototypes.woza.work/"><b>Prototypes</b></a> - 
	<a class="change-size" href="about.html"><b>About</b></a>
	</p>
	
</div>



<!-- Top Bar - Mobile -->
<div class='mobile-bar w3-center'>
	
	<p class="w3-black w3-opacity w3-round no-margin unblock space-letters w3-padding w3-center">
	<a class="change-size" href="http://prototypes.woza.work/"><b>Prototypes</b></a> - 
	<a class="change-size" href="about.html"><b>About</b></a>
	</p>
	
</div>



<!-- 960 width region -->
<div class='w3-content w3-round' style="max-width:960px">

<div>
	<h5 class="space-letters w3-text-purple w3-round w3-center"><b>Practice Diabetic Retinopathy Diagnosis</b></h5>
</div>

<!-- AJAX response appears here -->
<div  id="ajaxResponse" class="w3-center">
	
	<p class="w3-text-grey w3-small">2d9d97a6e713.png</p>
	<img src="dr_all_images/2d9d97a6e713.png" class="w3-round responsive" alt="fundus image">
	
	<div>
		<h5 id="diagnosis" class="space-letters w3-text-blue w3-round" style="visibility:hidden"><b>0 - No DR</b></h5>
	</div>
</div>

<!-- Button 
<div class="w3-center w3-small w3-text-blue">
	<button onclick='toggleDiagnosis()'>Show Diagnosis</button>
</div>
-->

<div class="w3-text-grey w3-center space-letters">

	<p><span id="displayCount">1</span> of 3662</p>

</div>
	
<!-- Button -->
<div class="w3-center">
	
	<button class="w3-btn w3-purple w3-round btn-font" onclick='ajaxGetImageInfo("decrease")'>&#10094; Prev</button>
	<button class="w3-btn w3-purple w3-round btn-font" onclick='toggleDiagnosis()'>Diagnosis</button>
	<button class="w3-btn w3-purple w3-round btn-font" onclick='ajaxGetImageInfo("increase")'>Next &#10095;</button>
	
</div> 



<div class="w3-center w3-padding w3-opacity">
	<input class="w3-center" id="imageID" onfocus="clearText()" class="w3-border" type="number" placeholder="Enter image #">
	<button class="w3-btn w3-teal w3-round btn-font" onclick='ajaxGetImage(imageID.value)'> Go</button>
</div>

					
					


<div class='bottom-margin'>
	
</div>





</div><!-- End of 960 width region -->

<!-- Bottom Bar -->
<div class='w3-center w3-margin-top'>
	<p class="space-letters text-color w3-small">
		<a href="http://prototypes.woza.work/">Prototypes</a></p>
</div>



</div><!--END OF HOME PAGE TAB-->
</div> <!-- w3-content -->



<script>

var num_images = 3662;
var count = 1;

var image_id = 0;

function increaseCount() {
	count = count + 1;
	document.getElementById("displayCount").innerHTML = count;
}


function toggleDiagnosis() {
	
	//document.getElementById("diagnosis").setAttribute("class", "show");
	
	var x = document.getElementById("diagnosis");
  if (x.style.visibility === "hidden") {
    x.style.visibility = "visible";
  } else {
    x.style.visibility = "hidden";
}
	

}




function clearText() {
	document.getElementById("imageID").setAttribute("placeholder", ""); 

}



function modifyCount(action) {
	
	
	if (action=='increase') {
		
		// Test if the count is at the last image.
		if (count < num_images) {
			count = count + 1;
			
			
			document.getElementById("displayCount").innerHTML = count;
			
			
		} else {
			
			// If the count is at the last image then don't increase the count.
			count = num_images;
		}
		
	}
	
	
	if (action=='decrease') {
		
		if (count == 0) {
			count = 0;

			document.getElementById("displayCount").innerHTML = count;
			
			
		} else {
			
			count = count - 1;
			
			document.getElementById("displayCount").innerHTML = count;
		}	
	}
}





// AJAX SECTION


// We send the global variable called "count" with the ajax call.
// This "count" varibale is increased each time an ajax call is made.
function ajaxGetImageInfo(action) {
	

	
	var xhttp;
	
	if (window.XMLHttpRequest) {
	// code for modern browsers
	xhttp = new XMLHttpRequest();
	} else {
	// code for IE6, IE5
	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	
	
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			// This prints the Ajax response on the page.
			document.getElementById("ajaxResponse").innerHTML = xhttp.responseText;
			
			// Scroll the page up to the image.
			// This will click on the link at the bottom
			// of the page. This will scroll the page up.
			simulateClick("scroll-up");
			
			
			
		}
	};



	// Remember that "count" is a global variable.
	// This function increments or reduces the count value.
	modifyCount(action);
	
	
	//Just like for GET but without the question mark ?
	var parameters = "&image_id=" + count;
	
	console.log("Running Ajax");
	
	xhttp.open("POST", "get-image-info.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(parameters);
}
			
		
// END OF AJAX CODE




// AJAX SECTION

// This function runs when the user enters an image number into the input field.
// It runs when the Go button is clicked.
function ajaxGetImage(image_id) {
	
	// Check if the user has entered a number and not a string.
	//The isNaN() function determines whether a value is an illegal number (Not-a-Number).
	//This function returns true if the value equates to NaN. Otherwise it returns false.
	// isNaN(123) returns false.
	check_input = parseInt(image_id);
	
	// This if statement will return true if the user has not entered a number.
	if (isNaN(check_input)) {
		
		return;
		
	}
	
	
	
	// If the user enters a number that greater than the num images available.
	if (parseInt(image_id) > num_images) {
		
		return;
		
	}
	
	
	// If the input field is empty.
	if (image_id == "") {
		
		return;
		
	}
	
	
	

	document.getElementById("displayCount").innerHTML = image_id;
	
	// Update the count value to be the id of the image number that the user entered.
	// Change the image_id variable from type str to int.
	count = parseInt(image_id);
		
		
	var xhttp;
	
	if (window.XMLHttpRequest) {
	// code for modern browsers
	xhttp = new XMLHttpRequest();
	} else {
	// code for IE6, IE5
	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	
	
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			// This prints the Ajax response on the page.
			document.getElementById("ajaxResponse").innerHTML = xhttp.responseText;
			
			// Scroll the page up to the image.
			// This will click on the link at the bottom
			// of the page. This will scroll the page up.
			simulateClick("scroll-up");
			
		}
	};
	
	
	
	//Just like for GET but without the question mark ?
	var parameters = "&image_id=" + count;
	
	console.log("Running Ajax");
	
	xhttp.open("POST", "get-image-info.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(parameters);
}
			
		
// END OF AJAX CODE



//Simulates a click.
function simulateClick(tabID) {
	
	document.getElementById(tabID).click();
}


</script>

<!--Onload a click is simulated on this to scroll the page 
to just above the filter buttons - wnen one 0f them is clicked. See the body tag.-->
<a href="#ajaxResponse" id="scroll-up"></a>

</body>
</html>

