<?php 

include("inc/db.php");

if(isset($_POST['mydata'])){
	$myvalue=$_POST["mydata"];
	$query="SELECT * From product where ProductCode='$myvalue'";
	$run_query=mysqli_query($con,$query);
    while($row=mysqli_fetch_array($run_query)){
		       $myproductID=$row["ID"];
		       $myproductname=$row["ProductName"];
		        $myproductcode=$row["ProductCode"];
		       $myproductprice=$row["ProductPrice"];
		       $myproductqty=$row["ProductQty"];
		       $myproductImage=$row["ProductImage"];
		  

		  ?>
		   <table class="table table-bordered table-striped">
		     <thead>
							<tr>
								<th>ID</th>
								<th>Product Name</th>
								<th>Product Code</th>
								<th>Product Price</th>
								<th>Qty</th>
								<th style="width: 20%;">Actions</th>
							</tr>
                </thead>
                            <tr>
                                 <td><?php echo$myproductID?></td>
                                 <td><?php echo$myproductname?></td>
								 <td><?php echo$myproductcode?></td>
								 <td><?php echo$myproductprice?></td>
								 <td><?php echo$myproductqty?></td>
                                 
                                 <td><button type="button" data-toggle="tooltip" title="Click To Show Image" data-id3="<?php echo$myproductImage ?>" id="GetID" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></td>
                               
                               
                            </tr>   
                           
                       
		  
		  
		  
		  <?php
		  
	 }
	  
	 
	
}else{
	
	
}
   
    



?>
 </table>
 <script>
 $("#GetID").click(function(){
		
		var myimage=$("#GetID").attr("data-id3");
		$("#uploadimg").attr("src",myimage);
		$("#uploadimg").css({"display":"block"});
		
	
		
	});
	
</script>
	