<?php

/*IMPORTANT: takes the data from the above method */
function insert_outcome($outstmt, $ksa_id, $courseID){

    //uncomment to use for sql statment debug
    /*echo "Statement passed to insert outcome is: " . $outstmt . "</br>";
    echo "KSA_ID passed to insert outcome is: " . $ksa_id . "</br>";
    echo "Course ID passed to insert outcome is: " . $courseID . "</br>";*/

    
    //insert for the outcome data
    $sql = "INSERT INTO outcomes (OutcomeStmt, KSA_ID, CourseID) VALUES (:outcomeStmt, :ksa_id, :courseID);";

    //PDO Connecttion
    $core = Core::getInstance();

    //Create a prepared statement
    $stmt = $core->dbh->prepare($sql);
    $stmt->bindParam(':outcomeStmt', $outstmt, PDO::PARAM_STR);
    $stmt->bindParam(':ksa_id', $ksa_id, PDO::PARAM_INT);
    $stmt->bindParam(':courseID', $courseID, PDO::PARAM_INT);

    //execute the function after binding the variables
    $stmt->execute();
}



//function to grab the Institution name and insert it
//TODO: this function is not working yet
function insert_institution($col){

    $sql = "INSERT INTO institution (InstitutionName) VALUES (:name);";

    //PDO Connecttion
    $core = Core::getInstance();

    //Create a prepared statement
    $stmt = $core->dbh->prepare($sql);
    $stmt->bindParam(':name', $col, PDO::PARAM_STR);
    $stmt->execute();
}


/*will Insert into the course table*/
function insert_course($number, $name, $inst){
    
    $sql = "INSERT INTO course (CourseNumber, CourseName, InstID) VALUES (:courseNumber, :courseName, :instID);";

    //PDO Connecttion
    $core = Core::getInstance();

    //Create a prepared statement
    
    $stmt = $core->dbh->prepare($sql);
    $stmt->bindParam(':courseNumber', $number, PDO::PARAM_STR);
    $stmt->bindParam(':courseName', $name, PDO::PARAM_STR);
    $stmt->bindParam(':instID', $inst, PDO::PARAM_INT);
    $stmt->execute();

}