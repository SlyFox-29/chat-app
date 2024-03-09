<?php
session_start();

// Redirect user if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
  <style>
    .message-box {
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc; /* Add border style */
        border-radius: 5px;
    }

    .username {
        font-size: 8pt;
        font-weight: bold;
      display: inline;
      vertical-align: middle;
    }

    .message {
        color: #333;
      display: inline;
      vertical-align: middle;
    }
    .user-icon {
        float: left; /* Float the icon to the left
      */
      display: inline;
      vertical-align: middle;
        margin-right: 10px; /* Add some space between the icon and the username */
    }

    .user-icon img {
        width: 30px; /* Set the width of the icon */
        height: 30px; /* Set the height of the icon */
        border-radius: 50%; /* Make the icon round */
        border: 1px solid #ccc; /* Add border for a circular effect */
    }

  </style>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Welcome, <?php echo $username; ?>!</h2>
            </div>
            <div class="card-body" style="height: 300px; overflow-y: scroll;">
                <div id="chat-messages">
                    <!-- Messages will be displayed here -->
                </div>
            </div>
            <div class="card-footer">
                <form id="chat-form">
                    <div class="input-group">
                        <input type="text" class="form-control" id="message" placeholder="Type a message...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </form>
                <form action="logout.php" method="post" class="mt-3">
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to fetch and display messages
            function fetchMessages() {
                $('#chat-messages').load('get_messages.php');
            }

            // Fetch and display messages on page load
            fetchMessages();

            // Update messages every 3 seconds
            setInterval(fetchMessages, 3000);

            // Submit message
            $('#chat-form').submit(function(e) {
                e.preventDefault();
                var message = $('#message').val().trim();

                if (message !== '') {
                    $.post('send_message.php', { message: message }, function(data) {
                        // Do something if needed
                    });
                    $('#message').val('');
                }
            });
        });
    </script>
</body>
</html>
