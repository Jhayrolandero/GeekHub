<?php
function template_community_nav($communityName, $community_id)
{
?>
    <li class="nav-item">
        <a href="#group#<?= $community_id ?>">
            <div class="row">
                <div class="col-md-3 text-center p-1"><img src="public\images\you.png" alt="" style="width: 100%; max-width: 42px"></div>
                <div class="col-md-9 p-1 community-name-container">
                    <p class="community-name"><?= $communityName ?></p>
                </div>
            </div>
        </a>
    </li>

<?php
}
