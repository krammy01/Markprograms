<html>
   <head>
      <title>Connecting MySQL Server</title>
   </head>
   <body>
      <?php
         $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = '';
         $dbname = 'PHPScriptDemo';
         
         // Attempt to establish a connection to MySQL server
         $conn = new mysqli($dbhost, $dbuser, $dbpass);

         if ($conn->connect_errno) {
            die("Connect failed: " . $conn->connect_error);
         }

         // Creating Database
         $createDbQuery = "CREATE DATABASE IF NOT EXISTS $dbname";

         if ($conn->query($createDbQuery) === TRUE) {
            echo "Database $dbname created successfully.<br />";
         } else {
            die("Error creating database: " . $conn->error);
         }

         // Select the created database
         $conn->select_db($dbname);

         // Create 'students' table
         $createStudentsTableSQL = "CREATE TABLE IF NOT EXISTS students (
            student_id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            date_of_birth DATE NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            phone VARCHAR(255) NOT NULL
         )";

         if ($conn->query($createStudentsTableSQL) === TRUE) {
            echo "Table 'students' created successfully" . PHP_EOL;
         } else {
            die("Error creating table 'students': " . $conn->error);
         }

         // Create 'courses' table
         $createCoursesTableSQL = "CREATE TABLE IF NOT EXISTS courses (
            course_id INT AUTO_INCREMENT PRIMARY KEY,
            course_name VARCHAR(255) NOT NULL UNIQUE,
            credits INT NOT NULL
         )";

         if ($conn->query($createCoursesTableSQL) === TRUE) {
            echo "Table 'courses' created successfully" . PHP_EOL;
         } else {
            die("Error creating table 'courses': " . $conn->error);
         }

         // Create 'instructors' table
         $createInstructorsTableSQL = "CREATE TABLE IF NOT EXISTS instructors (
            instructor_id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            phone VARCHAR(255) NOT NULL
         )";

         if ($conn->query($createInstructorsTableSQL) === TRUE) {
            echo "Table 'instructors' created successfully" . PHP_EOL;
         } else {
            die("Error creating table 'instructors': " . $conn->error);
         }

         // Create 'enrollments' table
         $createEnrollmentsTableSQL = "CREATE TABLE IF NOT EXISTS enrollments (
            enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
            student_id INT NOT NULL,
            course_id INT NOT NULL,
            enrollment_date DATE NOT NULL,
            grade VARCHAR(255),
            FOREIGN KEY (student_id) REFERENCES students(student_id),
            FOREIGN KEY (course_id) REFERENCES courses(course_id)
         )";

         if ($conn->query($createEnrollmentsTableSQL) === TRUE) {
            echo "Table 'enrollments' created successfully" . PHP_EOL;
         } else {
            die("Error creating table 'enrollments': " . $conn->error);
         }

         $conn->close();
      ?>
   </body>
</html>
