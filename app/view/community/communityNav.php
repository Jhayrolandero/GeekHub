<?php
function template_community_nav($communityName, $community_id, $groupPic)
{
?>
    <li class="nav-item">
        <a href="#group#<?= $community_id ?>">
            <div class="row">

                <div class="row mb-2">
                    <div class="col-lg-2 col-md-3 p-1  text-center p-0">
                        <?php
                        if ($groupPic) {
                            $base64Image = base64_encode($groupPic);
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
                    </div>
                    <div class="col-lg-10 col-md-9 p-1 community-name-container d-flex align-items-center p-0">
                        <small>
                            <?= $communityName ?>
                        </small>
                    </div>
                </div>

            </div>
        </a>
    </li>

<?php
}
