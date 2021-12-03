<?php 
include("inc/db.php");
if(isset($_POST["product_name"],$_POST["product_code"],$_POST["product_price"],$_POST["product_qty"],$_POST["product_descrip"])){
				$myimage=$_POST["product_image"];
				$Product_Image = "images/".$myimage;
				$Product_Name=$_POST["product_name"];
				$Product_Code=$_POST["product_code"];
				$Product_Price=$_POST["product_price"];
				$Product_Qty=$_POST["product_qty"];
				$Product_Descrip=$_POST["product_descrip"];
				

$query="INSERT INTO `product` (`ID`, `ProductName`, `ProductCode`, `ProductPrice`, `ProductQty`, `ProductImage`, `ProductDescription`, `ProductupTime`) VALUES ('', '$Product_Name', '$Product_Code', '$Product_Price', '$Product_Qty', '$Product_Image', '$Product_Descrip', current_timestamp());
";
$run_query=mysqli_query($con,$query);
if($run_query==true){
	echo"Data Inserted";
}else{
	echo"Data Not Inserted";
}
}
?>
