<?php
$db = new SQLite3('mysqlitedb.db');

$sql = 'CREATE TABLE product(product_id INTEGER PRIMARY KEY,
                              product_name varchar(20),
                              year integer,
                              sale double)';


if ($db->exec($sql)) {
   echo "Table created successfully \n";
}
else {
   echo "table already exist \n";
}

$stm = $db->prepare("INSERT INTO product(product_name,year,sale) VALUES (?,?,?)");
$stm->bindParam(1,$product_name1);
$stm->bindParam(2,$year1);
$stm->bindParam(3,$sale1);

for ($i=0; $i < sizeof($years_array); $i++) { 
    $year1 = $years_array[$i];
    $product_name1 = $petroleum_product_array[$i];
    $sale1 = $sale_array[$i];
    $stm->execute();
}