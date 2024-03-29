<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
</head>

<body>

    <div class="artcontainer">
        <?php
            include("src/database.php");
            
            //Attempt getting content
            $content = "SELECT * FROM artwork ORDER BY id ASC;";
            $result = $connect->query($content);

            $rowcount = $result->num_rows;

            if ($rowcount > 0) {
                //output data of each row
                while($row = $result->fetch_assoc()) {
                if ($row["unfinished"] == 1){
                    echo "<div class='item hidden-art'>";
                }else{
                    echo "<div class='item'>";
                }
                echo "
                    <img src='uploads/" .$row["filename"]. "." .$row["extension"]. "' alt='" .$row["title"]."'>
                    <h2> " .$row["title"]. " </h2>
                    <p> " .$row["description"]. " </p>
                    <p> " .$row["date"]. " </p>
                </div>
                ";
                }
            }

                
            //Close connection
            mysqli_close($connect);
        ?>
    </div>

    <div class="floater">
        <div class="checkbox" onclick="toggleHiddenArt();"></div>
        <p>Toggle unfinished works</p>
    </div>

    
    <script src="js/main.js"></script>
</body>

</html>