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
include('../connect.php');
$username = $_SESSION['username'];
$result = mysql_query("SELECT * FROM supervisor WHERE username='$username'");

while($row = mysql_fetch_array($result))
  {
    $id=$row['id'];
	$uname=$row['username'];
	$password=$row['password'];
	$fname=$row['fname'];
	$mname=$row['mname'];
	$lname=$row['lname'];
	$birth=$row['birth'];
	$gender=$row['gender'];
	$status=$row['status'];
  }
?>	

<?php 
extract($_POST);
$uid = time();
$con = "";
if(isset($_POST['edit']))
{

$id = $_POST['id'];
$tname = $_POST['uname'];
$password = $_POST['password'];
$regno = $_POST['regno'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$birth = $_POST['birth'];
$gender = $_POST['gender'];
$status = $_POST['status'];

$sql1 = mysql_query("UPDATE supervisor SET username='$tname', password='$password', fname='$fname', mname='$mname', lname='$lname', birth='$birth', gender='$gender', status='$status' WHERE id='$id'");

	$r = mysql_num_rows($sql1); // count the output amount
    if ($r > 0)
	{
		$hasError = true;
	}
	else
	{
		$emailSent = true;
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
		<title>Supervisor - OTAB System</title>
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
		<link rel="stylesheet" href="../css/bootstrap.min.css">   
		<link rel="stylesheet" href="../css/font-awesome.css">
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/bootstrapValidator.min.css">
		<link rel="stylesheet" href="../css/admin.css">
		
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
                <a class="navbar-brand"> OTABS</a>
				
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
	 Student Section
	 =============================================== -->
	 <section class="admin" id="admin">
     <div class="container">
	  
	  <?php if(isset($hasError)) { //If errors are found ?>
              <p class="alert alert-danger">Please check if you've filled all the fields with valid information and try again. Thank you.</p>
            <?php } ?>

            <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
              <div class="alert alert-success">
                <p><strong>Details Successfully Saved!</strong></p>
                <p>Thank you for using our Profile form, <strong><?php echo $username;?></strong>! The details have been successfully saved.</p>
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
				  <h3 class="panel-title">Update Your Details</h3>
			   </div>
			   <div class="panel-body">
			    <form role="form" method="post" id="editform">
				<input name="id" type="hidden" value="<?php echo $id?>">
				  <div class="form-group">
				    <label>First Name</label>
					<input name="fname" type="text" value="<?php echo $fname?>" class="form-control">
				  </div>
				  <div class="form-group">
				    <label>Middle Name</label>
					<input name="mname" type="text" value="<?php echo $mname?>" class="form-control">
				  </div> 
				  <div class="form-group">
				    <label>Last Name</label>
					<input name="lname" type="text" value="<?php echo $lname?>" class="form-control">
				  </div> 
				  <div class="form-group">
				    <label>User Name</label>
					<input name="uname" type="text" value="<?php echo $uname?>" class="form-control">
				  </div>
				  <div class="form-group">
				    <label>Password</label>
					<input name="password" type="text" value="<?php echo $password?>" class="form-control">
				  </div> 
				  <div class="form-group">
				    <label>Birth</label>
					<input name="birth" type="text" value="<?php echo $birth?>" class="form-control">
				  </div>
				  <div class="form-group">
				    <label>Gender</label>
					<input name="gender" type="text" value="<?php echo $gender?>" class="form-control">
				  </div>
				  <div class="form-group">
				    <label>Status</label>
					<input name="status" type="text" value="<?php echo $status?>" class="form-control">
				  </div>
				  
				  <div>
				  <br/><br/>
				  <button type="submit" name="edit" class="btn btn-large btn-success full-width">UPDATE PROFILE</button><br/><br/>
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
	<script src="../js/pi.js"></script>
	<script type="text/javascript">
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
   </script>
   <script>
	 $(document).ready(function() {
    $('#editform').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
		fname: {
                message: 'The First name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The First name is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The First name must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'The First name can only consist of alphabetical'
                    }
                }
            },
		 mname: {
                message: 'The Middle name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Middle name is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The Middle name must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'The Middle name can only consist of alphabetical'
                    }
                }
            },
			lname: {
                message: 'The Last name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Last name is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The Last name must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'The Last name can only consist of alphabetical'
                    }
                }
            },
            uname: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The username must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9]+$/,
                        message: 'The username can only consist of alphabetical and number'
                    },
                    different: {
                        field: 'password',
                        message: 'The username and password cannot be the same as each other'
                    }
                }
            },
           password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    },
                    stringLength: {
                        min: 8,
                        message: 'The password must have at least 8 characters'
                    }
                }
            },
			birth: {
                message: 'The Birth is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Birth is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The Birth must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9/-]+$/,
                        message: 'The Birth can only consist of alphabetical'
                    }
                }
            },
			gender: {
                message: 'The Gender is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Gender is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The Gender must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'The Gender can only consist of alphabetical'
                    }
                }
            },
			status: {
                message: 'The Status is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Status is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'The Status must be more than 2 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'The Status can only consist of alphabetical'
                    }
                }
            },
        }
    });
});
	</script>
</body>
</html>
