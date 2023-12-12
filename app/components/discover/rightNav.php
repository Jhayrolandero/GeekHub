<nav id="rightbar" class="w-75">
    <nav id="communitybar" class="p-4">
        <div class="row">
            <p class="p-0"><span class="fs-5 me-2">Recommended</span><span>
                    <button id="community-btn">Create +</button>
                </span></p>
        </div>
        <!-- For communities -->
        <ul class="nav flex-column" id="community-side-nav">

        </ul>
        <div class="row">
            <div class="col-12 ">
                <button id="show-all-discover" class="btn btn-primary w-100">Show All</button>
            </div>
        </div>
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
        /* max-width: 960px;
        min-width: 400px; */
        border-radius: 20px;
    }

    #rightbar ul li a {
        text-decoration: none;
        color: var(--text-color);
    }

    #communitybar #community-btn {
        background-color: transparent;
        color: var(--text-color);
        border: none;
    }

    #show-all-discover {
        background-color: transparent;
        border: none;
    }
</style>