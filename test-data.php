<?php
$hostname = "localhost";
$database = "laundry";
$username = "root";
$password = "";
$connect = mysql_connect($hostname, $username, $password)
	or die('Could not connect: ' . mysql_error());
	//Select The database
	$bool = mysql_select_db($database, $connect);
	if ($bool === False){
	   print "can't find $database";
	}
	// create the query.
	$pagenum = $_GET['pagenum'];
	$pagesize = $_GET['pagesize'];
	$start = $pagenum * $pagesize;
	$query = "SELECT SQL_CALC_FOUND_ROWS * FROM shipping_manifest LIMIT $start, $pagesize";

	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
	$rows = mysql_query($sql);
	$rows = mysql_fetch_assoc($rows);
	$total_rows = $rows['found_rows'];
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$customers[] = array(
			'id' => $row['id'],
			'manifest_number' => $row['manifest_number'],
			'customer_id' => $row['customer_id'],
			'department_id' => $row['department_id'],
			'outgoing_cart_id' => $row['outgoing_cart_id'],
			'shipping_date' => $row['shipping_date']
		  );
	}
    $data[] = array(
       'TotalRows' => $total_rows,
	   'Rows' => $customers
	);
	echo json_encode($data);
?> 