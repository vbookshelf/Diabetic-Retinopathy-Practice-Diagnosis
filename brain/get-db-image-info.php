<?php


require '/home/soywoza/Run2Give_createconnection/practice-diagnosis-createconnection.php';

function test_input(&$data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlentities($data);
		
		return $data;
	}
	
function test_output(&$data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlentities($data);
		return $data;
	}
	
	
	$image_id = test_input($_REQUEST["image_id"]);
	
	//echo $image_id;
	
	
	
	//USE A PREPARED STATEMENT HERE
	$stmt6 = $conn->prepare("SELECT * FROM FundusImageTable2 WHERE image_id = ? "); 
	
	//Bind paramter to the marker
	$stmt6->bind_param("i", $image_id);
	
	//Execute the query
	$stmt6->execute();
	
	//Get the result set
	$result = $stmt6->get_result();
	
	//convert the result set into an associative array
	$row = mysqli_fetch_assoc($result);
	
	//get the email address
	$image_fname = test_output($row["image_fname"]);
	$diagnosis = test_output($row["diagnosis"]);
	$binary_target = test_output($row["binary_target"]);
	
	
	if ($diagnosis == 0) {
		$num_diagnosis = "0 - No DR";
	}
	
	if ($diagnosis == 1) {
		$num_diagnosis = "1 - Mild DR";
	}
	
	if ($diagnosis == 2) {
		$num_diagnosis = "2 - Moderate DR";
	}
	
	if ($diagnosis == 3) {
		$num_diagnosis = "3 - Severe DR";
	}
	
	if ($diagnosis == 4) {
		$num_diagnosis = "4 - Proliferative DR";
	}

		
	
	
	
	if ($binary_target == 0) {
		$bin_diagnosis = "Normal";
			
	} else {
		$bin_diagnosis = "Diabetic Retinopathy";
		
	}
	
	echo '<p class="w3-text-grey w3-small"> '. $image_fname .' </p>';
	echo '<img class="w3-round responsive" src="dr_all_images/'. $image_fname .' " alt="fundus image">';
	echo '<h5 id="diagnosis" class="w3-text-blue space-letters" style="visibility:hidden"><b>'. $num_diagnosis .'</b></h5>';
	
	
	//echo $image_fname;
	
?>