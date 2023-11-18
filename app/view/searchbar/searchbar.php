<?php

function template_search($username, $userID)
{
?>
    <li class="nav-item">
        <a href="#profile#<?= $userID ?>">
            <div class="row">
                <div class="col-4">
                    <img src="public\images\you.png" alt="" style="width: 40px">
                </div>
                <div class="col-8">
                    <p>
                        <?= $username ?>
                    </p>
                </div>
            </div>
        </a>
    </li>
<?php
}
