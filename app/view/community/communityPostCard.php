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
                    <div class="col-xxl-1 col-lg-2 col-md-1 col-sm-1 col-2 p-0">
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
                            <!-- <img src="public/images/you.png" alt="" style="width:45px" class="rounded-pill"> -->
                        </a>
                    </div>
                    <!-- Username and Community Name -->
                    <div class="col-xxl-8 col-lg-8 col-md-8 col-sm-10 col-8 p-0">
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
                        <?php
                        if ($authorID == $_SESSION["user"]) {
                        ?>
                            <button data-bs-toggle="dropdown" class="option-btn">
                                <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                            </button>
                            <ul class="dropdown-menu post-menu">
                                <li><button class="btn post-menu-btn community-post-menu-delete">Delete Post</button></li>
                                <li><button class="btn post-menu-btn community-post-menu-update">Update Post</button></li>
                            </ul>
                        <?php
                        }

                        ?>

                        <button type="button" class="p-0 hide-post" data-bs-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
            <!-- Post Content -->
            <div class="card-body p-0" id="card-body">
                <div class="row content">
                    <div class="col-xxl-10 col-lg-8 p-1 mx-auto">
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
                </div>
                <input name="post_id" value="<?= $groupPostID ?>" class="community-post-id" hidden></input>
                <input name="post_id" value="<?= $groupID ?>" class="community-id" hidden></input>
                <input name="user_id" value="<?= $_SESSION["user"] ?>" class="user-id" hidden></input>
                <input name="user_id" value="<?= $authorID ?>" class="creator_id" hidden></input>

            </div>
            <!-- Like and stuffs -->
            <div class="card-footer" id="card-footer">
                <div class="row">
                    <div class="col-6 text-center">

                        <?php
                        if ($hasLiked) {
                        ?>
                            <button type="button" class="w-100 meta-btn btn unlike-btn">
                                <ion-icon name="thumbs-down-outline"></ion-icon> <?= $likeCount ?>
                            </button>
                        <?php
                        } else {
                        ?>
                            <button type="button" class="w-100 meta-btn btn like-btn">
                                <ion-icon name="thumbs-up-outline"></ion-icon> <?= $likeCount ?>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-6 text-center">
                        <button type="button" class="w-100 meta-btn btn comment-btn">
                            <ion-icon name="chatbox-ellipses-outline"></ion-icon> <?= $commentCounts ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php
}
?>