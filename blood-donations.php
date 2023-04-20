<?php
     require_once "uservalidity.php";
?>
<div>
  <link href="./blood-donations.css" rel="stylesheet" />
  <div class="blood-donations-container">
    <header data-thq="thq-navbar" class="blood-donations-navbar-interactive">
      <img
        alt="image"
        src="https://student.csc.liv.ac.uk/~sgtabdls/blood-bud-logo.png"
        class="blood-donations-image"
      />
      <div
        data-thq="thq-navbar-nav"
        data-role="Nav"
        class="blood-donations-desktop-menu"
      >
        <nav
          data-thq="thq-navbar-nav-links"
          data-role="Nav"
          class="blood-donations-nav"
        >
          <a href="stock-levels.php" class="blood-donations-navlink">
            Stock Levels
          </a>
          <a href="blood-expiration.php" class="blood-donations-navlink1">
            Blood Expirations
          </a>
          <a href="blood-donations.php" class="blood-donations-navlink2">
            Blood Donations
          </a>
        </nav>
      </div>
      <div data-thq="thq-navbar-btn-group" class="blood-donations-btn-group">
        <form action="logout.php" method="post">
            <button type="submit" class="login-button button">Logout</button>
        </form>
      </div>
    </header>
    <span class="blood-donations-text05">Submit new donation:</span>
    <span class="blood-donations-text06">Blood Type</span>
    <span class="blood-donations-text07">Name</span>
    <span class="blood-donations-text08">Email</span>
    <span class="blood-donations-text09">Phone</span>
    <span class="blood-donations-text10">Date</span>
    <span class="blood-donations-text11">Amount of Units</span>
    <form action = "add-donation.php" method ="post">
    <input type="email" required id="email" name="email"  class="blood-donations-textinput input" />
    <input type="number" required id="phoneNumber" name="phoneNumber"  class="blood-donations-textinput1 input" />
    <input
      type="date"
      id="expiryDate"
      required
      name = "expiryDate"
      value="<?= date('Y-m-d') ?>"
      class="blood-donations-textinput2 input"
    />

    <input
      type="number"
      id="Amountofunits"
      required
      name="Amountofunits"
      class="blood-donations-textinput3 input"
    />
    <select type="text" id="blood_type" name="blood_type" class="blood-donations-textinput4 input" >
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
    </select>
    <input
      type="text"
      id="name"
      required
      name = "name"
      placeholder="Full name"
      class="blood-donations-textinput5 input"
    />
    <button type="submit" class="blood-donations-button button">Add Donation</button>
</form>
  </div>
  <div>
  <header>
    <p>


</p>

  </header>
</div>
</div>







