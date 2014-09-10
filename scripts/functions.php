<?php 

/*to select classes from the classes/ directory*/
function __autoload($class_name) {
    $filename = 'classes/' . str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)).'.php';
    include $filename;
};


/*This has something to do with pulling db login info from a file
definitely on the TODO list*/


/*Config::write('db.host', 'localhost');
Config::write('db.port', '3306');
Config::write('db.basename', 'data');
Config::write('db.user', 'eignh');
Config::write('db.password', '#mountain08');
*/








/*This will produce a table when a file is loaded*/
function generateQuery($statement){
     
    //PDO Connecttion
    $core = Core::getInstance();

    //Create a prepared statement
    $stmt = $core->dbh->prepare($statement);
    $stmt->execute();

    /*used to get the column names for later on*/
    $fetchColumn = $stmt->fetch(PDO::FETCH_ASSOC);

    //reset the cursor, otherwise the pointer will open on the second row later on
    $stmt->closeCursor();
    $stmt->execute();

    //used to access the keys for each item in the result
    //works because column names share key names
    $fields = array_keys($fetchColumn);
   
    //begin table creation
    echo '<table id="result_table">';

    //print the column labels
    getColumnNames($fields);
    echo "<tbody>";

    //while there are rows in the Result object, print the table
    while($results = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
            for($j = 0; $j < $stmt->columnCount(); $j++){
                echo "<td>" . $results[$fields[$j]] . "</td>";
            }
        
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
};




/*for creating tables from inner join statements*/
function generateJoin($statement){
     
    //PDO Connecttion
    $core = Core::getInstance();

    //Create a prepared statement
    $stmt = $core->dbh->prepare($statement);
    $stmt->execute();

    /*used to get the column names for later on*/
    $fetchColumn = $stmt->fetch(PDO::FETCH_ASSOC);

    //reset the cursor, otherwise the pointer will open on the second row later on
    $stmt->closeCursor();
    $stmt->execute();

    //used to access the keys for each item in the result
    //works because column names share key names
    $fields = array_keys($fetchColumn);
   
    //begin table creation
    echo '<table id="result_table">';

    //print the column labels
    getColumnNames($fields);
    echo "<tbody>";

    //while there are rows in the Result object, print the table
    while($results = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
            for($j = 0; $j < $stmt->columnCount(); $j++){
                echo "<td>" . $results[$fields[$j]] . "</td>";
            }
        
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
};








//will print out the columns of a PDO::fetch statement in a table row
//use for creating a tr that has the header info for a row
function getColumnNames($fields){
    
    //begins the table
    //THE TABLE MUST HAVE <thead> tag, otherwise TableSorter won't work
    echo "<thead>";
    echo "<tr>";

    //take passed value, value will represent the column names
    for($i = 0; $i < count($fields); $i++){
        
        //print it
        echo "<th>" . $fields[$i] . "</th>";
    }

    //close thead
    echo "</tr>";
    echo "</thead>";
}



function tableCheck($table, $column, $value){
     
    $sql = "SELECT * FROM $table WHERE $column = '$value';";

    //PDO Connecttion
    $core = Core::getInstance();

    //Create a prepared statement
    $stmt = $core->dbh->prepare($sql);
    $stmt->execute();
    
    /*echo "</br>Table Check Statement" . $sql ;
    echo "</br>Column count for $table is: " . $stmt->columnCount();*/

    if($stmt->rowCount() > 0){
        return true;
    } else {
        return false;
    }

}

function getID($select, $table, $column, $value){
     
    $sql = "SELECT $select FROM $table WHERE $column = '$value';";

    //PDO Connecttion
    $core = Core::getInstance();

    //Create a prepared statement
    $stmt = $core->dbh->prepare($sql);
    $stmt->execute();
    
    
    
   /* echo "</br>The return is: " . $stmt->fetchColumn(0);*/

    return $stmt->fetchColumn(0);

}



function getCol($select, $table, $column, $value){
     
    $sql = "SELECT $select FROM $table WHERE $column = '$value';";

    //PDO Connecttion
    $core = Core::getInstance();

    //Create a prepared statement
    $stmt = $core->dbh->prepare($sql);
    $stmt->execute();
    
    
    
   /* echo "</br>The return is: " . $stmt->fetchColumn(0);*/

    return $stmt->fetchColumn(0);

}




//not in use, has no value?
/*function insertQuery($statement){
     
    //PDO Connecttion
    $core = Core::getInstance();

    //Create a prepared statement
    $stmt = $core->dbh->prepare($statement);
    $stmt->execute();
}*/
    




















?>


