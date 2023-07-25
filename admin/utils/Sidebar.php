<style>
    .sidebar{
        min-height: 100vh;
        overflow-y: hidden;
    }
    .nav-item{
        margin: 10px;
        border: 1px lightgrey solid;
        border-radius: 10px;
        overflow: hidden;
        font-size: 1.2rem;
    }
    .nav-link{
        color: white;
    }
    .nav-link:hover{
        background-color: lightgrey;
        color: black;
    }

</style>
<nav class="col-md-2 d-none bg-dark d-md-block pt-3 sidebar">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="Dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Recipes.php">Recipes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Ingredients.php">Ingredients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Proposals.php">Proposals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Users.php">Users</a>
            </li>
        </ul>
    </div>
</nav>