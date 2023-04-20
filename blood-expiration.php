<?php
   require "uservalidity.php";
?>
<div>
  <link href="./blood-expiration.css" rel="stylesheet" />
  <div class="blood-expiration-container">
    <header data-thq="thq-navbar" class="blood-expiration-navbar-interactive">
      <div class="blood-expiration-container1">
        <img
          alt="image"
          src="https://student.csc.liv.ac.uk/~sgtabdls/blood-bud-logo.png"
          class="blood-expiration-image"
        />
      </div>
      <div
        data-thq="thq-navbar-nav"
        data-role="Nav"
        class="blood-expiration-desktop-menu"
      >
        <nav
          data-thq="thq-navbar-nav-links"
          data-role="Nav"
          class="blood-expiration-nav"
        >
          <a href="stock-levels.php" class="blood-expiration-navlink">
            Stock Levels
          </a>
          <a href="blood-expiration.php" class="blood-expiration-navlink1">
            Blood Expirations
          </a>
          <a href="blood-donations.php" class="blood-expiration-navlink2">
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

    <span class="blood-expiration-text07">
      Search for general unit expirations by time frame
    </span>
        <form action="get-expired-blood.php" method="post">
      <input type="date" name="expirationDate" value=<?= date('Y-m-d') ?> class="blood-expiration-select"/>
      <button type="submit" class="blood-expiration-button button">Search</button>
    </form>

  </div>
</div>





