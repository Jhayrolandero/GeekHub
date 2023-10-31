<?php

function template_post($name, $content){
?>
<div class="container post">
  <div class="card">
    <div class="card-header p-3" id="card-header">
        <div class="row">
            <div class="col-1">
                <img src="public/images/you.png" alt="" style="width:45px;" class="rounded-pill">
            </div>
            <div class="col-10">
                <div class="col-12 username"><?=$name?></div>
                <div class="col-12">Date</div>
            </div>
            <div class="col">
                close button
            </div>
        </div>
    </div>
    <div class="card-body" id="card-body">
        <div class="content"><?=$content?></div>
        <div>metainfo</div>
    </div> 
    <div class="card-footer" id="card-footer">
        <div class="row">
            <div class="col-4 text-center">
                <button class="w-100 meta-btn btn">
                    <ion-icon name="thumbs-up-outline"></ion-icon>
                    Like
                </button>
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
</div>
</div>

<?php
}
?>
