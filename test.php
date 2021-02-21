<?php
    $data = serialize(array(101, 102, 103));
    echo $data . "<br>";
    echo gettype($data);
    
    $test = unserialize($data);

    if($test[0]==101){
        echo 'true';
    }
    
    foreach ($test as $key => $value) {
        echo $key.' => '.$value.'</br>';
    };
?>

<?php 
$stamp = strtotime("now");
$orderid = 'RT65-'.$stamp; 
$orderid = str_replace(".", "", $orderid); 
echo($orderid); 
?>