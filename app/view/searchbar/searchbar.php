<?php

function template_search($username, $link, $profileImg)
{
?>
    <li class="nav-item">
        <a href="<?= $link ?>">
            <div class="row">
                <div class="col-4 p-0 text-center">
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
                </div>
                <div class="col-8 p-0 d-flex align-items-center">
                    <small class="result-name">
                        <?= $username ?>
                    </small>
                </div>
            </div>
        </a>
    </li>
<?php
}
