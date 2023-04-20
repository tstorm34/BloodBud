
<?php
   require "uservalidity.php";
?>
<div>
  <link href="./stock-levels.css" rel="stylesheet" />
  <div class="stock-levels-container">
    <header data-thq="thq-navbar" class="stock-levels-navbar-interactive">
      <img
        alt="image"
        src="https://student.csc.liv.ac.uk/~sgtabdls/blood-bud-logo.png"
        class="stock-levels-image"
      />
      <div
        data-thq="thq-navbar-nav"
        data-role="Nav"
        class="stock-levels-desktop-menu"
      >
        <nav
          data-thq="thq-navbar-nav-links"
          data-role="Nav"
          class="stock-levels-nav"
        >
          <a href="stock-levels.php" class="stock-levels-navlink">
            Stock Levels
          </a>
          <a href="blood-expiration.php" class="stock-levels-navlink1">
            Blood Expirations
          </a>
          <a href="blood-donations.php" class="stock-levels-navlink2">
            Blood Donations
          </a>
        </nav>
      </div>
      <div data-thq="thq-navbar-btn-group" class="blood-expiration-btn-group">
      <form action="logout.php" method="post">
            <button type="submit" class="login-button button">Logout</button>
        </form>
      </div>
    </header>

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

        try {
            // Create a new PDO instance and set error mode to exceptions
            $conn = new PDO($dsn, $username, $password,$opt);

            // Prepare SQL statement to retrieve user data from database
            $stmt = $conn->prepare("SELECT blood_type, sum(donation_amount) as amount FROM Donations GROUP BY blood_type;");



            // Execute SQL statement and check if user data exists
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                // Fetch the results as an associative array
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo"<style>table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  font-family: Arial, sans-serif;
  font-size: 14px;
  color: #333;
  margin-bottom: 20px;
}

th, td {
  text-align: left;
  padding: 10px;
  border-bottom: 1px solid #ccc;
}

th {
  background-color: #f5f5f5;
  font-weight: bold;
  color: #555;
  text-transform: uppercase;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

tr:hover {
  background-color: #ddd;
}

td:first-child {
  background-color: #eee;
}

td {
  color: #444;
}

a {
  color: #666;
}

a:hover {
  color: #333;
  text-decoration: underline;
}
</style>";
                echo "<table><tr class = "."top"."><td>Blood Type</td><td>Quantity</td><tr>";
                // Loop through the results and output each row
                foreach ($results as $row) {
                    echo "<tr><td class="."top".">" . $row["blood_type"]."</td><td>" . $row["amount"] . "</td><tr>";
                }
                echo "</table>";
            } else {
                echo "No results found.";
            }

          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
         $conn = null;
        ?>
</div>




