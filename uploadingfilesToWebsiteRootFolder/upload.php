<?php
// check wether the upload button is pressed
if (isset($_POST['submit'])) {
 	$file = $_FILES['file'];
 	// create array which save the info  of the file..!
 	$data = array('name' =>$file['name'],'type' =>$file['type'],'temp' =>$file['tmp_name'],'error' =>$file['error'],'size' =>$file['size']);
 	// as the file name contain 2 parts first file and sec is the extension lets break them 
 	$temp = explode('.', $data['name']);
 	$actualExt = strtolower(end($temp));
 	
 	// create an array for the extension we allow.! 
 	$allowExt =  array('jpg',"jpeg","pdf","png");

 	//lets check the file upload with in the given extension
 	if ($data["error"] === 4) {
 		header('Location: index.php?upload=empty');
 	} else {
 		if (in_array($actualExt,$allowExt)) {
 		if ($data['error'] === 0 ) {
 				//check for the fileSize less then 1mb
 				
 				if ($data['size'] < 5000000) {
 					//changing the file name with unique name
 					$newName = uniqid('' ,true);
 					$data['name'] = $newName.'.'.$actualExt;
 					
 					// lets move the destiney folder
 					$destloc = "upload/".$data['name'];

 					if (move_uploaded_file($data['temp'],$destloc)) {
 						header('Location: index.php?upload=success');
 					}else{
 						header('Location: index.php?upload=fail');
 					}
 				}else{
 					echo "You file size is not fine";
 				}
 		}else{
 			echo "there is an error in uploading";
 		}
 	}else{
 		echo "You upload the incorrect file extension";
 	}
 	}
 	
 	
 }else{
 	header("Location: index.php");
 } 



