<?php


function template_post($name, $content, $date, $post_id, $like_count, $hasLiked){
?>
<form class="container post">
  <div class="card">
    <div class="card-header p-3" id="card-header">
        <div class="row">
            <div class="col-1">
                <img src="public/images/you.png" alt="" style="width:45px;" class="rounded-pill">
            </div>
            <div class="col-10">
                <div class="col-12 username"><?=$name?></div>
                <div class="col-12"><?=$date?></div>
            </div>
            <div class="col-1">
                ...
            <button type="button" class="btn-close p-0" data-bs-dismiss="modal"></button>
            </div>
        </div>
    </div>
    <div class="card-body" id="card-body">
        <div class="content"><?=$content?></div>
        <div class="meta-info"><?=$like_count?> Likes</div>
        <input name="post_id" value="<?=$post_id?>" class="post_id" hidden></input>
        <input name="user_id" value="<?=$_SESSION["user"]?>" class="user_id" hidden></input>
    </div> 
    <div class="card-footer" id="card-footer">
        <div class="row">
            <div class="col-4 text-center">
                    <?php
                        if($hasLiked){
                    ?>
                    <button class="w-100 meta-btn btn unlike-btn">
                        <ion-icon name="thumbs-down-outline"></ion-icon>
                        Unlike
                        </button>
                    <?php
                        } else {
                            ?>
                    <button class="w-100 meta-btn btn like-btn">
                        <ion-icon name="thumbs-up-outline"></ion-icon>
                        like
                    </button>
                    <?php
                        }
                    ?>
            </div>
            <div class="col-4 text-center">
                <button class="w-100 meta-btn btn">
                    <ion-icon name="chatbox-outline"></ion-icon>
                    Comment
                </button>
            </div>
            <div class="col-4 text-center">
                <button class="w-100 meta-btn btn">
                    <ion-icon name="arrow-redo-outline"></ion-icon>
                    Share
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


