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
            <a class="nav-link" aria-current="page" href="ViewRecipes.php">Recipes</a>
          </li>
          <li class="nav-item p-1 white">
            <a class="nav-link" aria-current="page" href="#adoptions">Submit A Recipe</a>
          </li>
          <li class="nav-item p-1 white">
            <a class="nav-link" aria-current="page" href="#foundation">Submit An Ingredient</a>
          </li>
          <button class="btn btn-outline-success">Login</button>
        </ul>
      </div>
    </div>
  </nav>
</header>