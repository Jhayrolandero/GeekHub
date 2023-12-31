<?php
function template_community_post_card($groupName, $author, $content, $date, $image, $groupPostID, $authorID, $hasLiked, $groupID, $likeCount, $commentCounts, $profileImg, $isOwner = 0)
{
?>
    <form action="" class="container community-post-card">
        <div class="card">
            <!-- Post Info like user -->
            <div class="card-header p-2" id="card-header">
                <div class="row">
                    <!-- Profile -->
                    <div class="col-xxl-1 col-lg-1 col-md-1 col-sm-1 col-2 p-0">
                        <a href="#group#<?= $groupID ?>" class="mx-auto">
                            <?php
                            if ($profileImg) {
                                $base64Image = base64_encode($profileImg);
                                $imageSrc = "data:image/jpeg;base64," . $base64Image;
                            ?>
                                <img src="<?= $imageSrc ?>" class="profile-img rounded-pill" style="width:45px;" alt="Profile Image">
                            <?php
                            } else {
                            ?>
                                <img src="public\images\you.png" class="profile-img rounded-pill" style="width:45px;" alt="Profile Image">

                            <?php
                            }
                            ?>
                        </a>
                    </div>
                    <!-- Username and Community Name -->
                    <div class="col-xxl-8 col-lg-9 col-md-8 col-sm-10 col-8 p-0">
                        <div class="row">
                            <div class="col-12">
                                <a href="#group#<?= $groupID ?>" class="community-name">
                                    <?= $groupName ?>
                                </a>
                            </div>
                        </div>
                        <div class="post-author-date">
                            <div class="author-name">
                                <a href="#profile#<?= $authorID ?>">
                                    <?= $author ?>
                                </a>
                            </div>
                            <small>
                                &#8226;
                            </small>
                            <?php
                            if ($isOwner > 0) {
                            ?>
                                <div class="owner">
                                    <i class="gg-crown"></i>
                                </div>
                                <small>
                                    &#8226;
                                </small>
                            <?php
                            }
                            ?>
                            <div class=" date"><?= $date ?></div>
                        </div>
                    </div>
                    <!-- Del and Update Dropdown -->
                    <div class="col-xxl-3 col-lg-2 col-md-3 col-sm-1 col-2 p-0 option-col text-end">

                    </div>
                </div>
            </div>
            <!-- Post Content -->
            <div class="card-body p-0" id="card-body">
                <div class="row content">
                    <div class="col-12 pb-2 post-content">
                        <?= $content ?>
                    </div>
                    <?php
                    if (isset($image)) {
                    ?>
                        <div class="col-12 text-center pb-2">
                            <img src="data:image/jpeg;base64,<?= base64_encode($image) ?>" class="image-container"></img>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <input name="post_id" value="<?= $groupPostID ?>" class="community-post-id" hidden></input>
                <input name="post_id" value="<?= $groupID ?>" class="community-id" hidden></input>
                <input name="user_id" value="<?= $_SESSION["user"] ?>" class="user-id" hidden></input>
                <input name="user_id" value="<?= $authorID ?>" class="creator_id" hidden></input>

            </div>
            <!-- Like and stuffs -->
            <div class="card-footer" id="card-footer">
                <div class="row">
                    <div class="col text-center">

                        <?php
                        if ($hasLiked) {
                        ?>
                            <button type="button" class="w-100 meta-btn btn unlike-btn">
                                <span class="unlike">
                                    <ion-icon name="thumbs-down-outline"></ion-icon> <?= $likeCount ?>
                                </span>
                            </button>
                        <?php
                        } else {
                        ?>
                            <button type="button" class="w-100 meta-btn btn like-btn">
                                <span class="like">
                                    <ion-icon name="thumbs-up-outline"></ion-icon> <?= $likeCount ?>
                                </span>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col text-center">
                        <button type="button" class="w-100 meta-btn btn comment-btn">
                            <span class="comment">
                                <ion-icon name="chatbox-ellipses-outline"></ion-icon> <?= $commentCounts ?>
                            </span>
                        </button>
                    </div>
                    <?php
                    if ($authorID == $_SESSION["user"]) {
                    ?>

                        <div class="col">
                            <button class="btn post-menu-btn community-post-menu-delete text-light p-0"><span class="delete">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </span></button>
                        </div>
                        <div class="col">
                            <button class="btn post-menu-btn community-post-menu-update text-light p-0"><span class="edit">
                                    <ion-icon name="create-outline"></ion-icon>
                                </span></button>
                        </div>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </form>
<?php
}
?>