<?php
function template_post($name, $content, $date, $post_id, $like_count, $hasLiked, $post_image, $commentCount, $userID, $profileImg)
{
?>
    <form class="container post">
        <div class="card">
            <div class="card-header p-2" id="card-header">
                <div class="row">
                    <div class="col-xxl-1 col-lg-1 col-md-2 col-sm-1 col-2 p-0 ">
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
                    <div class="col-xxl-11 col-lg-11 col-md-7 col-sm-10 col-8 p-0">
                        <div class="col-12 username"><?= $name ?></div>
                        <div class="col-12 date"><?= $date ?></div>
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
                    <div class="col text-center">
                        <?php
                        if ($hasLiked) {
                        ?>
                            <button class="w-100 meta-btn  unlike-btn">
                                <span class="unlike">
                                    <ion-icon name="thumbs-down-outline"></ion-icon> <?= $like_count ?>
                                </span>
                            </button>
                        <?php
                        } else {
                        ?>
                            <button class="w-100 meta-btn like-btn">
                                <span class="like">
                                    <ion-icon name="thumbs-up-outline"></ion-icon> <?= $like_count ?>
                                </span>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col text-center">
                        <button type="button" class="w-100 meta-btn  comment-btn">
                            <span class="comment">
                                <ion-icon name="chatbox-ellipses-outline"></ion-icon> <?= $commentCount ?>
                            </span>
                        </button>
                    </div>
                    <?php
                    if ($_SESSION["user"] === $userID) {
                    ?>
                        <div class="col">
                            <button class="btn p-0 post-menu-delete text-light"><span class="delete">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </span></button>
                        </div>
                        <div class="col">
                            <button class="btn p-0 post-menu-update text-light"><span class="edit">
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
    </div>

<?php
}
?>

<script>
    $(document).ready(function() {
        $(".post").on("click", ".option-btn", function() {
            $(this).siblings(".post-menu").toggle();
        });
    });
</script>


<style>
    :root {
        --dark-bg: #090909;
        --black-clr: rgb(22, 22, 22);
        --text-clr: #ffffff;
        --border: rgba(220, 220, 220, 0.5) solid 1px;
        --blue-color: #0ba4eb;
        --blue-border: var(--blue-color) solid 1px;
        --red-color: #f51919;
        --red-border: var(--red-color) solid 1px;
        --blue-bg: rgba(29, 161, 242, 0.2);
        --blue-txt: rgb(29, 161, 242);
        --green-bg: rgba(37, 211, 102, 0.2);
        --green-txt: rgb(37, 211, 102);
        --red-bg: rgba(255, 0, 0, 0.2);
        --red-txt: rgb(255, 0, 0);
        --yellow-bg: rgba(255, 252, 0, 0.2);
        --yellow-text: rgb(255, 252, 0);

    }

    .like,
    .comment,
    .unlike,
    .delete,
    .edit {
        transition: all ease 0.3s;
    }

    .like:hover,
    .comment:hover,
    .unlike:hover,
    .delete:hover,
    .edit:hover {
        padding: 0.3em;
        border-radius: 50%;
    }

    .like:hover {
        background-color: var(--blue-bg);
        color: var(--blue-txt);
    }

    .comment:hover {
        background-color: var(--green-bg);
        color: var(--green-txt);
    }

    .unlike:hover {
        background-color: var(--red-bg);
        color: var(--red-txt);
    }

    .delete:hover {
        background-color: var(--red-bg);
        color: var(--red-txt);
    }

    .edit:hover {
        background-color: var(--yellow-bg);
        color: var(--yellow-txt);
    }

    .post-menu {
        border: var(--blue-border);
        color: var(--text-clr);
        list-style: none;
        border-radius: 20px;
    }

    .post-menu ul li button {
        color: var(--text-clr);
    }

    .options {
        display: flex;
    }
</style>