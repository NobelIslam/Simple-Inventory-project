<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Basic PHP and MySQL application using PHP Data Object and Bootstarp 4">
    <meta name="author" content="Sok Kimsoeurn">
    <link rel="icon" href="images/favicon.ico">

    <title>CRUD Operations in PHP and MySQL using PDO</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/6f636db11c.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
	           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<style>
		 
.search-input input{
  height: 55px;
  width: 100%;
  outline: none;
  border: none;
  border-radius: 5px;
  font-family:-webkit-pictograph;
  padding: 0 60px 0 20px;
  font-size: 18px;
  box-shadow: 0px 1px 5px rgba(0,0,0,0.1);
}
.table{
	font-family:-webkit-pictograph !important;
}
.search-input.active input{
  border-radius: 5px 5px 0 0;
}

.search-input .autocom-box{
  padding: 0;
  opacity: 0;
  pointer-events: none;
  max-height: 280px;
  overflow-y: auto;
}

.search-input.active .autocom-box{
  padding: 10px 8px;
  opacity: 1;
  pointer-events: auto;
}

.autocom-box li{
  list-style: none;
  padding: 8px 12px;
  display: none;
  width: 100%;
  cursor: default;
  border-radius: 3px;
}

.search-input.active .autocom-box li{
  display: block;
}
.autocom-box li:hover{
  background: #efefef;
}

.search-input .icon{
     position: absolute;
    right: 23px;
    top: 0px;
    height: 55px;
    width: 55px;
    text-align: center;
    line-height: 55px;
    font-size: 20px;
    color: #644bff;
    cursor: pointer;
}
ul.list-unstyled.myul {
    background: #233a54;
	cursor:pointer;
}
	li.myclass {
	color:white;
	font-family: -webkit-pictograph;
	padding: 12px;
	border-bottom: 1px solid white;
}	
#imagelist{
	
	max-width: 27px;
    width: 27px;
    height: 29px;
    float: right;
    overflow: hidden;
    margin-top: -10px;
	box-shadow:0px 10px 13px -7px #000000, 5px 5px 15px 5px rgb(0 0 0 / 0%);
}
		
		</style>
  </head>

  <body>
    <!-- Start Navabar-->
    <nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">AF House</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
  
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Hero Image -->
    <div class="hero-image">
        <div class="hero-text">
            <h1>Welcome to AF House Inventory </h1>
            <p>Upload and view the product details</p>
            <button class="btn btn-success btn-lg">Our Website</button>
        </div>
    </div>
    <!-- End Hero Image -->
    <div class="container">
        <!-- Modal Confirm Delete -->
        <div class="modal fade" id="modal-delete">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa fa-trash"></i> Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Do you want to delete product <strong>Product name</strong> ?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-outline-success">Save changes</a>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        <!-- Create Form -->
        <div class="card" style="border:1px solid black">
            <div class="card-header text-white" style="background:black">
                <strong><i class="fa fa-plus"></i> Add New Product</strong>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
						<label for="name" class="col-form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            
                        </div>
                        <div class="form-group col-md-6">
                            <label for="barcode" class="col-form-label">Product Code</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter your Product Code" required>
                        </div>	
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="price" class="col-form-label">Product Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="qty" class="col-form-label">Qty</label>
                            <input type="number" class="form-control" name="qty" id="qty" placeholder="Qty" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image" class="col-form-label">Product Image</label>
							 <input type="file" id="file"name="file"/>
					        
                        </div>
						  <div class="form-group col-md-12">
                            
							
					         <img style="width:100%;height:100px;display:none"src="" id="img"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="col-form-label">Description</label>
                        <textarea name="description" id="Desc" rows="5" class="form-control" placeholder="Description"></textarea>
                    </div>
                    <button type="button" id="save" class="btn btn-success"><i class="fa fa-check-circle"></i> Save</button><span id="status"></span>
                </form>
				

 





            </div>
        </div>
        <!-- End create form -->
        <br>
        <!-- Table Product -->
        <div class="card" style="border:1px solid black !important">
            <div class="card-header text-white" style="background:black">
            <strong><i class="fa fa-database"></i> Products</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-title float-left">Table Products</h5>
                    <a href="#" class="btn btn-success float-right mb-3"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Speaker JBL Charge 3</td>
                        <td>$240</td>
                        <td>12</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-light"><i class="fa fa-th-list"></i></a>
                            <a href="#" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
      <!-- End Table Product -->
      <br>

      <!-- Show  a Product -->
        <div class="card" style="border:1px solid black">
            <div class="card-header text-white" style="background:black">
                <strong><i class="fa fa-database"></i><span style="padding:10px">Search Product</span></strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="search-input">
					  <?php include("getdata.php")?>
						<a href="" target="_blank" hidden></a>
						<input id="myid" data-placement="right" data-toggle="tooltip" title="Enter your product Code"autocomplete="off" type="text" placeholder="Enter your product Code">
					<div class="country">
						<!-- here list are inserted from javascript -->
		 
					</div>
        <div id="search"class="icon"><i class="fa fa-search"></i></div>
		
      </div>
                    </div>
                    <div class="col-lg-12">
                        <div id="result"></div>
						 <table class="table table-bordered table-striped">
                         
                        </table>
						  <img style="width:100%;height:543px;display:none" src="" id="uploadimg"/>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Show a product -->
        <br>
    </div><!-- /.container -->
	
	

	

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
          <span class="text-muted">&copy; by techtcl.com 2021</span>
        </div>
    </footer>
	
 <script src="js/jquery-3.2.1.min.js"></script>
 <script>
 $("#GetID").click(function(){
		
		var myimage=$("#GetID").attr("data-id3");
		$("#uploadimg").attr("src",myimage);
		$("#uploadimg").css({"display":"block"});
		
	
		
	});
	
