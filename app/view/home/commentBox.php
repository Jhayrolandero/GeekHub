<?php
session_start();
function template_commentBox($username, $time, $content, $userID, $commentID, $postID)
{
?>
    <div class="col-12 .mx-auto mt-2 comment-card" style="height: 100px">
        <input type="text" value="<?= $userID ?>" class="comment-user-id" hidden>
        <input type="text" value="<?= $commentID ?>" class="comment-id" hidden>
        <input type="text" value="<?= $postID ?>" class="comment-post-id" hidden>
        <div class="row h-100">
            <div class="col-1 .mx-auto comment-icon p-0 text-center">
                <img src="public\images\you.png" alt="" style="width: 50px">
            </div>
            <div class="col-11 comment-paragraph p-0">
                <div class="row comment-info">
                    <div class="col-3"><?= $username ?></div>
                    <div class="col-6"><?= $time ?></div>
                    <div class="col-3 text-end">
                        <?php
                        if ($_SESSION["user"] === $userID) {
                        ?>
                            <button data-bs-toggle="dropdown" class="option-btn">
                                <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                            </button>
                            <ul class="dropdown-menu post-menu">
                                <li><button class="btn comment-menu-delete">Delete Comment</button></li>
                                <li><button class="btn comment-menu-update">Update Comment</button></li>
                            </ul>
                        <?php
                        }
                        ?>
                        <button type="button" class="p-0 hide-comment" data-bs-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="row">
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