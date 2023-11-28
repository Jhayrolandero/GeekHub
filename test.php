<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/kute.js@2.2.4/dist/kute.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script>
        $(document).ready(function() {

            var commentCount = 10;

            function render_comments(postID, limit) {
                $.get("app/controller/CommentController.php", {
                    action: "showComment",
                    postID: 56,
                    limit: limit
                }, function(data, status) {
                    $("#comment-cont").html(data);
                    commentCount = limit;
                })
            }

            render_comments(56, commentCount);


            $("#render-btn").click(function() {
                render_comments(56, commentCount + 2);
            });
        });
    </script>

    <!-- CSS -->
    <style>
        .file-input-container {
            position: relative;
            overflow: hidden;
        }

        .file-input-label {
            display: inline-block;
            cursor: pointer;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .image-preview {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: auto;
        }

        .button-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
        }

        /* Hide the default file input */
        #community-pic-input {
            display: none;
        }
    </style>
</head>

<body>
    <!-- HTML -->
    <div class="file-input-container">
        <input type="file" name="image" id="community-pic-input" class="form-control" />
        <label for="community-pic-input" class="file-input-label">
            wut
            <!-- <img src="public\images\background.jpg" alt="Choose an image" class="image-preview">
            <span class="button-text">Choose Image</span> -->
        </label>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>