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
                            <!-- <img src="public/images/you.png" alt="" style="width:45px" class="rounded-pill"> -->
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
                        <?php
                        if ($authorID == $_SESSION["user"]) {
                        ?>
                            <button type="button" class="option-btn">
                                <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                            </button>
                            <ul class="post-menu p-0">
                                <li><button class="btn post-menu-btn community-post-menu-delete text-light">Delete Post</button></li>
                                <li><button class="btn post-menu-btn community-post-menu-update text-light">Update Post</button></li>
                            </ul>
                        <?php
                        }

                        ?>
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
                    <div class="col-6 text-center">
                        <button type="button" class="w-100 meta-btn btn comment-btn">
                            <span class="comment">
                                <ion-icon name="chatbox-ellipses-outline"></ion-icon> <?= $commentCounts ?>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php
}
?>

<script>
    $(document).ready(function() {
        $(document).on("click", ".option-btn", function() {
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

    }

    .like,
    .comment,
    .unlike {
        transition: all ease 0.3s;
    }

    .like:hover,
    .comment:hover,
    .unlike:hover {
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

    .post-menu {
        display: none;
        border: var(--blue-border);
        color: var(--text-clr);
        list-style: none;
        border-radius: 20px;
    }

    .post-menu ul li button {
        color: var(--text-clr);
    }
</style>