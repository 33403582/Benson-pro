<?php 
  error_reporting(E_ERROR);	
  session_start(); 
  include('../connect.php'); 
  ob_start();
  
    $username = $_SESSION['username'];
    $result = mysql_query("SELECT * FROM supervisor WHERE username='$username'");
	$r = mysql_num_rows($result); 
    if ($r == 0) {
	 header("Location: ../");
	}
?>

<?php
	
$con = "";
$taxiid =$_SESSION['taxiid'];
if(isset($_POST['register']))
{
 
   $taxiowner = $_POST['taxiowner'];
   $numberplate = $_POST['numberplate'];
   $taxidriver = $_POST['taxidriver'];
  $sql = mysql_query("UPDATE taxi SET taxiowner='$taxiowner', numberplate='$numberplate', taxidriver='$taxidriver' WHERE taxiid='$taxiid'");
  	
	if($sql)
	{
		$emailSent = true;
	}
	else
	{
		$hasError = true;
    }
}else{
  $con = "";
}

?> 		

<!DOCTYPE html>
<html lang="en-US" class="no-js">
	<head>

		<!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
		<title>Supervisor - OTAB System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<!-- ==============================================
		CSS
		=============================================== --> 
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/font-awesome.css">
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/bootstrapValidator.min.css">
		<link rel="stylesheet" href="../css/admin.css">
		
     </head>

<body>
     
	  <!-- ==============================================
	 Navbar Section
	 =============================================== --> 
     <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".novelist-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">OTABS</a>
				
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse novelist-nav">
			   <ul class="nav navbar-nav navbar-left">
                    
                    <li>
                        <a class="user"><?php
			   include('../connect.php');
			   $username =$_SESSION['username'];
			   $result = mysql_query("SELECT * FROM supervisor WHERE username='$username'");
			   while($row = mysql_fetch_array($result))
						{
						echo $row['username'];
						} ?></a>
                    </li>
				</ul>	
                <ul class="nav navbar-nav navbar-right">
                    
                    <li>
                        <a href="../supervisor/">Dashboard</a>
                    </li>
					<li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp;Account<b>
			  </b> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php"><i class="fa fa-user"></i> Profile</a></li>
                <li class="divider"></li>
                <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </div>
	
	 <!-- ==============================================
	 Admin Section
	 =============================================== -->
	 <section class="admin" id="admin">
     <div class="container">
	 
	 <?php if(isset($hasError)) { //If errors are found ?>
              <p class="alert alert-danger">Please check if you've filled all the fields with valid information and try again. Thank you.</p>
            <?php } ?>

            <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
              <div class="alert alert-success">
                <p><strong>Details Successfully Saved!</strong></p>
                <p>Thank you for using our Add form, <strong><?php echo $username;?></strong>! The details have been successfully saved.</p>
              </div>
            <?php } ?>
	 
		  <div class="row">
			 <div id="sidebar" class="col-md-3">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h5 class="panel-title">Account Links</h5>
					</div>
					<div id="sidenav" class="panel-body">
					   <ul class="list-unstyled nav sidenav">
						 <li><a href="taxilist.php">Taxi List</a></li>
						 <li><a href="addtaxi.php">Add Taxi</a></li>
						 <hr>
						 <li><a href="taxidriverlist.php">Taxi Driver</a></li>
						 <li><a href="addtaxidriver.php">Add Taxi Driver</a></li>
						 <hr>
						 <li><a href="../supervisor/">Booked Taxis&nbsp;&nbsp;&nbsp;
						 <span class="label label-info">
						 <?php
						   include('../connect.php');
						   $result = mysql_query("SELECT * FROM book");
						   $num_rows = mysql_num_rows($result);
						   echo $num_rows; ?>
						   </span>
			             </a></li>
					  </ul>
					 
					</div>
				</div>
				
			</div>
							
			<div class="col-md-9">
			  
	         <div id="welcome" class="panel panel-success">
			   <div class="panel-heading">
				  <h3 class="panel-title">Add Taxi</h3>
			   </div>
			   <div class="panel-body">
			    <div id='preview'>
                </div> 
		  
		  <form id="imageform" method="post" enctype="multipart/form-data" action='taxiupload.php' style="clear:both">
			<h1>Upload Taxi Picture</h1> 
			<div id='imageloadstatus' style='display:none'><img src="loader.gif" alt="Uploading...."/></div>
			<div id='imageloadbutton'>
			<input type="file" name="photos[]" id="photoimg" multiple="true" />
			</div>
		  </form>
		  <br><br/>
		  <br><br/>
		  <form role="form" method="post" id="addstudentform">
		    <div class="form-group">
			 <label>Taxi Owner</label>
			 <textarea name="taxiowner" type="text" class="form-control" rows="5" placeholder="Enter Taxi Owner Name..."></textarea>
		    </div>
			<div class="form-group">
			 <label>Taxi Number Plate</label>
			 <textarea name="numberplate" type="text" class="form-control" rows="5" placeholder="Enter Taxi Number Plate..."></textarea>
		    </div>
				<div class="form-group">
			 <label>Taxi Driver</label>
			 <textarea name="taxidriver" type="text" class="form-control" rows="5" placeholder="Enter Taxi Friver..."></textarea>
		    </div>  
			  <div>
			  <br/><br/>
			  <button type="submit" name="register" class="btn btn-large btn-success full-width">SUBMIT</button><br/><br/>
			  </div>
			</form>   
			     	
			   </div>
			   </div>
			
			   
			  </div>
			  
			 </div>
			</div>
		  	</section>   

	
	<!-- ==============================================
	 Scripts
	 =============================================== -->
	 
	<script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	<script src="../js/bootstrapValidator.min.js"></script>
	 <script src="../js/jquery.wallform.js"></script>
	<script type="text/javascript">
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
   </script>
   <script>
	 $(document).ready(function() {
    $('#addstudentform').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
		taxiowner: {
                message: 'The Taxi Owner is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Taxi Owner is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The Taxi Owner must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z ,.?/\-_=]+$/,
                        message: 'The Taxi Owner can only consist of alphabetical'
                    }
                }
            },
		 numberplate: {
                message: 'The Number Plate is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Number Plate is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The Number Plate must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 ,.?/\-_=]+$/,
                        message: 'The Number Plate can only consist of alphabetical'
                    }
                }
            },
        }
    });
});
	</script>
	<script>
	 $(document).ready(function() { 
			
				$('#photoimg').die('click').live('change', function()			{ 
						   //$("#preview").html('');
					
					$("#imageform").ajaxForm({target: '#preview', 
						 beforeSubmit:function(){ 
						
						console.log('ttest');
						$("#imageloadstatus").show();
						 $("#imageloadbutton").hide();
						 }, 
						success:function(){ 
						console.log('test');
						 $("#imageloadstatus").hide();
						 $("#imageloadbutton").show();
						}, 
						error:function(){ 
						console.log('xtest');
						 $("#imageloadstatus").hide();
						$("#imageloadbutton").show();
						} }).submit();
						
			
				});
			}); 
	</script> 
</body>
</html>
