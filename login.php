<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: blood-donations.php');
    exit;
}

$error = '';
if (isset($_GET['error'])) {
    $error = 'Invalid username or password. Please try again.';
}

?>

<div>
  <link href="./login.css" rel="stylesheet" />
  <div class="login-container">
  <?php if (!empty($error)): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>
    <form action = "login_process.php" method = "post">
    <input
      type="text"
      name="username"
      required
      placeholder=" "
      class="login-textinput input"
    />
    <input
      type="password"
      name="password"
      required
      placeholder=" "
      class="login-textinput1 input"
    />
    <span class="login-text">Please sign in to continue ahead</span>
    <span class="login-text1">Username:</span>
    <span class="login-text2">Password:</span>
    <button type="submit" class="login-button button">LOGIN</button>
    </form>

    <img
      alt="image"
      src="https://student.csc.liv.ac.uk/~sgtabdls/blood-bud-logo.png"
      class="login-image"
    />
  </div>
</div>


