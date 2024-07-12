<?php
	$conn = new mysqli("localhost", "root", "", "test_import");
	if(!$conn)
	{
		echo $conn->connect_error;
	}
	
	$dir = "excel_test";
	$a = scandir($dir);
	print_r($a);exit;
	
	
	$col=array();
	$filename = $_FILES["upload_file"]["tmp_name"];
	
	if ($_FILES["upload_file"]["size"] > 0) 
	{
        $file = fopen($filename, "r");
		while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) 
		{
			$col[]=implode(',',$emapData);
		}
	}
	fclose($file);
	
	
	$table_col=array();
	$result = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'test_import' AND TABLE_NAME = 'import';");
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_array())
		{
			$table_col[]=$row["COLUMN_NAME"];
		}
		$file_col=explode(',',$col[0]);
		foreach($file_col as $f)
		{
			if(!in_array($f,$table_col))
			{
				
				$conn->query("ALTER TABLE import ADD COLUMN ".$f." VARCHAR(100) ");
			}
		}
		
	}
	//print_r($col);exit;
	//$col output
	//Array ( [0] => name,price,stock [1] => test,500,200 [2] => a,10,20 )
	$i=1;
	$end_row=array_key_last($col);
	while($i<=$end_row)
	{
		//print_r($conn->query("INSERT INTO import(".$col[0].",created_at,updated_at) VALUES(".$col[$i].",".date('Y-m-d h:i:s').",".date('Y-m-d h:i:s').");"));
		$conn->query("INSERT INTO import(".$col[0].",created_at,updated_at) VALUES(".$col[$i].",".date('Y-m-d h:i:s').",".date('Y-m-d h:i:s').")");
		$i++;
		
	}
	//Output of insert query
	//INSERT INTO import(name,price,stock,created_at,updated_at) VALUES(test,500,200,2021-11-15 12:17:13,2021-11-15 12:17:13)
	//INSERT INTO import(name,price,stock,created_at,updated_at) VALUES(a,10,20,2021-11-15 12:17:13,2021-11-15 12:17:13)
?>