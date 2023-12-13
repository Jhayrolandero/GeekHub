<?php
function template_commentBox($username, $time, $content, $userID, $commentID, $postID, $profileImg)
{
?>
    <div class="col-12 .mx-auto mt-2 comment-card" style="height: 100px">
        <input type="text" value="<?= $userID ?>" class="comment-user-id" hidden>
        <input type="text" value="<?= $commentID ?>" class="comment-id" hidden>
        <input type="text" value="<?= $postID ?>" class="comment-post-id" hidden>
        <div class="row h-100">
            <div class="col-1 .mx-auto comment-icon p-0">
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
            </div>
            <div class="col-11 comment-paragraph p-0">
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
                    <div class="col-3 text-end">
                        <?php
                        if ($_SESSION["user"] === $userID) {
                        ?>
                            <button class="btn comment-menu-delete"><span class="delete ">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </span></button>
                        <?php
                        }
                        ?>
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