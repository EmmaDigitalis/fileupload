<?php
    //Establish connection
    include("database.php");
    $db = $connect;

    //Variables
    $id = $_POST["items"];
    $title = $_POST["title"];
    $desc = $_POST["description"];
    if("" == trim($_POST["creationdate"])){
        $date = date("Y/m/d");
    }else{
        $date = $_POST["creationdate"];
    }

    if (isset($_POST["unfinished"])){
        $unfinished = 1;    
    }else{
        $unfinished = 0;
    }

    //create array with info to delete file
    $query="UPDATE artwork
    SET title = '$title', date = '$date', description = '$desc', unfinished = $unfinished
    WHERE id=$id";

    if (mysqli_query($db, $query)){
        echo "updated information";

        echo "<br>";
        echo "<br>";
        echo $id;
        echo "<br>";
        echo $title;
        echo "<br>";
        echo $desc;
        echo "<br>";
        echo $date;
        echo "<br>";
        echo $unfinished;
    }else{
        echo mysqli_error($db);
    }

    //Close connection
    mysqli_close($db);

    header( "refresh:3;url=../manage.php" );
?>