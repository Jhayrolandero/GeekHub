<?php

function template_discover($groupName, $desc, $hasJoined, $createdAt, $groupID, $groupPic, $groupBG, $isOwner)
{
?>
    <div class="discover-card community-header container pb-4 mb-3">
        <input type="text" class="form-control" id="community-id" value="<?= $groupID ?>" hidden>
        <div class="row">
            <div class="bg-img">
                <?php
                if ($groupBG) {
                    $base64Image = base64_encode($groupBG);
                    $imageSrc = "data:image/jpeg;base64," . $base64Image;
                ?>
                    <img src="<?= $imageSrc ?>" alt="Background Image">
                <?php
                } else {
                ?>
                    <img src="public\images\pngtree-abstract-bg-image_914283.jpg" alt="background-image">

                <?php
                }
                ?>
                <script>
                </script>
            </div>
        </div>
        <div class="community-info">
            <div class="row">
                <div class="col-xxl-2 col-lg-3">
                    <div class="row">
                        <?php
                        if ($groupPic) {
                            $base64Image = base64_encode($groupPic);
                            $imageSrc = "data:image/jpeg;base64," . $base64Image;
                        ?>
                            <img src="<?= $imageSrc ?>" class="community-img" alt="Profile Image">
                        <?php
                        } else {
                            $imageSrc = "public\images\you.png";

                        ?>
                            <img src="<?= $imageSrc ?>" class="community-img" alt="Profile Image">

                        <?php
                        }
                        ?>
                        <script>
                            var profileImageSrc = '<?= $imageSrc ?>';
                        </script>
                    </div>
                </div>
                <div class="col-xxl-7 col-lg-9">
                    <div class="row">
                        <div class="col-12">
                            <a href="#group#<?= $groupID ?>">
                                <h4 class="community-name" id="community-name"><?= $groupName ?></h4>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <small>
                                <?= $desc ?>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-12">
                    <div class="row">
                        <div class="col-12 mx-auto text-end">
                            <?php
                            if ($hasJoined == 0) {
                            ?>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn join-community-btn community-btn w-100">Join Community</button>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="row">
                                    <div class="col-12 ">
                                        <button class="btn leave-community-btn community-btn w-100"><ion-icon name="checkmark-outline"></ion-icon> Joined</button>
                                    </div>
                                </div>
                            <?php
                            }

                            ?>
                        </div>
                        <input type="text" class="community-id" hidden>
                        <input type="text" class="user-id" value="<?= $_SESSION["user"] ?>" hidden>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}

?>