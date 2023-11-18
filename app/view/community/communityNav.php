<?php
function template_community_nav($communityName, $community_id)
{
?>
    <li>
        <a href="#group#<?= $community_id ?>">
            <div class="row">
                <div class="col-3 text-center p-1"><img src="public\images\you.png" alt="" style="width: 45px"></div>
                <div class="col-9 p-1"><?= $communityName ?></div>
            </div>
        </a>
    </li>

<?php
}
