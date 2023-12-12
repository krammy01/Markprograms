<html>
   <head>
      <title>Connecting MySQL Server</title>
   </head>
   <body>
      <?php
         $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = '';
         $dbname = 'blog';
         $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

         if ($mysqli->connect_errno) {
            printf("Connect failed: %s<br />", $mysqli->connect_error);
            exit();
         }
         printf('Connected successfully.<br />');

         // Creating Database
         $createDbQuery = "CREATE DATABASE IF NOT EXISTS blog";
         if ($mysqli->query($createDbQuery)) {
            printf("Database blog created successfully.<br />");
         } else {
            printf("Could not create database: %s<br />", $mysqli->error);
         }

         // Selecting the database
         $mysqli->select_db($dbname);

         // Creating Table
         $sql = "CREATE TABLE students ( ".
            "id INT(6) AUTO_INCREMENT PRIMARY KEY, ".
            "name VARCHAR(255) NOT NULL, ".
            "email VARCHAR(255) NOT NULL, ".
            "phone VARCHAR(255) NOT NULL, ".
            "course VARCHAR(255) NOT NULL, ".
            "instructor VARCHAR(255) NOT NULL, ".
            "enrollment VARCHAR(255) NOT NULL)";
            
            if ($mysqli->query($sql)) {
               printf("Table students created successfully.<br />");
           }
           if ($mysqli->errno) {
               printf("Could not create table: %s<br />", $mysqli->error);
           }

         $mysqli->close();
      ?>
   </body>
</html>
