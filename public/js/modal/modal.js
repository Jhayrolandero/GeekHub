// Preview image on post
function preview_image() {
  var input = document.getElementById("image-input");
  var preview = document.getElementById("image-preview");

  // Check if a file is selected
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      // Set the source of the image preview
      preview.innerHTML =
        '<img src="' + e.target.result + '" alt="Image Preview" />';
    };

    // Read the selected file as a data URL
    reader.readAsDataURL(input.files[0]);
  } else {
    // Clear the image preview if no file is selected
    preview.innerHTML =
      "<small><ion-icon name='images' size='large'></ion-icon></small><p>Photos</p>";
  }
}

// Profile Pic update
function preview_image_pic() {
  var input = document.getElementById("profile-pic-input");
  var preview = document.getElementById("profile-preview");

  // Check if a file is selected
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      // Set the source of the image preview
      preview.innerHTML =
        '<img src="' +
        e.target.result +
        '" style="width:150px; height: 150px;" class="mx-auto rounded-pill" alt="Image Preview" />';
    };

    // Read the selected file as a data URL
    reader.readAsDataURL(input.files[0]);
  } else {
    // Clear the image preview if no file is selected
    preview.innerHTML =
      "<small><ion-icon name='images' size='large'></ion-icon></small><p>Photos</p>";
  }
}

// Profile BG update
function preview_profile_bg() {
  var input = document.getElementById("profile-bg-input");
  var preview = document.getElementById("bg-preview");

  // Check if a file is selected
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      // Set the source of the image preview
      preview.innerHTML =
        '<img src="' +
        e.target.result +
        '" style="width:100%;" class="mx-auto" alt="Image Preview" />';
    };

    // Read the selected file as a data URL
    reader.readAsDataURL(input.files[0]);
  } else {
    // Clear the image preview if no file is selected
    preview.innerHTML =
      "<small><ion-icon name='images' size='large'></ion-icon></small><p>Photos</p>";
  }
}

// Community Icon update
function preview_community_pic() {
  var input = document.getElementById("community-pic-input");
  var preview = document.getElementById("community-profile-preview");

  // Check if a file is selected
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      // Set the source of the image preview
      preview.innerHTML =
        '<img src="' +
        e.target.result +
        '" style="width:150px; height: 150px;" class="mx-auto rounded-pill" alt="Image Preview" />';
    };

    // Read the selected file as a data URL
    reader.readAsDataURL(input.files[0]);
  } else {
    // Clear the image preview if no file is selected
    preview.innerHTML =
      "<small><ion-icon name='images' size='large'></ion-icon></small><p>Photos</p>";
  }
}

// Community bg update
function preview_community_bg() {
  var input = document.getElementById("community-bg-input");
  var preview = document.getElementById("community-bg-preview");

  // Check if a file is selected
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      // Set the source of the image preview
      preview.innerHTML =
        '<img src="' +
        e.target.result +
        '"  style="width:100%;" class="mx-auto" alt="Image Preview" />';
    };

    // Read the selected file as a data URL
    reader.readAsDataURL(input.files[0]);
  } else {
    // Clear the image preview if no file is selected
    preview.innerHTML =
      "<small><ion-icon name='images' size='large'></ion-icon></small><p>Photos</p>";
  }
}
