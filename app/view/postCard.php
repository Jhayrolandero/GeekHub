<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/postCard/postCard.css">
    <title>Document</title>
</head>
<body>
<div class="container post">
  <div class="card">
    <div class="card-header p-3" id="card-header">
        <div class="row">
            <div class="col-1">
                <img src="public/images/you.png" alt="" style="width:45px;" class="rounded-pill">
            </div>
            <div class="col-10">
                <div class="col-12">Name</div>
                <div class="col-12">Date</div>
            </div>
            <div class="col">
                close button
            </div>
        </div>
    </div>
    <div class="card-body" id="card-body">
        <div>content</div>
        <div>metainfo</div>
    </div> 
    <div class="card-footer" id="card-footer">
        <div class="row">
            <div class="col-4 text-center">
                <button class="w-100 meta-btn btn">
                    <ion-icon name="thumbs-up-outline"></ion-icon>
                    Like
                </button>
            </div>
            <div class="col-4 text-center">
                <button class="w-100 meta-btn btn">
                    <ion-icon name="chatbox-outline"></ion-icon>
                    Comment
                </button>
            </div>
            <div class="col-4 text-center">
                <button class="w-100 meta-btn btn">
                    <ion-icon name="arrow-redo-outline"></ion-icon>
                    Share
                </button>
            </div>
        </div>
    </div>
  </div>
</div>
</body>
</html>