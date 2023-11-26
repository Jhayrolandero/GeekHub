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
    <div class="modal update-community-modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content" id="content">

                <input type="text" id="user-profile-id" value="<?= $_SESSION["user"] ?>" hidden>
                <!-- Modal Header -->
                <div class="modal-header" id="modal-header">
                    <h4 class="modal-title">Update Profile</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close-update-community"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- Caption -->
                    <label for="" class="form-label">Community Name</label>
                    <input type="text" class="form-control curr-community-name" id="community-name-input">

                    <label for="" class="form-label">Community Picture</label>
                    <input type="file" name="image" id="community-pic-input" class="form-control" />

                    <label for="" class="form-label">Community background</label>
                    <input type="file" name="image" id="community-bg-input" class="form-control" />

                    <!-- <textarea class="form-control" name="" id="update-profile-form" cols="30" rows="10" placeholder="Share your thoughts"></textarea> -->
                </div>

                <!-- Modal footer -->
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn w-100" data-bs-dismiss="modal" id="update-community-btn">Post</button>
                </div>

            </div>
        </div>
    </div>
</body>

</html>