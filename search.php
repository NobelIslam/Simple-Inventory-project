<?php
include("inc/db.php");

if(isset($_POST["query"]))
	{
		
		$output="";
		$query="SELECT * From product Where ProductCode LIKE '%".$_POST["query"]."%'";
		$result=mysqli_query($con,$query);
		$output='<ul class="list-unstyled myul">';
		
	    if(mysqli_num_rows($result) > 0)
	    { 
	        
	       while($row =mysqli_fetch_array($result))
		   {
			    $myproduct_image=$row['ProductImage'];
				
			   $output.='<li class="myclass">'.$row["ProductCode"]."<img id='imagelist'src='$myproduct_image'/>".'</li>';
			   
		   }
	  
	    }else{ 
		
		$output .='<li class="myclass">Product Not Found</li>';
		
		
		}
		$output.='</ul>';
		echo $output;
	}



?>