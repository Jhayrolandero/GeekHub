<?php

session_start();
function template_community($groupName, $desc, $hasJoined, $memberCount, $likeCount, $postCount, $createdAt)
{
?>

    <body>
        <!-- Header -->
        <header class="community-header">
            <div class="row">
                <div class="bg-img">
                    <img src="public\images\bg-login4.webp" alt="">
                </div>
            </div>
            <div class="community-info">
                <div class="row">
                    <div class="col-2">
                        <div class="row">
                            <div class="col-12 community-profile">
                                <img src="public\images\you.png" alt="" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col-12">
                                <h4><?= $groupName ?></h4>
                            </div>
                            <div class="col-12">
                                <p>Members</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-12 mx-auto">
                                <?php
                                if ($hasJoined == 0) {
                                ?>
                                    <button class="btn join-community-btn community-btn">Join Community</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn leave-community-btn community-btn">Joined</button>
                                <?php
                                }

                                ?>
                            </div>
                            <input type="text" class="community-id" hidden>
                            <input type="text" class="user-id" value="<?= $_SESSION["user"] ?>" hidden>
                            <!-- <input type="text" value="<?= $hasJoined ?>"> -->

                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="community-post p-3">
            <div class="row">
                <div class="col-4 ">
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
                        <textarea name="" class="form-control" id="bio-form"><?= $desc ?></textarea>
                        <div class="div mt-4">
                            <p><ion-icon name="calendar" size="large"></ion-icon> <?= $createdAt ?></p>
                        </div>
                        <div class="row community-stat">
                            <div class="col-4 community-stat-container">
                                <div class="stat-value text-center">
                                    <?= $memberCount ?>
                                </div>
                                <div class="stat text-center">
                                    Members
                                </div>
                            </div>
                            <div class="col-4 community-stat-container">
                                <div class="stat-value text-center">
                                    <?= $postCount ?>
                                </div>
                                <div class="stat text-center">
                                    Posts
                                </div>
                            </div>
                            <div class="col-4 community-stat-container">
                                <div class="stat-value text-center">
                                    <?= $likeCount ?>
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