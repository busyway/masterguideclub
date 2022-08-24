<?php
    	require_once "../db.php";
		$id = mysqli_real_escape_string($conn, $_POST['txtRegister']);
		$picture = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));


	    $fnm = $_FILES["image"]["name"];    // get the image name in $fnm variable
	    $dst = "./user_pics/".$id.$fnm;  // storing image path into the {image_members} folder with studentid
	    $mempic = "user_pics/".$id.$fnm; // storing image path into the database with studentid

	    move_uploaded_file($_FILES["image"]["tmp_name"],$dst);  // move image into the {image_members} folder

		/*if(mysqli_query($conn, "UPDATE student_images SET student_image = '$picture' where studentid= '".$id."'")) 
		
		{
	     //echo 'Picture uploaded successfully';
		}*/ 
		
		if(mysqli_query($conn, "UPDATE newapplicants SET picture = '$mempic' where registration_code= '".$id."'")) 
		
		{
	     echo 'Picture uploaded successfully';
		}
/*
		if(mysqli_query($conn, "UPDATE family_table SET mem_pic = '$mempic' where memid= '".$id."'")) 
		
		{
	     echo 'Picture uploaded successfully';
		}*/
	    
	    else 
	    {
	       echo "Error: " . $sql . "" . mysqli_error($conn);
	    }
 
?>