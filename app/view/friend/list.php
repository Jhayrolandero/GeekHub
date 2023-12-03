<?php
function show_AcceptedList($username, $friendID, $profile, $bio)
{
?>
  <form class="col-xxl-3 col-lg-4 col-md-3 col-sm-6 col-12 friend-card mb-4">
    <div class="card bg-dark text-white">
      <div class="row ">
        <?php
        if ($profile) {
          $base64Image = base64_encode($profile);
          $imageSrc = "data:image/jpeg;base64," . $base64Image;
        ?>
          <img src="<?= $imageSrc ?>" class="card-img-top" alt="Background Image">
        <?php
        } else {
        ?>
          <img src="public\images\you.png" class="card-img-top" alt="background-image">
        <?php
        }
        ?>
      </div>
      <div class="card-body">
        <input type="text" value="<?= $friendID ?>" class="friend_id" hidden>
        <input type="text" value="<?= $_SESSION["user"] ?>" class="user_id" hidden>
        <h4 class="card-title"><?= $username ?></h4>
        <p class="card-text "><?= $bio ?></p>

        <a href="#profile#<?= $friendID ?>" class="btn btn-primary col-5">
          <ion-icon name="person-outline"></ion-icon>
          Profile
        </a>
        <button class="btn btn-primary col-6 unfriend-btn">
          <ion-icon name="person-add-outline"></ion-icon>
          Unfriend
        </button>
      </div>
    </div>
  </form>
<?php
}
?>