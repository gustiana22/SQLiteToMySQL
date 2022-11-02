<?php
	
	$count;
	$current;
	
	$file = fopen("last.txt", "r");
	while($line = fgets($file)) {
		$current =  $line;
	}
	fclose($file);
	
	
	class MyDB extends SQLite3
	{
		function __construct()
		{
			$this->open('dump.db');
		}
	}
	$mysql = mysqli_connect("ip_address", "user", "password", "nama_db");
	$db = new MyDB();
	
	$raw_query = $db->query("SELECT count(*) as total FROM nama_table");
	$raw_count = $raw_query->fetchArray();
	$count = $raw_count["total"];
	
	if ($count > $current) {
		
	
		$limit = $count - $current;
		$raw_query = $db->query("SELECT * FROM nama_table order by KOLOM DESC limit ".$limit);
		while($raw_data = $raw_query->fetchArray()) {
			
			$result = mysqli_query($mysql, "SELECT * FROM nama_table where transId = '".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."'");
			$check = mysqli_num_rows($result);
			
			if ($check == 0){
				mysqli_query($mysql, "INSERT INTO audit_transactions VALUES 
				('".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."',
				'".mysqli_real_escape_string($mysql, $raw_data['KOLOM'])."')");
			}
			mysqli_free_result($result);
			
		}
		$file = fopen("last.txt", "w");
		fwrite($file, $count);
		fclose($file);
	}
	
	
?>