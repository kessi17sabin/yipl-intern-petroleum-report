<?php

function callAPI($method, $url, $data){
    $curl = curl_init();

    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 
    // EXECUTE:
    $result = curl_exec($curl);
    if(!$result){die("Connection Failure");}
    curl_close($curl);
    return $result;
 }

$url = callAPI('GET','https://raw.githubusercontent.com/younginnovations/internship-challenges/master/programming/petroleum-report/data.json',false);
$json = json_decode($url,true);

$years = "";
$petroleum_product = "";
$sale = "";

//extracting data from json file
foreach ($json as $jsonValue) {

    $years .= $jsonValue['year'] . ",";
    $petroleum_product .= $jsonValue['petroleum_product'] . ",";
    $sale .= $jsonValue['sale'] . ",";
}

//making an array of data extracted
$years_array = explode(",",$years,-1);
$petroleum_product_array = explode(",",$petroleum_product,-1);
$sale_array = explode(",",$sale,-1);

//opening an sqlite database
$db = new SQLite3('mysqlitedb.db');

//making array of product names
$res = $db->query('SELECT DISTINCT product_name FROM product');
$product_data = "";
while($row = $res->fetchArray())
{
    $product_data .= $row[0] . ",";
}
$product_array = explode(",",$product_data,-1);

//heading in cli
echo str_pad('Product',30) . str_pad('Year',20) . str_pad('Min',10) . str_pad('Max',10) . "Avg" . "\n\n" ;

//looping to get the values for all product names
for ($i=0; $i < sizeof($product_array); $i++) { 
    $product_type = $product_array[$i];

    //for range 2010-2014
    $interval1 = "2010-2014";
    //calculating minimum value
    $product1 = $db->query("SELECT MIN(sale) AS SmallestSale FROM product 
                            where NOT sale = '0' AND product_name = '$product_type' AND year BETWEEN 2010 AND 2014");

    $row = $product1->fetchArray();

    $min1 = $row['SmallestSale'];
    //ommiting null value
    if ($min1!=NULL) {
        $min1 = $row['SmallestSale'];
    }
    else {
        $min1 = 0;
    }

    //calculating maximum value
    $product2 = $db->query("SELECT MAX(sale) AS LargestSale FROM product 
                            where NOT sale = '0' AND product_name = '$product_type' AND year BETWEEN 2010 AND 2014");

    $row = $product2->fetchArray();
    $max1 = $row['LargestSale'];
    if ($max1!=NULL) {
        $max1 = $row['LargestSale'];
    }
    else {
        $max1 = 0;
    }

    //calculating average value
    $product3 = $db->query("SELECT AVG(sale) AS AvgSale FROM product 
                            where NOT sale = '0' AND product_name = '$product_type' AND year BETWEEN 2010 AND 2014");

    $row = $product3->fetchArray();
    $avg1 = $row['AvgSale'];
    if ($avg1!=NULL) {
        $avg1 = $row['AvgSale'];
    }
    else {
        $avg1 = 0;
    }

    echo str_pad($product_type,30) . str_pad($interval1,20) . str_pad($min1,10) . str_pad($max1,10) . $avg1 . "\n" ;

    //for range 2005-2009
    $interval2 = "2005-2009";
    //calculating minimum value
    $product4 = $db->query("SELECT MIN(sale) AS SmallestSale FROM product 
                            where NOT sale = '0' AND product_name = '$product_type' AND year BETWEEN 2005 AND 2009");

    $row = $product4->fetchArray();
    $min2 = $row['SmallestSale'];
    if ($min2!=NULL) {
        $min2 = $row['SmallestSale'];
    }
    else {
        $min2 = 0;
    }

    //calculating maximum value
    $product5 = $db->query("SELECT MAX(sale) AS LargestSale FROM product 
                            where NOT sale = '0' AND product_name = '$product_type' AND year BETWEEN 2005 AND 2009");

    $row = $product5->fetchArray();
    $max2 = $row['LargestSale'];
    if ($max2!=NULL) {
        $max2 = $row['LargestSale'];
    }
    else {
        $max2 = 0;
    }

    //calculating average value
    $product6 = $db->query("SELECT AVG(sale) AS AvgSale FROM product 
                            where NOT sale = '0' AND product_name = '$product_type' AND year BETWEEN 2005 AND 2009");

    $row = $product6->fetchArray();
    $avg2 = $row['AvgSale'];
    if ($avg2!=NULL) {
        $avg2 = $row['AvgSale'];
    }
    else {
        $avg2 = 0;
    }

    echo str_pad($product_type,30) . str_pad($interval2,20) . str_pad($min2,10) . str_pad($max2,10) . $avg2 . "\n" ;

    //for range 2000-2004
    $interval3 = "2000-2004";
    //calculating minimum value
    $product7 = $db->query("SELECT MIN(sale) AS SmallestSale FROM product 
                            where NOT sale = '0' AND product_name = '$product_type' AND year BETWEEN 2000 AND 2004");

    $row = $product7->fetchArray();
    $min3 = $row['SmallestSale'];
    if ($min3!=NULL) {
        $min3 = $row['SmallestSale'];
    }
    else {
        $min3 = 0;
    }

    //calculating maximum value
    $product8 = $db->query("SELECT MAX(sale) AS LargestSale FROM product 
                            where NOT sale = '0' AND product_name = '$product_type' AND year BETWEEN 2000 AND 2004");

    $row = $product8->fetchArray();
    $max3 = $row['LargestSale'];
    if ($max3!=NULL) {
        $max3 = $row['LargestSale'];
    }
    else {
        $max3 = 0;
    }

    //calculating average value
    $product9 = $db->query("SELECT AVG(sale) AS AvgSale FROM product 
                            where NOT sale = '0' AND product_name = '$product_type' AND year BETWEEN 2000 AND 2004");

    $row = $product9->fetchArray();
    $avg3 = $row['AvgSale'];
    if ($avg3!=NULL) {
        $avg3 = $row['AvgSale'];
    }
    else {
        $avg3 = 0;
    }

    //displaying value in pattern in cli
    echo str_pad($product_type,30) . str_pad($interval3,20) . str_pad($min3,10) . str_pad($max3,10) . $avg3 . "\n" ;

}