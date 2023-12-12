<?php
function template_top_members($username, $userID, $profilePic, $postCount)
{
?>
    <li class="nav-item">
        <a href="#profile#<?= $userID ?>">
            <div class="row p-2">

                <div class="row mb-2 p-0">
                    <div class="col-lg-2 col-md-3 p-1  text-center p-0">
                        <?php
                        if ($profilePic) {
                            $base64Image = base64_encode($profilePic);
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
                    <div class="col-lg-10 col-md-9 p-1 community-name-container d-flex align-items-center p-0">
                        <div class="row w-100">

                            <div class="col-6">
                                <small>
                                    <?= $username ?>
                                </small>
                            </div>
                            <div class="col-6 text-end">
                                <small>
                                    <?= $postCount * 100 ?> Points
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </a>
    </li>

<?php
}
