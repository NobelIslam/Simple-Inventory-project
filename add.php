<?php 
require("inc/db.php");
error_reporting(0);


/* Getting file name */

$filename = $_FILES['my']['name'];
echo $_GET["productName"];

/* Location */
$location = "images/".$filename;



$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

/* Valid extensions */
$valid_extensions = array("jpg","jpeg","png");

/* Check file extension */
if(!in_array(strtolower($imageFileType), $valid_extensions)) {
   $uploadOk = 0;
}

if($uploadOk == 0){
   echo 0;
}else{
   /* Upload file */
   if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
     echo $location;
   
  
     
     
	 
   }else{
     echo 0;
   }

}	


?>





