<?php
function show_PendingList($username, $userID, $friendship_id) {
  ?>
  <form class="col-md-3 col-sm-6 col-12 suggestion-card">
    <div class="card bg-dark text-white">
      <img class="card-img-top" src="public\images\profile.png" alt="Card image">
      <div class="card-body">
        <input type="text" value="<?=$userID?>" class="friend_id" hidden>
        <input type="text" value="<?=$_SESSION["user"]?>" class="user_id" hidden>
        <input type="text" value="<?=$friendship_id?>" class="friendship_id" >
        <h4 class="card-title"><?=$username?></h4>
        <p class="card-text">Some example text.</p>
        <button class="btn btn-primary col-5 profile-btn">
        <ion-icon name="person-outline"></ion-icon>  
        Profile
        </button>
        <button class="btn btn-primary col-5 accept-btn">
          <ion-icon name="person-add-outline"></ion-icon>
          Accept
        </button>
      </div>
    </div>
  </form>
  <?php
}
?>