<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/modal/modal.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

    <!-- The Modal -->
    <div class="modal update-community-modal modal-lg" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content" id="content">

                <input type="text" id="user-profile-id" value="<?= $_SESSION["user"] ?>" hidden>
                <!-- Modal Header -->
                <div class="modal-header" id="modal-header">
                    <h4 class="modal-title">Update Profile</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close-update-community"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-center">

                    <!-- Community Name -->
                    <label for="" class="form-label">
                        <h4>Community Name</h4>
                    </label>
                    <input type="text" class="form-control curr-community-name mb-5 edit-name" id="community-name-input">

                    <!-- Description -->
                    <label for="" class="form-label">
                        <h4>Description</h4>
                    </label>
                    <textarea name="" class="form-control curr-community-desc mb-5 community-desc" id="community-desc-input"></textarea>

                    <!-- <input type="text" class="form-control" id="community-desc-input"> -->

                    <!-- Profile Pic -->
                    <h4>Community Picture</h4>
                    <label class="w-100 mb-5">
                        <input type="file" name="image" id="community-pic-input" class="w-100" onchange="preview_community_pic()" />
                        <div id="community-profile-preview" class="d-flex flex-column justify-content-center align-items-center">

                            <img src="" alt="" style="width:150px; height: 150px;" class="mx-auto rounded-pill" id="prev-community-icon">

                        </div>
                    </label>

                    <!-- Community BG -->
                    <h4>Community Picture</h4>
                    <label class="w-100 mb-5">
                        <input type="file" name="image" id="community-bg-input" class="w-100" onchange="preview_community_bg()" />
                        <div id="community-bg-preview" class="d-flex flex-column justify-content-center align-items-center">

                            <img src="" alt="" style="width:100%;" class="mx-auto" id="prev-community-bg">

                        </div>
                    </label>

                    <label for="" class="form-label">
                        <h4>Danger Zone</h4>
                    </label>
                    <input type="button" value="Delete Community" class="form-control btn btn-danger delete-community">


                    <!-- <textarea class="form-control" name="" id="update-profile-form" cols="30" rows="10" placeholder="Share your thoughts"></textarea> -->
                </div>

                <!-- Modal footer -->
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn w-100" data-bs-dismiss="modal" id="update-community-btn">Update</button>
                </div>

            </div>
        </div>
    </div>
</body>

</html>