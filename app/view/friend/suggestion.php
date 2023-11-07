<?php
// session_start();

function show_SuggestionList($username, $userID, $email) {
  ?>
  <form class="col-md-3 col-sm-6 col-12 suggestion-card">
    <div class="card bg-dark text-white">
      <img class="card-img-top" src="public\images\profile.png" alt="Card image">
      <div class="card-body">
        <input type="text" value="<?=$userID?>" class="friend_id" hidden>
        <input type="text" value="<?=$_SESSION["user"]?>" class="user_id" hidden>
        <h4 class="card-title"><?=$username?></h4>
        <p class="card-text"><?=$email?></p>
        <button class="btn btn-primary col-5 profile-btn">
        <ion-icon name="person-outline"></ion-icon>  
        Profile
        </button>
        <button class="btn btn-primary col-5 add-btn">
        <ion-icon name="person-add-outline"></ion-icon>
        Add
        </button>
      </div>
    </div>
  </form>
  <?php
}
?>