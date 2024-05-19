<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h2 {
            color: #333;
            text-align: center; /* Added text-align property */
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: absolute;
            bottom: 0; /* Positioned at the bottom */
        }

        ul {
            color: red;
            list-style-type: none;
            margin: 0;
            padding: 0;
            margin-bottom: 10px;
        }

        ul li:before {
            content: "•";
            margin-right: 5px;
        }

        .success-message {
            color: green;
            font-weight: bold;
        }

        .suggestion-container {
            position: relative;
            margin-top: 30px;
            padding-bottom: 50px; /* Increased the padding-bottom value to create more space for the submit button */
        }
        .suggestion-container textarea {
            resize: vertical;
        }

        .suggestion-container input[type="submit"] {
            position: absolute;
            bottom: -10px; /* Adjusted the bottom value to position the submit button */
            left: 50%;
            transform: translateX(-50%);
        }

        .gender-container label {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h2>Form Validation</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name">

        <label for="email">E-mail:</label>
        <input type="text" name="email" id="email">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <label>Gender:</label>
        <div class="gender-container">
            <input type="radio" name="gender" value="male" id="gender-male"><label for="gender-male">Male</label>
            <input type="radio" name="gender" value="female" id="gender-female"><label for="gender-female">Female</label>
        </div>

        <div class="suggestion-container">
            <label for="suggestion">Suggestion:</label>
            <textarea name="suggestion" rows="10" cols="30" id="suggestion"></textarea>

            <input type="submit" name="submit" value="Submit">
        </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $_POST["name"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $gender = $_POST["gender"];
        $suggestion = $_POST["suggestion"];

        $fullnameError = validate_fullname($fullname);
        $passwordError = validate_password($password);
        $emailError = validate_email($email);
        $genderError = validate_gender($gender);
        $suggestionError = validate_suggestion($suggestion);

        if (empty($fullnameError) && empty($passwordError) && empty($emailError) && empty($genderError) && empty($suggestionError)) {
            echo "<p class='success-message'>Form submitted successfully!</p>";
            echo "<h2>Your Input:</h2>";
            echo "Full Name: " . $fullname . "<br>";
            echo "E-mail: " . $email . "<br>";
            echo "Password: " . $password . "<br>";
            echo "Gender: " . $gender . "<br>";
            echo "Suggestion: " . $suggestion . "<br>";
        } else {
            echo "<h2>Validation Errors:</h2>";
            echo "<ul>";
            if (!empty($fullnameError)) {
                echo "<li>" . $fullnameError . "</li>";
            }
            if (!empty($passwordError)) {
                echo "<li>" . $passwordError . "</li>";
            }
            if (!empty($emailError)) {
                echo "<li>" . $emailError . "</li>";
            }
            if (!empty($genderError)) {
                echo "<li>" . $genderError . "</li>";
            }
            if (!empty($suggestionError)) {
                echo "<li>" . $suggestionError . "</li>";
            }
            echo "</ul>";
        }
    }

    function validate_fullname($fullname)
    {
        if (empty($fullname)) {
            return "Full name is required";
        }
        return "";
    }

    function validate_password($password)
    {
        if (empty($password)) {
            return "Password is required";
        }
        return "";
    }

    function validate_email($email)
    {
        if (empty($email)) {
            return "E-mail is required";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid e-mail format";
        }
        return "";
    }

    function validate_gender($gender)
    {
        if (empty($gender)) {
            return "Gender is required";
        }
        return "";
    }

    function validate_suggestion($suggestion)
    {
        if (empty($suggestion)) {
            return "Suggestion is required";
        }
        return "";
    }
    ?>
</body>
</html>