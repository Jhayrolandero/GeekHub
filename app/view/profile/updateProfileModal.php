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
    <div class="modal update-profile-modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content" id="content">

                <input type="text" id="user-profile-id" value="<?= $_SESSION["user"] ?>" hidden>
                <!-- Modal Header -->
                <div class="modal-header" id="modal-header">
                    <h4 class="modal-title">Update Profile</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close-update-profile"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-center">
                    <!-- Caption -->
                    <label for="" class="form-label">
                        <h4>Username</h4>
                    </label>
                    <input type="text" class="form-control curr-profile-name mb-5" id="username-input">

                    <label for="" class="form-label">
                        <h4>Profile Picture</h4>
                        <img src="" alt="" style="width:150px; height: 150px;" class="mx-auto rounded-pill" id="prev-profile-icon">
                    </label>
                    <input type="file" name="image" id="profile-pic-input" class="form-control mb-5" />

                    <label for="" class="form-label">
                        <h4>Profile background</h4>
                        <div>
                            <img src="" alt="" style="width:100%;" class="mx-auto" id="prev-profile-bg">
                        </div>
                    </label>
                    <input type="file" name="image" id="profile-bg-input" class="form-control" />
                    <!-- <textarea class="form-control" name="" id="update-profile-form" cols="30" rows="10" placeholder="Share your thoughts"></textarea> -->
                </div>

                <!-- Modal footer -->
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn w-100" data-bs-dismiss="modal" id="update-profile-btn">Post</button>
                </div>

            </div>
        </div>
    </div>
</body>

</html>