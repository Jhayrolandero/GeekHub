<?php
function profile_Template($username, $userBio, $createdAt, $buddyCount, $postCount, $likeCount, $userID, $profileImg, $profileBG)
{
?>

    <body>

        <header class="container profile-header pb-5">
            <input type="text" value="<?= $_SESSION["user"] ?>" id="userID" hidden>

            <div class="row">
                <div class="bg-img">
                    <?php
                    if ($profileBG) {
                        $base64Image = base64_encode($profileBG);
                        $imageSrc = "data:image/jpeg;base64," . $base64Image;
                    ?>
                        <img src="<?= $imageSrc ?>" alt="Background Image">
                    <?php
                    } else {
                    ?>
                        <img src="public\images\pngtree-abstract-bg-image_914283.jpg" alt="background-image">
                        <!-- <img src="public\images\you.png" alt="Profile Image"> -->

                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="profile-info">
                <div class="row">
                    <div class="col-2">
                        <div class="row">
                            <?php
                            if ($profileImg) {
                                $base64Image = base64_encode($profileImg);
                                $imageSrc = "data:image/jpeg;base64," . $base64Image;
                            ?>
                                <img src="<?= $imageSrc ?>" class="profile-img" alt="Profile Image">
                            <?php
                            } else {
                            ?>
                                <img src="public\images\you.png" class="profile-img" alt="Profile Image">

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-7 profile-info-val">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="profile-name" id="profileName"><?= $username ?></h4>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($userID == $_SESSION["user"]) {
                    ?>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-12 text-end pl">
                                    <button class="btn  edit-profile-btn" style="width: fit-content;"> <ion-icon name="pencil"></ion-icon> Edit</button>
                                </div>
                            </div>
                        </div>

                    <?php
                    }

                    ?>

                </div>
            </div>
        </header>

        <!-- <div class="container-fluid" id="main">
            <input type="text" value="<?= $_SESSION["user"] ?>" id="userID" hidden>
            <div class="row">
                <div class="col-md-12 profile-container">
                    <div class="bg-img">
                        <img src="public\images\pngtree-abstract-bg-image_914283.jpg" alt="background-image">
                    </div>
                    <div class="profile">
                        <img src="public\images\zed.jpg" class="profile-img" alt="">
                        <div class="col-12 profile-info">
                            <h4 class="profile-name"><?= $username ?></h4>
                            <p class="profile-buddies">Buddies</p>
                        </div>
                    </div>
                </div>
            </div> -->

        <main class="row p-3 content-section  mx-auto">
            <div class="col-md-3 col-sm-12  mt-3 bio-section ">
                <div class="row">
                    <div class="col-6">
                        <h4>Bio</h4>
                    </div>
                    <?php
                    if ($_SESSION["user"] == $userID) {
                    ?>
                        <div class="col-6 text-end">
                            <button id="add-bio-btn">Add Bio</button>
                        </div>

                    <?php
                    }

                    ?>
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
            <div class="col-md-5 col-sm-12 ms-2">
                <?php
                if ($_SESSION["user"] == $userID) {
                ?>
                    <div class="row mt-3">
                        <button id="open-post-btn"> Create post </button>
                    </div>

                <?php
                }

                ?>
                <div class="row timeline-section">


                </div>
            </div>
        </main>
        </div>

    </body>
<?php
}
?>