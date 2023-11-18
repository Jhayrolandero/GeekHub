<?php
function profile_Template($username, $userBio)
{
?>

    <body>
        <div class="container-fluid" id="main">
            <input type="text" value="<?= $_SESSION["user"] ?>" id="userID" hidden>
            <div class="row">
                <div class="col-md-12 profile-container">
                    <div class="bg-img">
                        <img src="public\images\pngtree-abstract-bg-image_914283.jpg" alt="background-image">
                    </div>
                    <div class="profile">
                        <img src="public\images\you.png" class="profile-img" alt="">
                        <div class="col-12 profile-info">
                            <h4 class="profile-name"><?= $username ?></h4>
                            <p class="profile-buddies">Buddies</p>
                        </div>
                    </div>
                </div>
            </div>

            <section class="row p-3 content-section">
                <div class="col-md-4 col-sm-12 bg-secondary mt-3">
                    <div class="bio-container">
                        <textarea name="" cols="30" rows="10" class="form-control" id="bio-form"><?= $userBio ?></textarea>
                    </div>
                    <button id="add-bio-btn">Add Bio</button>
                </div>
                <div class="col-md-4 col-sm-12 timeline-section">

                </div>
            </section>
        </div>
    </body>
<?php
}
?>