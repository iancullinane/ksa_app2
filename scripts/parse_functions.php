<?php 

/*currently not in use*/
/*this code could potentially be used to save the csv files*/
function upload_file($file){

    //fields needed
    $intake_file = $file;
    $output_file = "output.csv";

    $found = false;

    //check the file exists
    if (isset($intake_file)) {
      echo "File found" . "<br>";
      $found = true;
  } else {    
    echo "File not found </br>";
}

    //print file name
echo $file['file']['name'] . "</br>";

    //move the file into a temporary folder
move_uploaded_file($file['file']['tmp_name'], './upload_dir/'.$file['file']['name']);
echo "</br>File moved?";     
};








function check_file(){
    // check incoming file for errors
    //check if file type is what is needed. must be in .csv format
    if($_FILES['file']['error'] === 0){
        $name = $_FILES['file']['name'];
        $ext = strtolower(end(explode('.', $_FILES['file']['name'])));
        $type = $_FILES['file']['type'];
        $tmpName = $_FILES['file']['tmp_name'];


        // check the file is a csv
        if($ext === 'csv' || $ext === 'xlsx'){
            return true;
        } else {
            return false;
        }

    }
};
















/*SUPER CRAZY IMPORTANT FUNCTION*/

/*state of function, not all of this code is active, most important piece is*/
/*the second if statement and where it says $data[0] THESE INDEXES REPRESENT*/
/*THE COLUMNS, each needed column can be split off with these indexes       */
function parseCSV(){





    

    
    
    /*As the rows are copied, save to an array to be used*/
    $csv = array();

    /*used to collect information about a given file as it is being populated
    instituion, course name, etc*/
    $file = array();


    /*check if the file exists*/
    if(isset($_FILES['file'])){
    if(check_file($_FILES['file'])){

        //set the excel version needed
        $inputFileType = 'Excel2007';

        //set variable with path of file, set the sheet name we want
        $inputFileName = $_FILES['file']['tmp_name'];
        $sheetname = 'KSAs';
        
        //create an object reader, pass in the file type, load the file
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setLoadSheetsOnly($sheetname);

        //load the file into the reader object
        $objPHPExcelReader = $objReader->load($inputFileName);
        

        $loadedSheetNames = $objPHPExcelReader->getSheetNames();
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcelReader, 'CSV');
        
        foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
            $objWriter->setSheetIndex($sheetIndex);
            $objWriter->save($loadedSheetName.'.csv');
        }

        

        progressResult("Result for: " . $_FILES['file']['name'] . "");

        


        /*echo "Result for: " . $_FILES['file']['name'];*/
        $tmpName = $_FILES['file']['tmp_name'];

        /*echo $_FILES['file']['tmp_name']; */
            //yes, file is csv, open the document

        //open the document that has been uploaded
        if(($handle = fopen('./' . $loadedSheetName . '.csv', 'r')) !== FALSE) {
            set_time_limit(0);
            
            //index for server side data
            $row = 0;

            //print the csv to an array, delimiter is ','
            while(($data = fgetcsv($handle, 10000, ',')) !== FALSE) {


                //if row is 0 get the institution name
                if($data[0] === 'Institution' || $data[0] === 'Instititution'){
                    $file['InstName'] = $data[1];
                    

                    if(!tableCheck('institution', 'InstitutionName', $file['InstName'])){
                        insert_institution($data[1]);
                        progressResult($file['InstName'] . " has been added to the database.");
                    } else {
                        
                        progressWarning("Data for " . $file['InstName'] . " already entered.");


                        /*echo "</br>";
                        echo "<em>Institution data for " . $file['InstName'] . " already entered.</em>";
                        echo "</br>";*/
                    }
                }

                //When the first column in a row is equal to "Course Number" 
                //then we know the NEXT column will contain the data
                //samesies for the next row to get the number
                if($data[0] === "Course Number"){
                    //save the data locally for yucks
                   $file['CourseNumber'] = $data[1];
                    
                    //before doing anything check the 'course' table for a duplicate
                    if(!tableCheck('course','CourseNumber',$file['CourseNumber'])){
                        $data = fgetcsv($handle, 10000, ',');
                        $file['CourseName'] = $data[1];     
                        insert_course($file['CourseNumber'], $file['CourseName'], getID('*','institution', 'InstitutionName', $file['InstName']));
                        progressResult($file['CourseNumber'] . " " . $file['CourseName'] . " has been added to the database.");

                        print_array($file);
                   } else {
                        $data = fgetcsv($handle, 10000, ',');
                        $file['CourseName'] = $data[1];

                        progressWarning("Data for " . $file['CourseNumber'] . " already entered.");
                   }
                }                    

                if($data[0] === 'KSA') {
                    progressResult("Beginning of useful data next row.");
                    //skip row
                    //all rows from here out will represent the actual mapping data
                    $data = fgetcsv($handle, 10000, ',');

                }


                //this takes us back to the original while statement
                //we only need the mapping data so we only check the last column
                if($data[3] === ""){
                    //if it is empty, mark that it was checked 
                    /*echo ".";*/
                } else {
                    //take the data and call the functions to populate
                    /*echo ".</br>";*/
                    //save outcome data locally
                    $file['Outcome'] = $data[3];
                    
                    /**********IMPORTANT*************/
                    //run the insert outcome function
                    insert_outcome($data[3], getID('*', 'ksa', 'KSA_ID', $data[0]), getID('ID','course', 'CourseName', $file['CourseName']));

                    
                }


        
        // number of fields in the csv
        $num = count($data);
        /*echo "<p> $num fields in line $row: <br /></p>\n";*/

        // get the values from the csv
        $csv[$row]['ksa'] = $data[0];
        $csv[$row]['desc'] = $data[1];
        $csv[$row]['competency'] = $data[2];
        $csv[$row]['outcome'] = $data[3];

                    //increment to next index
        $row++;
    }

    progressResult("Data has been processed");
    fclose($handle);
}
} else {
    progressResult("No entry for file upload");
}
/*print_array($file);*/

//delete the spreadsheet once we are don with it
unlink('./' . $loadedSheetName . '.csv');

}};








/*EXPERIMENTAL KIND OF*/
/***************************INNER JOIN FUNCTION!!!!!****************************/

function generateJoinedTable(){}


?>