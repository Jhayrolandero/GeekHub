<?php
function template_community_post_card($groupName, $author, $content, $date, $image, $groupPostID, $authorID, $hasLiked, $groupID, $likeCount, $commentCounts)
{
?>
    <form action="" class="container community-post-card">
        <div class="card">
            <!-- Post Info like user -->
            <div class="card-header p-3" id="card-header">
                <div class="row">
                    <!-- Profile -->
                    <div class="col-xl-2 col-lg-2 col-md-1 col-sm-1 col-2">
                        <a href="#group#<?= $groupID ?>" class="mx-auto">
                            <img src="public/images/you.png" alt="" style="width:45px" class="rounded-pill">
                        </a>
                    </div>
                    <!-- Username and Community Name -->
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-10 col-8 p-0">
                        <div class="row">
                            <div class="col-12">
                                <a href="#group#<?= $groupID ?>" class="community-name">
                                    <?= $groupName ?>
                                </a>
                            </div>
                        </div>
                        <div class="post-author-date">
                            <div class="author-name">
                                <?= $author ?>
                            </div>
                            <small>
                                &#8226;
                            </small>
                            <div class=" date"><?= $date ?></div>
                        </div>
                    </div>
                    <!-- Del and Update Dropdown -->
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-1 col-2 option-col text-end">
                        <button data-bs-toggle="dropdown" class="option-btn">
                            <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                        </button>
                        <ul class="dropdown-menu post-menu">
                            <li><button class="btn post-menu-delete">Delete Post</button></li>
                            <li><button class="btn post-menu-update">Update Post</button></li>
                        </ul>
                        <button type="button" class="p-0 hide-post" data-bs-dismiss="modal">&times;</button>
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
                    <div class="col-6 text-center">

                        <?php
                        if ($hasLiked) {
                        ?>
                            <button type="button" class="w-100 meta-btn btn unlike-btn">
                                <ion-icon name="thumbs-down"></ion-icon> Unlike (<?= $likeCount ?>)
                            </button>
                        <?php
                        } else {
                        ?>
                            <button type="button" class="w-100 meta-btn btn like-btn">
                                <ion-icon name="thumbs-up"></ion-icon> like (<?= $likeCount ?>)
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-6 text-center">
                        <button type="button" class="w-100 meta-btn btn comment-btn">
                            <ion-icon name="chatbox-ellipses"></ion-icon> Comment (<?= $commentCounts ?>)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php
}
?>