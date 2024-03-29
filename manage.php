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
    <div class="formcontainer">
        <form action="" method="post" enctype="multipart/form-data">
            <select name="items" id="itemslist">
                <option selected disabled>Select...</option>
                <option disabled>-----------</option>
                <?php
                    include("src/database.php");
                    $db = $connect;

                    //Attempt getting content
                    $content = "SELECT * FROM artwork ORDER BY id ASC;";
                    $result = $db->query($content);

                    $rowcount = $result->num_rows;

                    if ($rowcount > 0) {
                        //output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<option value=" .$row["id"]. ">" .$row["title"]. "</option>";
                        }
                    }

                    //Close connection
                    mysqli_close($db);
                ?>
            </select>

            <h2>ID: <span>-</span></h2>
            <figure>
                <img id="manage-img" src="img/test.jpg" alt="MANAGE">
                <figcaption>
                    -
                </figcaption>
            </figure>

            Title:
            <input id="manage-title" type="text" name="title" maxlength="20" required>

            Item Description:
            <textarea id="manage-desc" name="description" maxlength="255" required></textarea>

            Date of Completion:
            <input id="manage-date" type="date" name="creationdate">

            Unfinished:
            <input id="manage-unfinished" type="checkbox" name="unfinished">

            <input id="manage-update" type="button" value="update" disabled>
            <input id="manage-delete" type="button" value="delete" disabled>
        </form>
    </div>


    <script src="js/main.js"></script>
</body>

</html>