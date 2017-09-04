<?php


//File upload script

function fileUpload($identifier){
	$allowedExts = array("webm", "mp4", "ogg");
	$temp = explode(".", $_FILES['file']["name"]);
	$extension = end($temp);
	
	if(in_array($extension, $allowedExts))
	{
		if($_FILES["file"]["error"]!=0)
		{
			$return[0]=1;
			$return[1]="Error: " . $_FILES['file']["error"] . "<br>";
			$return[2]=NULL;
		}else{
			//Debug
			echo "Upload: " . $_FILES['file']["name"] . "<br>";
			echo "Type: " . $_FILES['file']["type"] . "<br>";
			echo "Size: " . $_FILES['file']["size"] . "<br>";
			echo "Stored in: " . $_FILES['file']["tmp_name"] . "<br>";
			
			//Get random generated hash for filename:
			$fileLoc = "./vid/" . $identifier . "." . $extension;
			
			if (file_exists($fileLoc))
	      		{
			      $return[0] = 1;
			      $return[1] =  "Random hash messed up!  This shouldn't happen! File already exists!";
			      $return[2] = NULL;
		      	}else{
			      move_uploaded_file($_FILES['file']["tmp_name"], $fileLoc);
			      $return[0]=0;
			      $return[1] = "OK";
			      $return[2] = $fileLoc; 
			      //Toggle this when done debugging
			      echo "Stored in: " . $fileLoc;
	     		}
		}	
	}else{
		$return[0]=-1;
		$return[1]= "Invalid file type! Files should be WebM, MP4, or OGG!";
		$return[3]=NULL;
	}
	return $return;
	/*
		
		TODO: return an array with information needed
		
		return[0] will contain basic flag for error catching, IE 0 if all good, 1 for general file error, -1 for incorrect file type
		return[1] will contain more verbose error messages, or OK if file uploaded successfully.
		return[2] will contain the file location if the upload succeeded.
		
	*/
	
	
}

?>