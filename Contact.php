<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add styles for the contact form */
        .contact-form {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999; 
    background-color:#946867; /* Soft and light background */
    padding: 30px;
    border-radius: 15px; /* Increased border-radius for a smoother look */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Increased box-shadow for depth */
    max-width: 600px; /* Adjusted max-width for better responsiveness */
    width: 90%; 
}

.contact-form h2 {
    margin-bottom: 20px;
    font-size: 32px; /* Slightly reduced font size for better proportion */
    color: #ffffff;
}

.contact-form label {
    font-size: 18px; /* Reduced font size for better readability */
    color: #ffffff;
}

.contact-form input[type="email"],
.contact-form input[type="text"],
.contact-form textarea {
    width: 100%;
    padding: 12px; /* Increased padding for better input spacing */
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px; /* Increased border-radius for a softer appearance */
    font-size: 16px; /* Reduced font size for better readability */
}

.contact-form textarea {
    height: 150px;
}

.contact-form input[type="submit"] {
    background-color: #1e1d23;
    color: #fff;
    border: none;
    padding: 15px 30px;
    cursor: pointer;
    font-size: 18px;
    border-radius: 8px;
    transition: background-color 0.3s;
}

.contact-form input[type="submit"]:hover {
    background-color: #5b1d1d;
}

    </style>
    <title>Contact Us</title>
</head>
<body>
    <!-- Contact Form -->
    <div class="contact-form">
        <h2>Contact Us</h2>
        <?php
            require_once "database.php";

            if (isset($_POST["submit"])) {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $message = $_POST["message"];

                $errors = array();

                if (empty($name) || empty($email) || empty($message)) {
                    array_push($errors, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }

                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    $sqlInsertInfo = "INSERT INTO contact_details_db (name, email, message) VALUES (?, ?, ?)";
                    $stmtInsertInfo = mysqli_stmt_init($conn);

                    if (mysqli_stmt_prepare($stmtInsertInfo, $sqlInsertInfo)) {
                        mysqli_stmt_bind_param($stmtInsertInfo, "sss", $name, $email, $message);
                        mysqli_stmt_execute($stmtInsertInfo);
                        echo "<div class='alert alert-success success-alert w-50 mx-auto text-center'>Your message has been submitted successfully.</div>";

                        // Get the AccountID of the inserted user
                        $accountID = mysqli_insert_id($conn);
                    } else {
                        die("Error in preparing SQL statement to insert user account");
                    }
                }
            }
        ?>
    <form method="post" action="Contact.php">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br>
        
        <input type="submit" value="Submit" name="submit">
    </form>
    </div>
    
</body>
</html>
