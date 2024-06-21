<!DOCTYPE html>
<html>
<head>
	<title>Contact Form Submissions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<style>
        body{
            background-color:floralwhite;
        }

.container {
    width: 80%;
    margin: 0 auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    position: static;
    margin-top: 150px;

}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
    color:black;
    font-weight: bolder;
    font-size: 20px;
}

th {
    text-align: left;
    background-color:darksalmon
}

.header{
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    text-align: center;
}
h1 {
    font-size: 2em;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
        
}

td.message {
  width: 50%;
  height: 15px;
}


	</style>
</head>
<body>
	<h1>Contact Form Submissions</h1>
    <H1>Queries made by tenants either complaints or compliments
    <div class="header">
    
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Message</th>
				<th>Tenant Queries Date</th>
			</tr>
		</thead>
		<tbody>
            
			<?php
			// Connect to the database
              $conn = mysqli_connect('localhost', 'root', '', 'user_db');
			// check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			// retrieve data from database
			$sql = "SELECT * FROM contact_form";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['first_name'] . "</td>";
					echo "<td>" . $row['last_name'] . "</td>";
					echo "<td>" . $row['email'] . "</td>";
					echo "<td class='message'>" . $row['message'] . "</td>";
                    echo '<td>' . $row['QUERY_date'] . '</td>';
					
                    echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='6'>No records found.</td></tr>";
			}

			// close database connection
			mysqli_close($conn);
			?>
		</tbody>
	</table>
    <a href="javascript:history.back()" class="back-button"><i class="fa fa-arrow-left"></i> Back</a>
</body>
</html>
