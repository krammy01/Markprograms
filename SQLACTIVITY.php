<html>
<head><title>Creating MySQL Database</title></head>
<body>
    <?php
    if (isset($_POST['add'])) {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'SQLACTIVITY';
        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        if ($mysqli->connect_errno) {
            printf("Connect failed: %s<br />", $mysqli->connect_error);
            exit();
        }
        printf('Connected successfully.<br />');

        // Create database if it doesn't exist
        $createDbQuery = "CREATE DATABASE IF NOT EXISTS $dbname";
        if ($mysqli->query($createDbQuery)) {
            printf("Database $dbname created successfully or already exists.<br />");
        } else {
            printf("Could not create database: %s<br />", $mysqli->error);
        }

        // Create table if it doesn't exist
        $createTableQuery = "CREATE TABLE IF NOT EXISTS SQLACTIVITY_tbl( " .
            "Instructor_id INT NOT NULL AUTO_INCREMENT, " .
            "First_Name VARCHAR(100) NOT NULL, " .
            "Last_Name VARCHAR(40) NOT NULL, " .
            "Employment_date DATE, " .
            "PRIMARY KEY ( Instructor_id )); ";
        if ($mysqli->query($createTableQuery)) {
            printf("Table SQLACTIVITY_tbl created successfully or already exists.<br />");
        } else {
            printf("Could not create table: %s<br />", $mysqli->error);
        }

        // Insert records
        // (Note: Use prepared statements to prevent SQL injection)

        $First_Name = $mysqli->real_escape_string($_POST['First_Name']);
        $Last_Name = $mysqli->real_escape_string($_POST['Last_Name']);
        $Employment_date = $mysqli->real_escape_string($_POST['Employment_date']);

        $insertQuery = "INSERT INTO SQLACTIVITY_tbl " .
            "(First_Name,Last_Name, Employment_date) " . "VALUES " .
            "('$First_Name','$Last_Name','$Employment_date')";

        $retval2 = mysqli_query($mysqli, $insertQuery);

        if (!$retval2) {
            die('Could not enter data: ' . mysqli_error($mysqli));
        }
        echo "Entered data successfully\n";

        // Fetch and display data
        $selectQuery = "SELECT Instructor_id, First_Name, Last_Name, Employment_date FROM SQLACTIVITY_tbl";
        $retval3 = mysqli_query($mysqli, $selectQuery);
        if (!$retval3) {
            die('Could not get data: ' . mysqli_error($mysqli));
        }

        while ($row = mysqli_fetch_array($retval3, MYSQLI_ASSOC)) {
            echo "Instructor ID :{$row['Instructor_id']}  <br />" .
                "First Name: {$row['First_Name']} <br />" .
                "Last Name: {$row['Last_Name']} <br />" .
                "Employment date: {$row['Employment_date']} <br />" .
                "--------------------------------<br />";
        }
        echo "Fetched data successfully\n";

        $mysqli->close();
    } else {
    ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table width="600" border="0" cellspacing="1" cellpadding="2">
                <tr>
                    <td width="250">Instructor First Name</td>
                    <td><input name="First_Name" type="text" id="First_Name"></td>
                </tr>
                <tr>
                    <td width="250">LAST NAME</td>
                    <td><input name="Last_Name" type="text" id="Last_Name"></td>
                </tr>
                <tr>
                    <td width="250">Employment date [ yyyy-mm-dd ]</td>
                    <td><input name="Employment_date" type="text" id="Employment_date"></td>
                </tr>
                <tr>
                    <td width="250"> </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="250"> </td>
                    <td><input name="add" type="submit" id="add" value="Submit"></td>
                </tr>
            </table>
        </form>
    <?php
    }
    ?>

</body>
</html>
