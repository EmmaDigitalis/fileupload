<?php
    include("database.php");
    $db = $connect;

    if(isset($_POST['entryID'])){
        $entryid = $_POST['entryID'];
        
        $fetchData = fetch_data();
        echo json_encode($fetchData);
    }else{
        echo "requested data could not be found in the database";
    }

    //Close connection
    mysqli_close($db);

    //fetch query
    function fetch_data(){
        global $db;
        global $entryid;
        $query="SELECT * FROM artwork WHERE id=$entryid";
        $result=mysqli_query($db, $query);
        if(mysqli_num_rows($result)>0){
            $emparray = array();
            while($row =mysqli_fetch_assoc($result))
            {
                $emparray[] = $row;
            }
            return $emparray;
        }else{
            return $emparray=[];
        }
    }
?>