</script>	
	<script> 
	
	 $(document).ready(function(){ 
	 
		$("#myid").keyup(function(){
			
			var query=$("#myid").val();
			
			if(query!='')
			{
				
				$.ajax({
					
					url:"search.php",
					method:"POST",
					data:{query:query},
					success:function(data){
						
						$(".country").fadeIn();
						$(".country").html(data);
					}
					
				});
				
			}
			
		});
	 
	     $(document).on('click','li',function(){
			 
			 $("#myid").val($(this).text());
			 $(".country").fadeOut();
			 
			 
		 });
		
	 
	 });
	
	
	
	</script>
	<script> 
	$("#search").click(function(){
		
		 var myvalue=$("#myid").val();
		  if(myvalue!=''){
			  var myvalue=$("#myid").val();
			  	 $.ajax({
			       url:"getdata.php",
			       type:"POST",
			       data:{
				   
				   mydata:myvalue
				   
			      },
			  success:function(data){
				
				  console.log(data);
				  $("#result").html(data);
				 
				  
			  }
			 
			 
		 });
		  }else{
			  
			  $("#myid").css({"border":"1px solid red"});
			   
		  }
		
		
	}); 
	
	
	 	
	


	</script>
	
    <!-- End Footer -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
	<script>


	$(document).ready(function(){

	  
		$("#save").click(function(){
			
			
					
				var td = new FormData();

                var files = $('#file')[0].files[0];

                td.append('file',files);

                $.ajax({
                    url:'image.php',
                    type:'POST',
                    data:td,
                    contentType: false,
                    processData: false,
                    success:function(response){
						//$("#status").html(response);
                        if(response != 0){
                            $("#img").attr("src",response);
                            $('.preview img').show();
							$("#img").css({"display":"block"})
							$("#file").val('');
                        }else{
                           alert('File not uploaded');
							 $("#status").html("<span style='color:red;padding:10px'>File upload Failed</span>");
							
                        }
                    }
                });
				
	  var productname=$("#name").val();
	  var productcode=$("#code").val();
	  var productprice=$("#price").val();
	  var productqty=$("#qty").val();
	  var productdescrip=$("#Desc").val();
	 
	  
	   if(productname!==''&& productcode!=''&& productprice!='' && productqty!==''&& productdescrip!=='' ){
		   
		   	 var file=$('#file')[0].files[0];
			 var getname=file.name;
		   
		   $.ajax({
				
				url:"check.php",
				type:"POST",
				data:{
				product_name:productname,
				product_code:productcode,
				product_price:productprice,
				product_qty:productqty,
				product_descrip:productdescrip,
				product_image:getname,

			
				},
				
				success:function(data){
					
			$("#status").html(data)
				
			         $("#name").val('');
				     $("#code").val('');
				     $("#price").val('');
					 $("#qty").val('');
					
					 $("#Desc").val('');
					 
					 
					 
					 
					
				}
				
				
				
				
			});
		   
		   
	   }else{
		   $("#status").html("<span style='color:red;padding:10px'>All The Field Required</span>");
		   
	   }
	   if(productname ==''){
		   
		   
		   $("#name").css({"border":"1px solid red"});
		   
		   
		   
	   }else{
		   $("#name").css({"border":""});
		   
	   }
	   if(productcode ==''){
		   
		   
		  $("#code").css({"border":"1px solid red"});
		   
		   
		   
	   }else{
		   $("#code").css({"border":""});
	   }
	   
	  if(productprice =='' ){
		   
		   
		  $("#price").css({"border":"1px solid red"});
		   
		   
		   
	   }else{
		    $("#price").css({"border":""});
	   }
	   if(productqty ==''){
		   
		   
		   $("#qty").css({"border":"1px solid red"});
		   
		   
		   
	   }else{
		   
		   $("#qty").css({"border":""});
	   }
	   if(productdescrip ==''){
		   
		   
		   $("#Desc").css({"border":"1px solid red"});
		   
		   
		   
	   }else{
		   $("#Desc").css({"border":""});
		  
	   }

		
				
			
		});
		
		
		
	});
	 
	
	  

	
	</script>



  </body>
</html>