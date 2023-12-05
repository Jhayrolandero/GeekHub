<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/modal/modal.css">
    <!-- <script src="public/js/community/community.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

    <!-- The Modal -->
    <div class="modal create-community-modal mx-auto modal-lg" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content" id="content">

                <!-- Modal Header -->
                <div class="modal-header" id="modal-header">
                    <h4 class="modal-title">Create Community</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close-create-community"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <!-- Profile Pic -->
                    <h4>Community Picture</h4>
                    <label class="w-100 mb-5">
                        <input type="file" name="image" id="community-pic-input" class="w-100" onchange="preview_community_pic()" />
                        <div id="community-profile-preview" class="d-flex flex-column justify-content-center align-items-center">


                            <small><ion-icon name="images" size="large"></ion-icon></small>
                            <p>Photo</p>

                        </div>
                    </label>

                    <!-- Community BG -->
                    <h4>Community BG</h4>
                    <label class="w-100 mb-5">
                        <input type="file" name="image" id="community-bg-input" class="w-100" onchange="preview_community_bg()" />
                        <div id="community-bg-preview" class="d-flex flex-column justify-content-center align-items-center">

                            <small><ion-icon name="images" size="large"></ion-icon></small>
                            <p>Photo</p>

                        </div>
                    </label>

                    <!-- Title -->
                    <h6>Community Title</h6>
                    <input type="text" class="form-control" id="group-name">
                    <h6>Community Description</h6>
                    <!-- Description -->
                    <textarea class="form-control" name="" id="group-desc" cols="30" rows="10" placeholder="Share your thoughts"></textarea>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn w-100" data-bs-dismiss="modal" id="create-community-btn">Post</button>
                </div>

            </div>
        </div>
    </div>

    <script src="public/js/modal/modal.js"></script>
</body>

</html>