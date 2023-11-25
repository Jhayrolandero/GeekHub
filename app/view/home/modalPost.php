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
    <div class="modal create-post-modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content" id="content">
                <input type="text" value="<?= $_SESSION["user"] ?>" id="user-id-post">
                <!-- Modal Header -->
                <div class="modal-header" id="modal-header">
                    <h4 class="modal-title">Create Post</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="close-create-post"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- Caption -->
                    <textarea class="form-control" name="" id="post-form" cols="30" rows="10" placeholder="Share your thoughts"></textarea>
                    <!-- Image -->
                    <input type="file" name="image" id="image-input" />
                </div>

                <!-- Modal footer -->
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn w-100" data-bs-dismiss="modal" id="post-btn">Post</button>
                </div>

            </div>
        </div>
    </div>
</body>

</html>