<?php

function show_template_recommend($results)
{

?>

    <div class="row">
        <div class="col-12">
            <div class="row">
                <h4>Suggested for you</h4>
            </div>
            <div class="row">
                <div class="col-12">

                    <!-- Render the Buddies Here -->
                    <div class="row">

                        <!-- Recommend Card -->
                        <div class="col-12 recommend-card">
                            <div class="row">
                                <!-- Carousel -->
                                <div id="demo" class="carousel slide" data-bs-ride="carousel">

                                    <!-- Indicators/dots -->
                                    <div class="carousel-indicators">
                                        <?php
                                        $numberOfButtons = count($results);
                                        for ($i = 0; $i <= $numberOfButtons; $i++) {
                                            $isActive = ($i == 0) ? 'active' : ''; // Add 'active' class to the first button
                                            echo '<button type="button" data-bs-target="#demo" data-bs-slide-to="' . $i . '" class="' . $isActive . '"></button>';
                                        }
                                        ?>
                                    </div>

                                    <!-- The slideshow/carousel -->
                                    <div class="carousel-inner text-center recommend-content">
                                        <?php
                                        // Set the first div to active
                                        $active = true;

                                        foreach ($results as $result) {

                                            if ($active) {
                                        ?>
                                                <div class="carousel-item active ">
                                                    <a href="#profile#<?= $result["user_id"] ?>">
                                                        <?php
                                                        if ($result["user_profile"]) {
                                                            $base64Image = base64_encode($result["user_profile"]);
                                                            $imageSrc = "data:image/jpeg;base64," . $base64Image;
                                                        ?>
                                                            <img src="<?= $imageSrc ?>" alt="Profile Image">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img src="public\images\you.png" alt="Profile Image">

                                                        <?php
                                                        }
                                                        ?> <div class="recommend-info text-start">
                                                            <h4><?= $result["username"] ?></h4>
                                                            <p><?= $result["user_bio"] ?></p>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php
                                                $active = false;
                                            }
                                            ?>

                                            <div class="carousel-item  ">
                                                <a href="#profile#<?= $result["user_id"] ?>">
                                                    <?php
                                                    if ($result["user_profile"]) {
                                                        $base64Image = base64_encode($result["user_profile"]);
                                                        $imageSrc = "data:image/jpeg;base64," . $base64Image;
                                                    ?>
                                                        <img src="<?= $imageSrc ?>" alt="Profile Image">
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="public\images\you.png" alt="Profile Image">

                                                    <?php
                                                    }
                                                    ?> <div class="recommend-info text-start">
                                                        <h4><?= $result["username"] ?></h4>
                                                        <p><?= $result["user_bio"] ?></p>
                                                    </div>
                                                    <div class="recommend-info text-start">
                                                        <h4><?= $result["username"] ?></h4>
                                                        <p><? isset($result["user_bio"]) ?  $result["user_bio"] : "Nothing to see." ?></p>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <!-- Left and right controls/icons -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-6"></div>
    </div>
<?php
}
