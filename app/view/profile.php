<?php
function profile_Template($username){
    ?>
    <body>
        <div class="container" id="main">
            <div class="row">
                <div class="col-md-12 profile-container">
                    <div>
                        <img src="public\images\background.jpg" alt="background-image" class="bg-img">
                    </div>
                    <div class="profile">
                        <img src="public\images\you.png" class="profile-img" alt="">
                        <div class="col-12 profile-info">
                            <h4 class="profile-name"><?=$username?></h4>
                            <p class="profile-buddies">Buddies</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bg-success">Hi</div>
                <div class="col-md-6 bg-light">World</div>
                <button class="click">Check</button>
            </div>
        </div>
    </body>    
    <?php
}
?>


