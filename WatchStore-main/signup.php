<?php include_once("master/header.php");
include_once('./database.php');
?>

    <div id="signup_login_contact_form">
        <h1 class="text-center">SIGN UP</h1>
        <div class="signup_login_contact_form_box">
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <?php

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (empty($_POST['username'])) {
                        echo "<p class=".htmlspecialchars('text-danger').">Please enter your username</p> ";
                    }
                    elseif (empty($_POST['email'])) {
                        echo "<p class=".htmlspecialchars('text-danger').">Please enter your new email</p> ";
                    }
                    elseif (empty($_POST['password'])) {
                        echo "<p class=".htmlspecialchars('text-danger').">Please enter your new password</p> ";
                    }
                    elseif (empty($_POST['password_retyped'])) {
                        echo "<p class=".htmlspecialchars('text-danger').">Retyped your password please</p> ";
                    }
                    else {
                        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                        $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
                        $password = $_POST['password'];
                        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
                        $retyped_password = $_POST['password_retyped'];
                        if($password != $retyped_password) {
                            echo "<p class=".htmlspecialchars('text-danger').">Password is not match</p> ";
                        }else {
                            if(!filter_var($email,FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
                                echo "<p class=".htmlspecialchars('text-danger').">Your email is invalid</p> ";
                            }else {
                                $email = mysqli_real_escape_string($conn, $_POST['email']);
                                $sql = "select email from tbl_user where email = '$email'";
                                $result = $conn ->query($sql);
                                if ($result->num_rows == 0) {
                                    $sql = "insert into tbl_user(username,user_pass,email) values('$username','$hashed_password','$email')";
                                    $result = $conn ->query($sql);
                                    if ($result === TRUE) {
                                        echo "<p class=".htmlspecialchars('text-success').">Signed up succesfully</p> ";
                                    }
                                    else {
                                        echo "<p class=".htmlspecialchars('text-danger').">Error</p> ";
                                    }
                                }
                                else {
                                    echo "<p class=".htmlspecialchars('text-danger').">Email you typed in already existed</p> ";
                                }
                            }
                        }
                    }
                }
                ?>
                <div class="row">
                    <label for="colFormLabelLg" class="col-sm-4 col-form-label col-form-label-lg">Email: </label>
                    <div class="col-lg-8">
                        <input type="email" name="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="Enter your email">
                    </div>
                </div>
                <br>
                <div class="row">
                    <label for="colFormLabelLg" class="col-sm-4 col-form-label col-form-label-lg">Username: </label>
                    <div class="col-lg-8">
                        <input name="username" class="form-control form-control-lg" id="colFormLabelLg" placeholder="Enter your username">
                    </div>
                </div>
                <br>
                <div class="row">
                    <label for="colFormLabelLg" class="col-sm-4 col-form-label col-form-label-lg">Password: </label>
                    <div class="col-lg-8">
                        <input type="password" name="password" class="form-control form-control-lg" id="colFormLabelLg" placeholder="Enter your password">
                    </div>
                </div>
                <br>
                <div class="row">
                    <label for="colFormLabelLg" class="col-sm-4 col-form-label col-form-label-lg">Retype Pass: </label>
                    <div class="col-lg-8">
                        <input type="password" name="password_retyped" class="form-control form-control-lg" id="colFormLabelLg" placeholder="Retype your password">
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-outline-primary col-12">Sign up</button>
                <br>
                <br>
                <div class="row">
                    <a href="login.php" class="text-info col-6">Already have an account?</a>

                </div>

            </form>
        </div>
    </div>

<?php $conn->close();?>
<?php include_once("master/footer.php"); ?>