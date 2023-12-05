<?php
function template_post($name, $content, $date, $post_id, $like_count, $hasLiked, $post_image, $commentCount, $userID)
{
?>
    <form class="container post">
        <div class="card">
            <div class="card-header p-2" id="card-header">
                <div class="row">
                    <div class="col-xl-1 col-lg-2 col-md-1 col-sm-1 col-2 p-0 me-4">
                        <a href="#profile#<?= $userID ?>">
                            <img src="public/images/you.png" alt="" style="width:45px;" class="rounded-pill">
                        </a>
                    </div>
                    <div class="col-xl-7 col-lg-8 col-md-8 col-sm-10 col-8 p-0">
                        <div class="col-12 username"><?= $name ?></div>
                        <div class="col-12 date"><?= $date ?></div>
                    </div>
                    <div class="col-xl-3 col-lg-2 col-md-3 col-sm-1 col-2 p-0 option-col text-end">
                        <?php
                        if ($_SESSION["user"] === $userID) {
                        ?>
                            <button data-bs-toggle="dropdown" class="option-btn">
                                <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                            </button>
                            <ul class="dropdown-menu post-menu">
                                <li><button class="btn post-menu-delete">Delete Post</button></li>
                                <li><button class="btn post-menu-update">Update Post</button></li>
                            </ul>
                        <?php
                        }
                        ?>
                        <button type="button" class="p-0 hide-post" data-bs-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0" id="card-body">
                <div class="row content">
                    <div class="col-12 pb-2 post-content">
                        <?= $content ?>
                    </div>
                    <?php
                    if (isset($post_image)) {
                    ?>
                        <div class="col-12 text-center pb-2">
                            <img src="data:image/jpeg;base64,<?= base64_encode($post_image) ?>" class="image-container"></img>
                        </div>
                    <?php
                    }

                    ?>
                </div>
                <input name="post_id" value="<?= $post_id ?>" class="post_id" hidden></input>
                <input name="user_id" value="<?= $_SESSION["user"] ?>" class="user_id" hidden></input>
                <input name="user_id" value="<?= $userID ?>" class="creator_id" hidden></input>
            </div>
            <div class="card-footer" id="card-footer">
                <div class="row">
                    <div class="col-6 text-center">
                        <?php
                        if ($hasLiked) {
                        ?>
                            <button class="w-100 meta-btn btn unlike-btn">
                                <ion-icon name="thumbs-down"></ion-icon> Unlike (<?= $like_count ?>)
                            </button>
                        <?php
                        } else {
                        ?>
                            <button class="w-100 meta-btn btn like-btn">
                                <ion-icon name="thumbs-up"></ion-icon> like (<?= $like_count ?>)
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-6 text-center">
                        <button type="button" class="w-100 meta-btn btn comment-btn">
                            <ion-icon name="chatbox-ellipses"></ion-icon> Comment (<?= $commentCount ?>)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>

<?php
}
?>