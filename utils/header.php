<?php
?>

<style>
    .navbar{
        background-image: linear-gradient(145deg, brown, black);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav-logo{
        height: 100px;
        width: 100px; 
        position:relative
        left: ; 
    }

    .nav-options{
        display: flex;
        gap: 20px;
    }

    .nav-options > a{
        font-family: Impact, 'Arial Narrow Bold', sans-serif;
        font-size: 2em;
        color:azure;
        
        cursor: pointer;
    }
    </style>

<header class="navbar">
    <div class="nav-logo">
        <img src="images/logo.jpg" alt="logo GON!" style="height:inherit; width: inherit">
    </div>
    <nav class="nav-options">
        <a> Find Food </a>
        <a> Recipe Book </a>
        <a>  </a>
        <a> My Recipes </a>
        <a> Login </a>
    </nav>
    
</header>