<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="public/css/comment/comment.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
  <div class="modal comment-modal" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <input type="text" class="comment-post-id" hidden>
          <input type="text" class="comment-user-id" value="<?= $_SESSION["user"] ?>" hidden>
          <input type="text" class="comment-target-id" hidden>
          <h4 class="modal-title comment-title text-center"></h4>
          <button type="button" class="btn-close close-btn"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body p-0">
          <div class="container-fluid p-1" id="comment-list">

          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer position-relative">
          <input type="text" class="form-control comment-input" placeholder="Say Something" id="comment-form">
          <button type="button" class="position-absolute" id="add-comment-btn"><ion-icon name="navigate-outline"></ion-icon></button>
        </div>

      </div>
    </div>
  </div>
</body>

</html>