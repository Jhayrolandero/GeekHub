<?php
function profile_Template($username, $userBio, $createdAt, $buddyCount, $postCount, $likeCount)
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
                <div class="col-md-3 col-sm-12  mt-3 bio-section ">
                    <div class="row">
                        <div class="col-6">
                            <h4>Bio</h4>
                        </div>
                        <div class="col-6 text-end">
                            <button id="add-bio-btn">Add Bio</button>
                        </div>
                    </div>
                    <div class="bio-container p-0">
                        <textarea name="" class="form-control" id="bio-form"><?= $userBio ?></textarea>
                    </div>
                    <div class="row mt-4 date-container">
                        <p>
                            <ion-icon name="calendar" size="large"></ion-icon><?= $createdAt ?>
                        </p>
                    </div>

                    <div class="row profile-stat">
                        <div class="col-4 ">
                            <div class="stat-value text-center">
                                <?= $buddyCount ?>
                            </div>
                            <div class="stat text-center">
                                Buddies
                            </div>
                        </div>
                        <div class="col-4 ">
                            <div class="stat-value text-center">
                                <?= $postCount ?>
                            </div>
                            <div class="stat text-center">
                                Posts
                            </div>
                        </div>
                        <div class="col-4 ">
                            <div class="stat-value text-center">
                                <?= $likeCount ?>
                            </div>
                            <div class="stat text-center">
                                Likes
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-5 col-sm-12 timeline-section">

                </div>
            </section>
        </div>
    </body>
<?php
}
?>