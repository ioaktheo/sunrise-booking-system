<?php
	session_start();
	$connection = mysqli_connect("localhost", "Ioakeim", "Sunrise2017", "Sunrise"); 
	
	if($connection == false){
		die("Connection failed: ".mysqli_connect_error());
	}

	$name=htmlspecialchars($_POST["firstname"]);
	$surname=htmlspecialchars($_POST["surname"]);
	$arrival_date=date_create($_POST["ar_date"]);
	$departure_date=date_create($_POST["dep_date"]);
	$people=htmlspecialchars($_POST["people"]);


	$formated_arr_date=date_format($arrival_date, 'Y-m-d');
	$formated_dep_date=date_format($departure_date,'Y-m-d');

	$customer_query="insert into Customer(Name, Surname) values (\"$name\", \"$surname\")";

	if (mysqli_query($connection, $customer_query)) {
    	$customer_id = mysqli_insert_id($connection);

    	$reservation_query="insert into Reservation(People, ArrivalDate, DepartureDate, CustomerID) values (\"$people\", \"$formated_arr_date\", \"$formated_dep_date\", \"$customer_id\")";
    	
    	if (mysqli_query($connection, $reservation_query)){
			$reservation_id = mysqli_insert_id($connection);
			echo"<!DOCTYPE html>";
			echo "<html>";
			echo "<head>";
			echo "</head>";
			echo "<body>";
			echo "<div class=\"head\">";
			echo "<img class=\"img-responsive\" src=\"src/images/header.JPG\">";
			echo "</div>";
			echo "<h1 align=\"center\">Thank you for your reservation.</h1>";
			echo "<table class=\"table\">";
			echo "<tbody>";
			echo "<tr class=\"active\">";
			echo "<td>Reservation ID</td>";
			echo "<td>Customer ID</td>";
			echo "<td>Status</td>";
			echo "</tr>";
			echo "<tr class=\"success\">";
			echo "<td>".$reservation_id."</td>";
			echo "<td>".$customer_id."</td>";
			echo "<td>Pending</td>";
			echo "</tr>";
			echo "</tbody>";
			echo "</table";
			echo "</body>";
			echo "</html>";
		}else{
	 		echo "Error: " . $reservation_query . "<br>" . mysqli_error($connection);
		}
	} else {
    	echo "Error: " . $customer_query . "<br>" . mysqli_error($connection);
	}

	mysqli_close($connection);
?>