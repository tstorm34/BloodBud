
<?php
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

// Define variables with form input data and sanitize them
$full_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_STRING);
$amount = filter_input(INPUT_POST, 'Amountofunits', FILTER_SANITIZE_NUMBER_FLOAT);
$blood_type = filter_input(INPUT_POST, 'blood_type', FILTER_SANITIZE_STRING);
$expiry_date = filter_input(INPUT_POST, 'expiryDate', FILTER_SANITIZE_STRING);

// Split full name into parts by spaces
$name_parts = explode(" ", $full_name);

// Check if there are exactly 2 parts
if (count($name_parts) != 2) {
  echo "Error: Name must contain exactly 2 parts separated by a space";
} else {
  // Assign name parts to variables
  $firstname = $name_parts[0];
  $surname = $name_parts[1];
}

// Validate user input data
if (empty($firstname) || empty($surname) || empty($email) || empty($phone) || empty($amount) || empty($blood_type) || empty($expiry_date)) {
  header("Location: blood-donations.php?error=1");
} else {
  try {
    $conn = new PDO($dsn, $username, $password,$opt);
    $expiry_date = date('Y-m-d', strtotime($expiry_date. ' + 42 days'));
    // Prepare SQL statement to insert data into database
    $stmt = $conn->prepare("INSERT INTO Donations (patient_firstname, patient_surname, patient_email, patient_phone_number, donation_amount, blood_type, expiry_date) VALUES (:firstname, :surname, :email, :phone, :amount, :blood_type, :expiry_date)");

    // Bind parameters to statement
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':blood_type', $blood_type);
    $stmt->bindParam(':expiry_date', $expiry_date);

    // Execute SQL statement and check if data was inserted
    if ($stmt->execute()) {
      $error_message = "Data inserted successfully";
      header("Location: blood-donations.php");
    } else {
      $error_message =  "Error inserting data";
    }
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
 }
$conn = null;
}
?>

