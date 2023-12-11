<nav id="sidebar" class="text-end">
    <section class="shortcut-nav">
        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link fs-5" href="#home" id="you">
                    Home <ion-icon name="home-sharp"></ion-icon>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fs-5" href="#profile#<?= $_SESSION["user"] ?>" id="you">
                    Profile <ion-icon name="person-sharp"></ion-icon>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active fs-5" href="#friend">
                    Buddies <ion-icon name="people-sharp"></ion-icon>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active fs-5" href="#discover">
                    Discover <ion-icon name="compass-sharp"></ion->
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link active fs-5" href="#logout">
                    Logout <ion-icon name="log-out"></ion-icon>
                </a>
            </li>

        </ul>
    </section>
</nav>

<style>
    :root {
        --text-color: #f5fefd;
        --black-color1: #090909;
        --black-color2: #282828;
    }

    #sidebar ul li a {
        color: var(--text-color);
    }
</style>