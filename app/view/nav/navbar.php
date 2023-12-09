<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/css/nav/navbar.css">
  <title>Document</title>
  <script src="public/js/nav/nav.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark fixed-top" id="navbar">
    <div class="container-fluid nav-header">
      <div id="left-section col-6">
        <div class="row">
          <div class="col-4">
            <a class="navbar-brand" href="#home" id="mynavbar">
              <span>GeekHub</span>
            </a>
          </div>

          <div class="searchbar-container col-8">
            <input type="text" placeholder="Search...." class="searchbar-input form-control" id="searchInput" autocomplete="off">
            <div class="searchbar-content">
              <ul id="searchResults" class="nav"></ul>
            </div>
          </div>
        </div>
      </div>
      <div id="right-section col-6">
        <a class="navbar-brand btn m-0" href="#friend">
          <ion-icon name="person-add-outline"></ion-icon>
        </a>
        <div class="dropdown dropstart text-end">
          <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" id="nav-drop-btn">
            <ion-icon name="notifications"></ion-icon> </button>
          <div class="dropdown-menu" id="notif">
            <div class="notif-header">
              <p>Notification</p>
            </div>
            <section class="notif-container">
            </section>
          </div>
        </div>

        <div class="dropdown dropstart text-end">
          <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" id="nav-drop-btn">
            <ion-icon name="apps"></ion-icon> </button>
          <div class="dropdown-menu" id="menu">
            <ul>
              <a href="#profile#<?= $_SESSION["user"] ?>">
                <li>Profile</li>
              </a>
              <a href="#logout">
                <li>Logout</li>
              </a>
            </ul>
          </div>
        </div>


      </div>
    </div>
  </nav>

</body>

</html>

<!-- Black background with white text -->