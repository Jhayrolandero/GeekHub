<?php

session_start();
function template_community($groupName, $desc, $hasJoined)
{
?>

    <body>
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
                                    <button class="btn btn-secondary join-community-btn">Join Community</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-secondary leave-community-btn">Joined</button>
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
                        <div class="row">
                            <button id="create-community-post">Create Post</button>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="row">
                        <section class="content-section bg-success">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, inventore perferendis. At adipisci omnis rerum. Blanditiis, quibusdam eaque repellat, cupiditate dicta delectus error enim dolor labore velit quo odit necessitatibus aliquid illo ipsa nulla illum molestias! Harum sequi iure non!
                        </section>
                    </div>
                </div>
                <div class="col-4">
                    <section class="desc-container bg-primary">
                        <textarea name="" cols="30" rows="10" class="form-control" id="bio-form"><?= $desc ?></textarea>
                    </section>
                </div>
            </div>
        </main>

    </body>
<?php
}
?>