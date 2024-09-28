<?php

define("Error_Message", "this Field Is requeir");
$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = post_data('username');
    $email = post_data(data: 'email');
    $password = post_data('password');
    $passConfirm = post_data('password_confirm');
    $cv = post_data('cv_url');

    if (!$username) {
        $errors['username'] = Error_Message;
    } else if (strlen($username) < 6 || strlen($username) > 16) {
        $errors['username'] = 'Usename Must Be Between 6 and 16';

    }
    if (!$email) {
        $errors['email'] = Error_Message;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "this field must be a valid email";

    }
    if (!$password) {
        $errors['password'] = Error_Message;
    }
    if (!$passConfirm) {
        $errors['passConfirm'] = Error_Message;
    }
    if ($password && $passConfirm && strcmp($password, $passConfirm) !== 0) {

        $errors['passConfirm'] = "This Must Match The Password Field";
    }
    if (!$cv && !filter_var($cv, FILTER_VALIDATE_URL)) {
        $errors['cv'] = "Please Enter Validate URL";
    }
    if (empty($errors)) {
        echo "ok";
    }

}

function post_data($data)
{
    $_POST[$data] ??= '';
    return htmlspecialchars(stripcslashes($_POST[$data]));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <title>Form Validation</title>
</head>

<body>
    <div class="container my-5">
        <form action="" method="post">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Uesrname</label>
                        <input class="form-control <?php echo isset($errors["username"]) ? "is-invalid" : "" ?>"
                            name="username">
                        <small class="form-text text-muted">Min 6 and Max 16 characters</small>
                        <div class="invalid-feedback"><?php echo $errors["username"] ?></div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group ">
                        <label>Email</label>
                        <input type="email"
                            class="form-control <?php echo isset($errors["email"]) ? "is-invalid" : "" ?>" name="email">
                        <div class="invalid-feedback"><?php echo $errors["email"] ?? "" ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password"
                            class="form-control <?php echo isset($errors["password"]) ? "is-invalid" : "" ?>"
                            name="password">
                        <div class="invalid-feedback"><?php echo $errors["password"] ?></div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Repeat Password</label>
                        <input type="password"
                            class="form-control <?php echo isset($errors["passConfirm"]) ? "is-invalid" : "" ?>"
                            name="password_confirm">
                        <div class="invalid-feedback"><?php echo $errors["passConfirm"] ?></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Your CV Link</label>
                <input type="text" class="form-control <?php echo isset($errors["cv"]) ? "is-invalid" : "" ?>"
                    name="cv_url" placeholder="https://example.com/my-cv">
                <div class="invalid-feedback"><?php echo $errors["cv"] ?></div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Register</button>

            </div>
        </form>
    </div>

</body>

</html>