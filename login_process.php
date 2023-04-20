<?php
// MySQL database connection settings$conn = null;
$servername = "studdb.csc.liv.ac.uk";
$username = "sgtabdls";
$password = "hfeK9&B";
$dbname = "sgtabdls";
$charset = "utf8mb4";
$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";

$opt = array(
  PDO:: ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION ,
  PDO:: ATTR_DEFAULT_FETCH_MODE => PDO:: FETCH_ASSOC ,
  PDO:: ATTR_EMULATE_PREPARES => false,
  PDO::ATTR_PERSISTENT => true
);

// Start session
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  // User is already logged in, redirect to index page
  header("Location: blood-donations.php");
  exit();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Define variables with form input data and sanitize them
  $user = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  // Validate user input data
  if (empty($user) || empty($pass)) {
    echo  "Please enter both a username and password";
    exit();
  }

  try {
    // Create a new PDO instance and set error mode to exceptions
    $conn = new PDO($dsn, $username, $password,$opt);

    // Prepare SQL statement to retrieve user data from database
    $stmt = $conn->prepare("SELECT * FROM System_User_Login WHERE username = :user AND password = :pass");

    // Bind parameters to statement
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':pass', $pass);

    // Execute SQL statement and check if user data exists
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      // User exists, set session variables and redirect to index page
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $user;
      header("Location: blood-donations.php");
      exit();
    } else {
      // User does not exist, display error message

        header("Location: login.php?error=1");
    }
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
 $conn = null;
}

?>
