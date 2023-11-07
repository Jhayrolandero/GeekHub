<?php


function template_post($name, $content, $date, $post_id, $like_count, $hasLiked, $post_image){
?>
<form class="container post">
  <div class="card">
    <div class="card-header p-3" id="card-header">
        <div class="row">
            <div class="col-1">
                <a href="#profile">
                    <img src="public/images/you.png" alt="" style="width:45px;" class="rounded-pill">
                </a>
            </div>
            <div class="col-10">
                <div class="col-12 username"><?=$name?></div>
                <div class="col-12"><?=$date?></div>
            </div>
            <div class="col-1">
                <button type="button" class="btn-close p-0 hide-post" data-bs-dismiss="modal">&times;</button>
            </div>
        </div>
    </div>
    <div class="card-body p-0" id="card-body">
        <div class="row content">
            <div class="col-12 pb-2">       
                <?=$content?>
            </div>
            <?php
                if(isset($post_image)){
                    ?>
                    <div class="col-12 text-center pb-2">
                        <img src="data:image/jpeg;base64,<?= base64_encode($post_image)?>" class="image-container"></img>
                    </div>
                    <?php
                }
            
            ?>
        </div>
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
                        Unlike (<?=$like_count?>)
                        </button>
                    <?php
                        } else {
                            ?>
                    <button class="w-100 meta-btn btn like-btn">
                        <ion-icon name="thumbs-up-outline"></ion-icon>
                        like (<?=$like_count?>)
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


