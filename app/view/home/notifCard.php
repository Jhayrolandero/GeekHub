<?php
function template_notif($username, $date, $content, $profileImg, $userID)
{
?>
    <div class="notif-card p-3">
        <div class="row">
            <div class="col-2 notif-user-icon">
                <a href="#profile#<?= $userID ?>">
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
                </a>
            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col-12 notif-content"><span><?= $username ?></span> <?= $content ?></div>
                </div>
                <div class="row">
                    <div class="col-12 notif-date">
                        <?= $date ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}

function template_empty()
{
?>
    <div class="notif-card">
        <div class="row">
            <div class="col-12">
                <h4 class="text-center">No Notification Yet</h4>
                <div id="empty-svg">
                    <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 11C7.06692 11.6303 7.75638 12 8.5 12C9.24362 12 9.93308 11.6303 10.5 11" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M13.5 11C14.0669 11.6303 14.7564 12 15.5 12C16.2436 12 16.9331 11.6303 17.5 11" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M13 16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16C11 15.4477 11.4477 15 12 15C12.5523 15 13 15.4477 13 16Z" fill="#fff" />
                        <path d="M17 4L20.4641 2L19 7.4641L22.4641 5.4641" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.0479 5.5L15.7799 6.5L13.0479 7.23205L14.7799 8.23205" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 12C22 17.5228 17.5228 22 12 22C10.1786 22 8.47087 21.513 7 20.6622M12 2C6.47715 2 2 6.47715 2 12C2 13.8214 2.48697 15.5291 3.33782 17" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                    </svg>

                </div>
            </div>
        </div>
    </div>
<?php
}
?>