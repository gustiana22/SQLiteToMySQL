<?php

	$db = new SQLite3('D:\mta\db_sqlite\192.168.148.14\T5-MBAPAudit.db');

	$results = $db->query('SELECT count(*) AS TOTAL FROM audit_transactions');
	$i = 0;
	while ($row = $results->fetchArray()) {
	echo $row["TOTAL"];
	}
	//echo $i;
	
?>