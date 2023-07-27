<style>
.navbar-scroll .nav-link,
.navbar-scroll .fa-bars,
.navbar-scroll .navar-brand {
  color: #4f4f4f;
}

.navbar-scroll .nav-link:hover {
  color: #1266f1;
}

.navbar-scroll,
.navbar-scrolled {
  background-color: rgba(0,0,0,0.8)
}

.navbar.navbar-scroll.navbar-scrolled {
  padding-top: 5px;
  padding-bottom: 5px;
}
</style>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
  include "utils/Login-modal.php";
?>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-scroll">
    <div class="container">
      <img src="utils/logo.png" height="70" alt="" loading="lazy" />
      <button class="navbar-toggler ps-0" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
        aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon d-flex justify-content-start align-items-center">
          <i class="fas fa-bars"></i>
        </span>
      </button>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto mb-2 mb-sm-0">
          <li class="nav-item p-1 white">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item p-1 white">
            <a class="nav-link" aria-current="page" href="ViewRecipes.php">All Recipes</a>
          </li>
          <li class="nav-item p-1 white">
            <a class="nav-link" aria-current="page" href="SubmitRecipe.php">Submit A Recipe</a>
          </li>
          
          <li class="nav-item dropdown p-1 white">
          <?php if(!isset($_SESSION["loggedin"])):?>
            <button class="btn btn-outline-success" data-toggle="modal" data-target="#loginModal">Login</button>
          <?php else: ?>
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span> Hi, <?php echo $_SESSION["current_user"]; ?></span></a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="Favourites.php">Favourites</a>
              <a class="dropdown-item" href="Submissions.php">My Submissions</a>
              <a class="dropdown-item" href="#" onclick="logout()">Log Out</a>
            </div>
          <?php endif ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>