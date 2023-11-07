<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/css/nav/navbar.css">
  <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark fixed-top" id="navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="#home">
        <img src="public/images/logo.jpg" alt="" style="width:40px;" class="rounded-pill">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
        <form class="d-flex">
            <input class="form-control me-2" type="text" placeholder="Search">
            <button class="btn btn-primary" type="button">Search</button>
        </form>
    </div>
    <a class="navbar-brand" href="#friend">
        <ion-icon name="person-add-outline"></ion-icon>
    </a>
    <a class="navbar-brand" href="#">
        <ion-icon name="notifications-outline"></ion-icon>
    </a>
    
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <img src="public/images/you.png" alt="" style="width:40px;" class="rounded-pill">
            </a>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#profile">profile</a></li>
              <li><a class="dropdown-item" href="#logout">logout</a></li>
          </ul>
          </li>
    </ul>
  </div>
</nav>

</body>
</html>

<!-- Black background with white text -->
