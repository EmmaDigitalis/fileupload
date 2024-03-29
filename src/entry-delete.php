<?php
    //Establish connection
    include("database.php");
    $db = $connect;

    //Set variables
    $dir = "../uploads/";

    if((isset($_POST['entryID'])) && (isset($_POST['dir']))){
        $entryid = $_POST['entryID'];
        $dir = $_POST['dir'];
        $information = delete_data($db, $entryid, $dir);
        echo $information;
    }else{
        echo "requested data could not be found in the database";
    }
    

    //fetch query
    function delete_data($db, $entryid, $dir){
        //create array with info to delete file
        $filequery="SELECT filename, extension FROM artwork WHERE id=$entryid";
        $exec=mysqli_query($db, $filequery);

        if(mysqli_num_rows($exec)>0){
            $emparray = array();
            while($row =mysqli_fetch_assoc($exec))
            {
                $emparray[] = $row;
            }
        }

        $msg = "";

        //create sql to delete entry from db

        $filepath = $dir . $emparray[0]["filename"] . "." . $emparray[0]["extension"];

        if (file_exists($filepath)){
            $entryquery="DELETE FROM artwork WHERE id=$entryid";
            $exec=mysqli_query($db, $entryquery);
            
            if($exec){
                $msg = "Data was deleted successfully";
            }else{
                $msg= "Error: " . $entryquery . "<br>" . mysqli_error($db);
            }
        }else{
            $msg = "The requested file does not exist, but an entry for it does exist in the database.
            Please check the backend. See below..."; //Add delete value pop-up 
        }

        return $msg;
        //Close connection
        mysqli_close($db);
        
    }
?>