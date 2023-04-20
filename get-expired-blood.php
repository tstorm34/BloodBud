
<?php

// Set database credentials
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

// Define inputted expiration date
$expiration_date = $_POST['expirationDate'];

try {
    // Create a new PDO connection
    $conn = new PDO($dsn, $username, $password,$opt);

    // Prepare the SQL query
    $sql = "SELECT * FROM Donations WHERE expiry_date <= :expiration_date ORDER BY expiry_date asc";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':expiration_date', $expiration_date);

    // Execute the query
    $stmt->execute();

    // Check if any rows were returned
    if ($stmt->rowCount() > 0) {
        // Fetch the results as an associative array
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    .top{
        background-color: #b1c7ff;
        }
    th, td {
      text-align: left;
      font-family: Arial, Helvetica, sans-serif;
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #ADD8E6;
      font-weight: bold;
    }
  </style>";
        echo "<table><tr class = "."top"."><td>Donation ID</td><td>First Name</td><td>Last Name</td><td>Email</td><td>Blood Type</td><td>Quantity</td><td>Expiration Date</td><tr>";
        // Loop through the results and output each row
        foreach ($results as $row) {
            echo "<tr><td class="."top".">" . $row["donations_id"] . "</td><td>" . $row["patient_firstname"] . "</td><td>" . $row["patient_surname"] . "</td><td>" .$row["patient_email"] .  "</td><td>". $row["blood_type"] . "</td><td>" . $row["donation_amount"]
."</td><td>" . $row["expiry_date"] . "</td><tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
}
catch(PDOException $e) {
    // Handle any errors that occurred during the database connection or query
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;

?>
