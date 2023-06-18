<?php
	session_start();
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");
	$book_name = "";
	$book_author = "";
	$query = "select 
	request_book.book_name,request_book.book_author,request_book.Status ,request_book.date
	from request_book where student_id = $_SESSION[id]";
	?>
<!DOCTYPE html>
<html>
<head>
	<title>User Dashboard</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		#side_bar{
  			background-color: whitesmoke;
  			padding: 50px;
  			width: 300px;
  			height: 450px;
  		}
  	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="user_dashboard.php">Library Management System(LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></span></font>
			<ul class="nav navbar-nav navbar-right">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="view_profile.php">View Profile</a>
						<a class="dropdown-item" href="edit_profile.php"> Edit Profile</a>
						<a class="dropdown-item" href="change_password.php">Change Password</a>
					</div>
				</li>
				<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
			</ul>
		</div>
	</nav>


<span><marquee>This is library Management System. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<form>
			<input type = "text" id="searchtext" placeholder="Enter the name of the book" size="112" onkeyup="searchtxt()">
			<table border="2px" border-collapse="collapse" width="900px" style="text-align: center" id="tbl"><br><br>
				<tr>
					<th>Book Name:</th>
					<th>Book Author:</th>
					<th>Status:</th>
					<th>Date:</th>
				</tr>
				<?php
					$query_run = mysqli_query($connection,$query);
					while($row = mysqli_fetch_assoc($query_run)){
						$book_name = $row['book_name'];
						$book_author = $row['book_author'];
						$Status = $row['Status'];
						$Date = $row['date'];
						
				?>
						<tr>
							<td class="tbld"><?php echo $book_name;?></td>
							<td class="tbld"><?php echo $book_author;?></td>
							<td class="tbld"><?php echo $Status;?></td>
							<td class="tbld"><?php echo $Date;?></td>
							
						</tr>
						<?php
					}
				?>
			</table>
		</form>
	</div>
	<div class="col-md-2"></div>
</div>
	
<script>
		const searchtxt = () => {
			console.log("RAJPUT");
			let filter = document.getElementById('searchtext').value.toUpperCase();

			let myTabel = document.getElementById('tbl');
            let tr = myTabel.getElementsByTagName('tr');

            for (var i = 0; i<tr.length; i++) {
                 let td = tr[i].getElementsByTagName('td')[0];	
               
               if(td){
               	let textvalue = td.textcontent || td.innerHTML;
               	if(textvalue.toUpperCase().indexOf(filter) > -1){
                   tr[i].style.display = "";
               	}
               	else{
               		tr[i].style.display = "none";
               	}
              }
           }
}


            </script>

</body>
</html>