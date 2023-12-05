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

            $("#upload").click(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Create a FormData object
                var formData = new FormData();

                formData.append("action", "validate");
                formData.append("image", $("#image-input")[0].files[0]);

                $.ajax({
                    type: "POST",
                    url: "app/controller/PostController.php",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data, status) {
                        if (status === "success") {
                            alert(data);
                        } else {
                            alert("Error occurred! Try again later.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert("An error occurred while sending the data.");
                    },
                });
            });
        });
    </script>


</head>

<body>
    <input type="file" name="image" id="image-input" class="w-100" />
    <button id="upload">Click</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>