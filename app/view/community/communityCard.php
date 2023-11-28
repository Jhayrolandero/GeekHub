<?php

session_start();
function template_community($groupName, $desc, $hasJoined, $createdAt, $groupID, $groupPic, $groupBG)
{
?>

    <body>
        <!-- Header -->
        <header class="community-header container pb-4">
            <input type="text" class="form-control" id="community-id" value="<?= $groupID ?>" hidden>
            <div class="row">
                <div class="bg-img">
                    <?php
                    if ($groupBG) {
                        $base64Image = base64_encode($groupBG);
                        $imageSrc = "data:image/jpeg;base64," . $base64Image;
                    ?>


                        <img src="<?= $imageSrc ?>" alt="Background Image">
                    <?php
                    } else {
                    ?>
                        <img src="public\images\pngtree-abstract-bg-image_914283.jpg" alt="background-image">

                    <?php
                    }


                    ?>

                    <script>
                        var profileBGSrc = '<?= $imageSrc ?>';
                    </script>
                </div>
            </div>
            <div class="community-info">
                <div class="row">
                    <div class="col-2">
                        <div class="row">
                            <?php
                            if ($groupPic) {
                                $base64Image = base64_encode($groupPic);
                                $imageSrc = "data:image/jpeg;base64," . $base64Image;
                            ?>
                                <img src="<?= $imageSrc ?>" class="community-img" alt="Profile Image">
                            <?php
                            } else {
                                $imageSrc = "public\images\you.png";

                            ?>
                                <img src="<?= $imageSrc ?>" class="community-img" alt="Profile Image">

                            <?php
                            }
                            ?>

                            <script>
                                var profileImageSrc = '<?= $imageSrc ?>';
                            </script>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="community-name" id="community-name"><?= $groupName ?></h4>
                            </div>

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-12 mx-auto text-end">
                                <?php
                                if ($hasJoined == 0) {
                                ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn join-community-btn community-btn w-100">Join Community</button>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="row">
                                        <div class="col-6 p-0">
                                            <button class="btn community-btn w-100 edit-community-btn" style="width: fit-content;"> <ion-icon name="pencil"></ion-icon> Edit</button>
                                        </div>
                                        <div class="col-6 ">
                                            <button class="btn leave-community-btn community-btn w-100"><ion-icon name="checkmark-outline"></ion-icon> Joined</button>
                                        </div>
                                    </div>
                                <?php
                                }

                                ?>
                            </div>
                            <input type="text" class="community-id" hidden>
                            <input type="text" class="user-id" value="<?= $_SESSION["user"] ?>" hidden>

                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="community-post p-3">
            <div class="row">
                <div class="col-5 ">
                    <?php
                    if ($hasJoined == 1) {
                    ?>
                        <div class="container">
                            <div class="row">
                                <button id="create-community-post">Create Post</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="row">
                        <section class="community-content-section">
                        </section>
                    </div>
                </div>
                <div class="col-3">
                    <section class="desc-container ">
                        <h4>Description</h4>
                        <textarea name="" class="form-control" id="bio-form" readonly><?= $desc ?></textarea>
                        <div class="div mt-4">
                            <p><ion-icon name="calendar" size="large"></ion-icon> <?= $createdAt ?></p>
                        </div>
                        <div class="row community-stat">
                            <div class="col-4 community-stat-container">
                                <div class="stat-value text-center" id="member-count">
                                </div>
                                <div class="stat text-center">
                                    Members
                                </div>
                            </div>
                            <div class="col-4 community-stat-container">
                                <div class="stat-value text-center" id="post-count">
                                </div>
                                <div class="stat text-center">
                                    Posts
                                </div>
                            </div>
                            <div class="col-4 community-stat-container">
                                <div class="stat-value text-center" id="like-count">
                                </div>
                                <div class="stat text-center">
                                    Likes
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            if ($hasJoined == 1) {
                            ?>
                                <div class="col-12 mt-2">
                                    <button id="create-community-post" style="width: 100%">Create Post</button>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="col-12 mt-2">
                                <?php
                                if ($hasJoined == 0) {
                                ?>
                                    <button class="btn community-btn join-community-btn" style="width: 100%">Join Community</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn community-btn leave-community-btn" style="width: 100%">Joined</button>
                                <?php
                                }

                                ?>
                            </div>
                        </div>
                    </section>

                    <section id="community-nav" class="mt-2">
                        <h4>Other Communities</h4>
                        <div id="community-side-nav"></div>
                    </section>
                </div>
            </div>
        </main>

    </body>
<?php
}
?>