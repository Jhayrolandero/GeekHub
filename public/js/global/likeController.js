export default function likePost() {
  let postID = 90;

  $.get(
    "app/controller/LikeController.php",
    {
      action: "getLikes",
      post_id: postID,
    },
    function (data, status) {
      if (status === "success") {
        console.log(data.like_count);
      } else {
        alert("error");
      }
    }
  );
}
