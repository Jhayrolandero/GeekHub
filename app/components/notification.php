<div class="dropdown dropstart text-end">
    <button type="button" class="notif-btn btn dropdown-toggle rounded-pill p-3" data-bs-toggle="dropdown" id="nav-drop-btn">
        <ion-icon name="notifications" size="large"></ion-icon>
    </button>
    <div class="dropdown-menu" id="notif">
        <div class="notif-header">
            <p class="fs-4 ms-2">Notification</p>
        </div>
        <section class="notif-container">
        </section>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.get(
            "app/controller/NotificationController.php?action=getNotif",
            function(data, status) {
                if (status === "success") {
                    $(".notif-container").html(data);
                }
            }
        );
    })
</script>
<style>
    :root {
        --dark-bg: #090909;
        --black-clr: rgb(22, 22, 22);
        --text-clr: #ffffff;
        --border: rgba(220, 220, 220, 0.5) solid 1px;
        --blue-color: #0ba4eb;
        --blue-border: var(--blue-color) solid 1px;
        --red-color: #f51919;
        --red-border: var(--red-color) solid 1px;
    }

    .notif-btn {
        background-color: var(--dark-bg);
        width: 100%;
        height: 100%;
        border: var(--blue-border);
        color: var(--blue-color);
    }

    .notif-btn:hover {
        background-color: var(--dark-bg);
        width: 100%;
        height: 100%;
        border: var(--blue-border);
        color: var(--blue-color);
    }

    #notif {
        background-color: var(--dark-bg);
        color: #fff;
        width: max-content;
    }

    .notif-container {
        max-height: 30rem;
        /* Set the maximum height as needed */
        overflow-y: auto;
    }

    /* Define the scrollbar styles for WebKit browsers (Chrome, Safari) */
    .notif-container::-webkit-scrollbar {
        width: 10px;
    }

    /* Define the scrollbar track */
    .notif-container::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }

    /* Define the scrollbar handle */
    .notif-container::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 3px;
    }

    /* Define the scrollbar handle on hover */
    .notif-container::-webkit-scrollbar-thumb:hover {
        background-color: #555;
    }
</style>