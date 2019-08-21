<?php 
  error_reporting(E_ERROR);	
  session_start(); 
  include('connect.php'); 
  ob_start();    
  if(!isset($_SESSION['username'])){	//  header("Location: login.php");
  }	
?>

<?php
include('connect.php');
$taxiid = $_GET['taxiid'];
$result = mysql_query("SELECT * FROM taxi WHERE taxiid='$taxiid' AND available='available'");

if($row = mysql_fetch_array($result))
  {
    $taxiid = $row['taxiid'];
	$numberplate = $row['numberplate'];
	$taxiowner = $row['taxiowner'];
	$taxidriver=$row['taxidriver'];
	$available=$row['available'];
  }
  else{
	$_SESSION["hasBooked"] = 'hasBooked';
	header("Location: ../OTAB/");
  }
?>	

<?php
	
$con = "";
if(isset($_POST['register']))
{

$taxiid = $_POST['taxiid'];
$taxiowner = $_POST['taxiowner'];
$numberplate = $_POST['numberplate'];
$taxidriver = $_POST['taxidriver'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$nid = $_POST['nid'];
$mpesacode = $_POST['mpesacode'];
$payment = $_POST['payment'];
$available = 'Booked';
     
		
	$sql1 = mysql_query("INSERT INTO book (taxiid,taxiowner,numberplate,taxidriver,name,phone,email,nid,mpesacode,payment,date_added) 
VALUES('$taxiid','$taxiowner','$numberplate','$taxidriver','$name','$phone','$email','$nid','$mpesacode','$payment',now())");

$sql1 = mysql_query("UPDATE taxi SET available='$available' WHERE numberplate='$numberplate'");
	  
	if($sql1)
	{
		$emailSent = true;
	}
	else
	{
		$hasError = true;
  }
	}
else
{
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
		<title>OTABS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<!-- ==============================================
		Favicons
		=============================================== --> 
		<link rel="shortcut icon" href="img/favicons/favicon.ico">
		<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">
		
		<!-- ==============================================
		CSS
		=============================================== -->   
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/font-awesome.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/admin.css">
		<link rel="stylesheet" href="css/taxi.css">
		
		<!-- ==============================================
		Fonts
		=============================================== -->
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
		
		
		<!-- ==============================================
		Feauture Detection
		=============================================== -->
		<script src="../js/modernizr-2.6.2.min.js"></script>
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
     </head>

<body>
     <!-- ==============================================
	 Feauture Detection
	 =============================================== -->
     <section class="navbar navbar-default navbar-fixed-top">
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
			<div class="collapse navbar-collapse novelist-nav">
                <ul class="nav navbar-nav navbar-right">
				    <li>
                        <a href="../OTAB/" class="scroll-link" data-id="home">Home</a>
                    </li>
                    <li>
                        <a href="login.php" class="scroll-link" data-id="about">Login</a>
                    </li>
                </ul>
            </div>
            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </section>
	
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
                <p>Thank you for using our OTABS. The details have been successfully recorded. You will recive a call shortly to confirm your application</p>
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
					     <hr><h4><STRONG>M-PESA PAY BILL</STRONG></h4><hr>
						 <h3><strong>0&nbsp;1&nbsp;2&nbsp;3&nbsp;4&nbsp;5&nbsp;6&nbsp;7&nbsp;8</strong></h3><hr>
						 <h4>LINDA HOLDINGS LTD</h4>
						 <hr>
					  </ul>
					 
					</div>
				</div>
				
			</div>
							
			<div class="col-md-9">
			  
	         <div id="welcome" class="panel panel-success">
			   <div class="panel-heading">
				  <h3 class="panel-title">Book Now</h3>
			   </div>
			   <div class="panel-body">
			    <form role="form" method="post" id="addstudentform">
				<input name="taxiid" type="hidden" value="<?php echo $taxiid?>">
				<input name="taxiowner" type="hidden" value="<?php echo $taxiowner?>">
				<input name="numberplate" type="hidden" value="<?php echo $numberplate?>">
				<input name="taxidriver" type="hidden" value="<?php echo $taxidriver?>">
				  <div class="form-group">
				    <label>Name</label>
					<input name="name" type="text" class="form-control" placeholder="Enter Name...">
				  </div>
				  <div class="form-group">
				    <label>Phone Number</label>
					<input name="phone" type="text" class="form-control" placeholder="Enter Phone Number...">
				  </div> 
				  <div class="form-group">
				    <label>Email</label>
					<input name="email" type="text" class="form-control" placeholder="Enter Email...">
				  </div> 
				  <div class="form-group">
				    <label>National ID</label>
					<input name="nid" type="text" class="form-control" placeholder="Enter National ID...">
				  </div>
				  <div class="form-group">
				    <label>MPESA Code</label>
					<input name="mpesacode" type="text" class="form-control" placeholder="Enter MPESA Code...">
				  </div>
				  <div class="form-group">
				    <label>Payment</label>
					<input name="payment" type="text" class="form-control" placeholder="Enter Payment...">
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

	<!--==============================================
	footer
	=================================================-->
	<section>
		<div class="row">
			<div class="footer"></div>
		</div>
	</section>
	<!-- ==============================================
	 Scripts
	 =============================================== -->
	 
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/waypoints.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/html5shiv.js"></script>
	<script src="js/retina.js"></script>
	<script src="js/bootstrapValidator.min.js"></script>
	<script src="js/pi.js"></script>
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
		name: {
                message: 'The Name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Name is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The Name must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z .,]+$/,
                        message: 'The Name can only consist of alphabetical'
                    }
                }
            },
		 phone: {
                validators: {
                    digits: {
                        message: 'The Phone Number can contain digits only'
                    },
					stringLength: {
                        min: 10,
						max: 10,
                        message: 'The Phone Number must have at least 10 characters'
                    },
                    notEmpty: {
                        message: 'The Phone Number is required'
                    },
					 regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The Phone Number can only consist of Numbers'
                    }
                }
            },
			email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
			 nid: {
                validators: {
                    digits: {
                        message: 'The National ID can contain digits only'
                    },
					stringLength: {
                        min: 8,
						max: 8,
                        message: 'The National ID must have at least 10 characters'
                    },
                    notEmpty: {
                        message: 'The National ID is required'
                    },
					 regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The National ID can only consist of Numbers'
                    }
                }
            },
			mpesacode: {
                message: 'The Mpesa Code is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Mpesa Code is required and cannot be empty'
                    },
                    stringLength: {
                        min: 9,
                        max: 9,
                        message: 'The Mpesa Code must be 9 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 ]+$/,
                        message: 'The Mpesa Code can only consist of alphabetical'
                    }
                }
            },
			payment: {
                validators: {
                    digits: {
                        message: 'The Payment can contain digits only'
                    },
					stringLength: {
                        min: 2,
                        message: 'The Payment must have at least 2 characters'
                    },
                    notEmpty: {
                        message: 'The Payment is required'
                    },
					 regexp: {
                        regexp: /^[a-zA-Z0-9]+$/,
                        message: 'The Payment can only consist of Numbers'
                    }
                }
            },
        }
    });
});
	</script>
</body>
</html>
