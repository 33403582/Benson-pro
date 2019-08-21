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
						 <li><a href="taxiownerlist.php">Taxi Owner</a></li>
						 <li><a href="addtaxiowner.php">Add Taxi Owner</a></li>
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
				  <h3 class="panel-title">Taxi Booked</h3>
			   </div>
			   <div class="panel-body">
			    <div class="table-responsive">
			     <table class="table table-bordered table-hover table-striped tablesorter">
								  <thead>
									<tr>
									  <th>Name</th>
									  <th>Phone</th>
									  <th>Email</th>
									  <th>NID</th>
									  <th>MPESA Code</th>
									  <th>Payment</th>
									  <th>Date added</th>
									  <th>Time added</th>
									</tr>
								  </thead>
								  <tbody>
									<?php
			include('../connect.php');
			$result = mysql_query("SELECT * FROM book");
					while($row = mysql_fetch_array($result))
						{
							echo '<tr>';
							echo '<td>'.$row['name'].'</td>';
							echo '<td>'.$row['phone'].'</td>';
							echo '<td>'.$row['email'].'</td>';
							echo '<td>'.$row['nid'].'</td>';
							echo '<td>'.$row['mpesacode'].'</td>';
							echo '<td>'.$row['payment'].'</td>';
							echo '<td>'.strftime("%b %d, %Y", strtotime($row["date_added"])).'</td>';
							echo '<td>'.strftime("%H : %M : %S &nbsp; %p", strtotime($row["date_added"])).'</td>';
							echo '</tr>';
						}
			?>
									
								  </tbody>
								</table>
				 </div>			
			     	
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
	<script src="../js/bootstrap.js"></script>
	<script src="../js/waypoints.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<script src="../js/respond.min.js"></script>
	<script src="../js/html5shiv.js"></script>
	<script src="../js/retina.js"></script>
	<script src="../js/bootstrapValidator.min.js"></script>
	<script src="../js/pi.js"></script>
	<script type="text/javascript">
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
   </script>
  
</body>
</html>
