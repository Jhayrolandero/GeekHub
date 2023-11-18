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
    <div class="modal update-post-modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content" id="content">
    
            <input type="text" id="update-post-id" hidden>
            <!-- Modal Header -->
            <div class="modal-header" id="modal-header">
                <h4 class="modal-title">Update Post</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="close-update-post"></button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <!-- Caption -->
                <textarea class="form-control" name="" id="update-post-form" cols="30" rows="10" placeholder="Share your thoughts"></textarea>
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer" id="modal-footer">
                <button 
                type="button" 
                class="btn w-100" 
                data-bs-dismiss="modal"
                id="update-post-btn">Post</button>
            </div>
    
            </div>
        </div>
        </div>    
</body>
</html>

