<?php
	include "connection.php";
	include "navbar4.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Approve Admin Request</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style type="text/css">
 
        body {
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}

.sidenav {
  height: 100%;
  margin-top: 74px;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #222;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.img-circle
{
    margin-left: 14px;
}
.h:hover
{
    color: white;
    width: 250px;
    height: 50px;
    background-color: deepskyblue;
}
    </style>
</head>
<body>
    <!--______________________Side Navigation__________________-->

    <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div style="color: deepskyblue; font-size: 20px; margin-left: 80px; font-size: 20px;">
                <?php
                if(isset($_SESSION['login_user']))
                {
                    echo "<img class='img-circle profile_img' height=120 width=120 src='Images/".$_SESSION['pic']."'>";
                    echo "</br></br>";

                    echo "Welcome ".$_SESSION['login_user'];
                    echo "</br>";
                }
                ?>
        </div><br><br>

 <div class="h"> <a href="add.php">Add Books</a> </div><br>
 <div class="h"> <a href="request.php">Book Request</a> </div><br>
  <div class="h"> <a href="issue_info.php">Issue Information</a> </div><br>
  <div class="h"><a href="expired.php">Expired List</a></div><br>
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>

    <!--_______________________ Search Bar ______________________-->
<div class="container">
	 <h3 style="float: left;">Search one username at a time to approve the request.</h3>
    <div style="float: right;" class="search">
        <form class="navbar-form" method="post" name="form1">

                <input class="form-control" type="text" name="search" placeholder="Student username..." required="">
                <button style="background-color: #3abfdd;" type="submit" name="submit6" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            
        </form>
    </div>


	<br><br><br><br><h2 style="padding-left: 8px;">New Request</h2>
	<?php

        if(isset($_POST['submit6']))
        {
            $q=mysqli_query($db,"SELECT firstname, lastname, username, email, contact FROM admin WHERE username like '%$_POST[search]%' and status='' ");
            if(mysqli_num_rows($q)==0)
            {
                echo "Sorry! No New request found. Try searching again.";
            }
            else
            {
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color: #3abfdd;'>";
                // Table header
                echo "<th>"; echo "First Name"; echo "</th>";
                echo "<th>"; echo "Last Name"; echo "</th>";
                echo "<th>"; echo "Username"; echo "</th>";
                echo "<th>"; echo "Email"; echo "</th>";
                echo "<th>"; echo "Phone No"; echo "</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($q)) {

                	$_SESSION['test_name']=$row['username'];
                    echo "<tr>";
                    echo "<td>"; echo $row['firstname']; echo "</td>";
                    echo "<td>"; echo $row['lastname']; echo "</td>";
                    echo "<td>"; echo $row['username']; echo "</td>";
                    echo "<td>"; echo $row['email']; echo "</td>";
                echo "<td>"; echo $row['contact']; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";

                ?>
                <form method="post">
                <button type="submit" name="submit4" style="background-color: #353232; color: white; font-weight: 600;" class="btn btn-default"><span style="color: red;" class="glyphicon glyphicon-remove-sign"></span>&nbspReject</button>

                <button type="submit" name="submit7" style="background-color: #353232; color: white; font-weight: 600;" class="btn btn-default"><span style="color: green;" class="glyphicon glyphicon-ok-sign"></span>&nbspApprove</button>
				</form>
                <?php


            }
        }
            /* If Button is not pressed */
        else
        {
            $res=mysqli_query($db,"SELECT firstname, lastname, username, email, contact FROM admin where status='' ;");
            if ($res)
            {
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color: #3abfdd;'>";
                // Table header
                echo "<th>"; echo "First Name"; echo "</th>";
                echo "<th>"; echo "Last Name"; echo "</th>";
                echo "<th>"; echo "Username"; echo "</th>";
                echo "<th>"; echo "Email"; echo "</th>";
                echo "<th>"; echo "Phone No"; echo "</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>"; echo $row['firstname']; echo "</td>";
                    echo "<td>"; echo $row['lastname']; echo "</td>";
                    echo "<td>"; echo $row['username']; echo "</td>";
                    echo "<td>"; echo $row['email']; echo "</td>";
                echo "<td>"; echo $row['contact']; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";

                
                if(isset($_POST['submit4']))
                {
                	mysqli_query($db,"DELETE from admin where username='$_SESSION[test_name]' and status='' ;");
                	unset($_SESSION['test_name']);
                }
                if(isset($_POST['submit7']))
                {
                	mysqli_query($db,"UPDATE admin SET status='yes' where username='$_SESSION[test_name]';");
                	unset($_SESSION['test_name']);
                }
            }
        } 
	?>
    </div>
</body>
</html>