<?php
session_start();
function template_commentBox($username, $time, $content, $userID, $commentID, $postID, $profileImg)
{
?>
    <div class="row .mx-auto mt-2 comment-card" style="height: 100px; width: 100%;">
        <input type="text" value="<?= $userID ?>" class="comment-user-id" hidden>
        <input type="text" value="<?= $commentID ?>" class="comment-id" hidden>
        <input type="text" value="<?= $postID ?>" class="comment-post-id" hidden>
        <div class="row h-100 mx-auto">
            <div class="col-1 .mx-auto comment-icon p-0 text-center">
                <a href="#profile#<?= $userID ?>">
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
                <!-- <img src="public\images\you.png" alt="" style="width: 50px"> -->
            </div>
            <div class="col-11 comment-paragraph p-0 ps-3">
                <div class="row comment-info">
                    <div class="comment-author-date col-9">
                        <div class="author-name">
                            <a href="#profile#<?= $userID ?>">
                                <?= $username ?>
                            </a>
                        </div>
                        <small>
                            &#8226;
                        </small>
                        <div class=" date"><?= $time ?></div>
                    </div>
                    <div class="col-3 p-0 text-end">
                        <?php
                        if ($_SESSION["user"] === $userID) {
                        ?>
                            <button data-bs-toggle="dropdown" class="option-btn">
                                <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                            </button>
                            <ul class="dropdown-menu post-menu">
                                <li><button class="btn comment-menu-delete">Delete Comment</button></li>
                            </ul>
                        <?php
                        }
                        ?>
                        <button type="button" class="p-0 hide-comment" data-bs-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>