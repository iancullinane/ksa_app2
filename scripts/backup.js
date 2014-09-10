


<?php


$db = new PDO('mysql:host=localhost;dbname=data', 'eignh', '#mountain08');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*function getBasicData(){

foreach($db->query('SELECT * FROM kas_') as $row) {
    echo $row['course'].' '.$row['ksa']; //etc...
  };
};
*/


function basicQuery(PDO $pdo){
  foreach($pdo->query('SELECT * FROM kas_') as $row){
    echo $row['course'].' '.$row['ksa']; //etc...
  };
};

/*$data = $db->query('SELECT * FROM ksa_ LIMIT 0, 10');*/





/*try {
    //connect as appropriate as above
    $db->query('SELECT * FROM ksa_ LIMIT 0, 10'); //invalid query!
    foreach($db as $row){
      echo $row['course'];
  };
} catch(PDOException $ex) {
    echo "An Error occured!"; //user friendly message
    some_logging_function($ex->getMessage());
}
*/












/*echo "<table>";
echo "<tr>";


foreach($data as $row){
  echo $row['course'] . ' ';
  echo $row['ksa'] . ' ';
  echo $row['description'] . ' ';
  echo $row['category'] . ' ' . '</br>';
  
  
};
*/



?>









