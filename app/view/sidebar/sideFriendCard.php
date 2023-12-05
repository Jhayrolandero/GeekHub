<?php
function template_friend_nav($username, $userID, $profileImg)
{
?>

    <li class="nav-item">
        <a href="#profile#<?= $userID ?>">
            <div class="row">
                <div class="col-lg-2 col-md-3 p-1  text-center">
                    <?php
                    if ($profileImg) {
                        $base64Image = base64_encode($profileImg);
                        $imageSrc = "data:image/jpeg;base64," . $base64Image;
                    ?>
                        <img src="<?= $imageSrc ?>" class="profile-img rounded-pill" style="width: 100%; max-width: 42px" alt="Profile Image">
                    <?php
                    } else {
                    ?>
                        <img src="public\images\you.png" class="profile-img rounded-pill" style="width: 100%; max-width: 42px" alt="Profile Image">

                    <?php
                    }
                    ?>
                    <!-- <img src="public\images\you.png" alt="" style="width: 100%; max-width: 42px"> -->
                </div>
                <div class="col-lg-10 col-md-9 p-1 buddy-name-container">
                    <p class="buddy-name">
                        <?= $username ?>
                    </p>
                </div>
            </div>
        </a>
    </li>
<?php
}
?>