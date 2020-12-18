<?php
$con = mysqli_connect("sql12.freemysqlhosting.net", "sql12382802", "Pcfz54XCtn", "sql12382802", "3306");
//check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySql" . mysqli_connect_errno();
} else {
	// success
	echo "Success broo!!";
}
