<?php
function template_friend_nav($username, $userID)
{
?>

    <li class="nav-item">
        <a href="#profile#<?= $userID ?>">
            <div class="row">
                <div class="col-md-3 p-1 col-6 text-center">
                    <img src="public\images\you.png" alt="" style="width: 50px">
                </div>
                <div class="col-md-9 col-6 p-1">
                    <p>
                        <?= $username ?>
                    </p>
                </div>
            </div>
        </a>
    </li>
<?php
}
?>