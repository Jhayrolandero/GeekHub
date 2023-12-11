<nav id="rightbar">
    <nav id="friendbar" class="w-75 p-3 mb-3">
        <p><span class="fs-3 me-5">Buddies</span><span> <a href="#friend">See all</a></span></p>

        <!-- Render friend side nav -->
        <ul class="nav flex-column" id="friend-side-nav"></ul>
    </nav>
    <nav id="communitybar" class="w-75 p-3">
        <p><span class="fs-3">Communities</span></p>
        <!-- For communities -->
        <ul class="nav flex-column" id="community-side-nav">

        </ul>
    </nav>
</nav>

<style>
    :root {
        --text-color: #f5fefd;
        --black-color1: #090909;
        --black-color2: #282828;
    }

    #friendbar,
    #communitybar {
        background-color: rgb(20, 23, 26);
        max-width: 960px;
        min-width: 400px;
        border-radius: 20px;
    }

    #rightbar ul li a {
        text-decoration: none;
        color: var(--text-color);
    }
</style>