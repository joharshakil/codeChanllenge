
<?php
 require_once('dbscheme.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title> Code Challenge</title>
	<link href='https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' rel='stylesheet' type='text/css'>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css' rel='stylesheet' type='text/css'>
	<link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>
	<script src="script.js"></script>
<style>
th{
  text-align:left;
}
</style>
</head>
<body>

<div style="width:90%;margin: 20px auto;">

	<h3> Search </h3>
	<table>
		<tr>
			<td>
				<input type='text' id='searchByEmployeeName' placeholder='Enter employee name'>
			</td>

			<td>
				<input type='text' id='searchByEventName' placeholder='Enter event name'>
			</td>

			<td>
				<input type='date' id='searchByDate' placeholder='Enter event date'>
			</td>
		</tr>
	</table>

	<!-- Table -->
	<table id='empTable' class='display dataTable'>
		<thead>
		<tr>
			<th>Employee Name</th>
			<th>Employee Email</th>
			<th>Event Name</th>
			<th>Event Fees</th>
			<th>Event Date</th>
		</tr>
		</thead>

	</table>
  <table id='empTotal' class='display dataTable'>
		<thead>
		<tr>
			<td>Amount Total</td>
			<td id="totalAmount"> </td>
		</tr>
		</thead>
	</table>
</div>
</body>
</html>

<?php 
$conn->close();
?>
