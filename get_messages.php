<?php
// Read users and their information from the users.txt file
$usersInfo = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Initialize an empty array to store user information
$userData = array();

// Loop through each line of users' information
foreach ($usersInfo as $userInfo) {
    // Split the line into username, password, and photo URL
    $userInfoParts = explode(':', $userInfo);
    $username = $userInfoParts[0];
    $photoUrl = isset($userInfoParts[2]) ? $userInfoParts[2] : 'default_photo.png';

    // Store the photo URL for each username
    $userData[$username] = $photoUrl;
}

// Read messages from a file or database and return as HTML
$messages = file_get_contents('messages.txt');
$messagesArray = explode(PHP_EOL, $messages);

foreach ($messagesArray as $message) {
    if (!empty($message)) {
        // Check if the message contains the delimiter ":"
        if (strpos($message, ':') !== false) {
            // Split the message into username and message text
            list($username, $text) = explode(':', $message, 2);

            // Get the photo URL corresponding to the username
            $photoUrl = isset($userData[$username]) ? $userData[$username] : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKoAAACUCAMAAAA02EJtAAAAaVBMVEX///8AAAD8/PyQkJAEBAT4+PgICAj19fVSUlLx8fFOTk5ra2vPz8/j4+Pe3t68vLx+fn51dXUbGxs1NTXr6+uamponJye1tbXV1dVZWVmrq6suLi4SEhJiYmJJSUk+Pj6IiIjFxcWioqJJ/EM+AAAFD0lEQVR4nO2bi5aqOgyGaaEU5CYIAl7B93/I3aQUmRlRZhTKWaf/cjFuUObbIU2TtGNZRkZGRkZGRkZGRkZGRkZGRkZGRkaTRPElDlT+VGcpHV5dhwQKY1aHNjitzuuhGhfDQ1za2yDY2mXM+pOrEgUDcl7ZV9Lralecd5fWI+GWnPlhmklIx5E/szT0GadrcgAKHhk3O0JcFzjlS7wnuyaGa+thhZFfBSc0p6OsirjkFFT0x3DTwojPHlDCDRnRJpRBTHvMQoNxq/WkPX9InPZa8YGfkUwHqXjF5/tY+oYqzp7jNcwDEOOp5W8FkPv4+YvTztZX/yetqFQE+TIT1ntoVIIXsvL7pKsHVRjVE7Zzx3wVLnm+dlQwqcUSMm7U7lKCH9TJijM8rcco76px/Gv3gHD3GnUX6nZVHNi302vU0023TTFcNq9JCWnkvKaX1A+moAa+pdeu8LsjbwpqHWnElKjUiiehevEKfLUazamG2lTax5X1C6tqR83PU1DPuWZUTFbTKagp18nZodJiyhRQ6H76+Pvb/WvUfauZVOaA0QaT/dHUGjKrTaS7DqDYkbC7mvqhZJVdUKo7YbWgxo9GE2tkheQajKp7YDFImNGsow4grtnQt9DbuQBfFQ8WQ+t4GYhBFXswWlGlu7ZPs+tdC+bUWq5YXQ4qDHt4ErD2h65a0R1aQdzyi+zR0IIhlRV+N6LWgCog/Nuxo3PRaV234z7e/HUwKgmYEgpXGV0Hx7pciTU7MWgI0Mi+qMlJTV8XO6IwntbUZpcNwbCos7ujZnURrqEF+FW060nxqLWDzW6/320Cu414tyC0Plb0A5bnURxHeY7zGFsdqdL3dSs9FBN1d8x1ueiY/hOU9It007wU7Q/r1QO8VREPYSjP4zApD7fboUzCOOd05IN6xNQyW14lReAd+0o7O3pBkVS5Wl7TPbkyWGIR44dXh/TyoB9wuqSHisP0QDXDdgOdJ+klG6ZUw/I1u6QJt7SHBJhMLb/09pBFy7UUx1VZtToh6gCv9C05yWpkFaB1R3ZSgGTw5tT9uy41Z9iUxtsMYWTS3+f+g3oAzCzOZttYm1Ux6TtckcXpn7k6KrdVJZZ4cz1wLbUgdgDiZq92K7wQ7mPYN7GWdpCIPmFwGm1VPaB1yCkIdYQsxlpPPHuHTDGqDBDiw17LlkYVIT05ysX+iWZ15JaBY0KXbrPQZNfvqJnkq2rvzS5Z2lfbC05KTh9IX6Kqz18Wa2BTLEKrmox3f596gUvqqrvJ7KjY/E2fdn+fWVd8MYXG8BIeC9tqGrVD7fdWhVfjLxKzoLgvjzD9/J5UsrrkWLIlWMFRve5h/kHyS161SFXLeNPZ50+S32v4AqTcCvdfE5PfG1VksOESCy40/bNFe7kkXWIigAn1TVQHJtj5Myy+JZ9AJdv5HSC8vv/84Q7XcG5SXFIfWU2bLhd2Xs3tAHmAGf1bdnWwcgjymVHD47sWVTrO6AGUcosXZFIt9Upwi8KfsTUgEpWUvD3+FWrqz/XnDXjT+Pr3KfUrq4gBcX/bj6OKu4Z3o7wFisdwLlTUobfJB1APs22/nbwBdKqauRa1oOnIzgOjvCN8LGc+07jCP1NSdeonJPe1z+OrjPoTtlVP1y6fLawyK5+wUW26Mn+mZhvuAP4samzNFQEozW/2B1Xkc3Uw2cfHAJurbv1880b3UpaRkZGRkZGRkZGRkZGRkZGRkdH/Rv8AYiUzAG97T2UAAAAASUVORK5CYII=';

            // Format the message with the username and photo
            echo "<div class='message-box'><div class='user-icon'><img src='$photoUrl' alt='User Photo'></div><div class='username'><b>$username:</b></div><div class='message'>$text</div></div>";
        }
    }
}
?>
