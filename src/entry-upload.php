<?php
include("database.php");
$db = $connect;

//Variables
$title = $_POST["title"];
$desc = $_POST["description"];
if("" == trim($_POST["creationdate"])){
    $date = date("Y/m/d");
}else{
    $date = $_POST["creationdate"];
}
$dbfilename = $_POST["filename"];

if (isset($_POST["unfinished"])){
    $unfinished = 1;    
}else{
    $unfinished = 0;
}

echo $unfinished;

//File information
$dir = "../uploads/";   //Set upload directory
$file = $dir . basename($_FILES["userfile"]["name"]);   //Set eventual upload location

$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));   //Get file extension

$filename = $dir . $dbfilename . "." . $ext;  //Set final image location & name

$uploadOk = 1;  //Init upload status


// Check if image file is an actual image or fake image
if (isset($_POST["submit"])){
    $check = getimagesize($_FILES["userfile"]["tmp_name"]);
    if ($check !== false){
        echo nl2br("File is an image - " . $check["mime"] . "\n\r");
        $uploadOk = 1;
    }else{
        echo nl2br("File is not an image\n\r");
        $uploadOk = 0;
    }
}

// Check if file exists
if (file_exists($filename)){
    echo nl2br("Filename already exists\n\r");
    $uploadOk = 0;
}

//Check file size
if ($_FILES["userfile"]["size"] > 500000) {
    echo nl2br("Too large\n\r");
    $uploadOk = 0;
}

// Allow certain file formats
if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) {
  echo nl2br("Not a mainstream image file\n\r");
  $uploadOk = 0;
}

$sql = "INSERT INTO artwork (title, filename, date, description, extension, unfinished) VALUES ('$title', '$dbfilename', '$date', '$desc', '$ext', '$unfinished')";

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0){
    echo nl2br("Could not upload file\n\r");
    //Try to upload if not
}else{
    if (mysqli_query($db, $sql)) {
        if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $filename)){
            echo nl2br("File has been uploaded\n\r");
        }else{
            echo nl2br("DB Entry created\n\Somehow couldn't upload image\n\WARNING: There might be an empty entry in the database now!\n\r");
        }
    }else{
        echo nl2br("Somehow couldn't upload file\n\r");
    }
}

//Close connection
mysqli_close($db);

header( "refresh:3;url=../index.html" );
?>