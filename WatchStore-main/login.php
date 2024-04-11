<?php include_once("master/header.php");
include_once('./database.php');
?>

    <div id="signup_login_contact_form">
        <h1 class="text-center">SIGN IN</h1>
        <div class="signup_login_contact_form_box">
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (empty($_POST['username'])) {
                        echo "<p class=".htmlspecialchars('text-warning').">Please enter your username</p> ";
                    }
                    elseif (empty($_POST['email'])) {
                        echo "<p class=".htmlspecialchars('text-warning').">Please enter your email</p> ";
                    }
                    elseif (empty($_POST['password'])) {
                        echo "<p class=".htmlspecialchars('text-warning').">Please enter your password</p> ";
                    }
                    else {
                        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
                        $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
                        $password = $_POST['password'];
                        $sql = "select username,user_pass,email,is_accessible from tbl_user where email = '$email'";
                        $result = mysqli_query($conn,$sql);
                        if ($email == 'admin@gmail.com' && $username == 'admin' && $password == 'admin') {
                            header('Location:Admin/ManagementUser.php');
                        }
                        elseif ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            if($row['username'] != $username) {
                                echo "<p class=".htmlspecialchars('text-danger').">Wrong username</p> ";
                            }elseif (!password_verify($password,$row['user_pass'])) {
                                echo "<p class=".htmlspecialchars('text-danger').">Wrong password</p> ";
                            }elseif ($row['is_accessible'] == 0) {
                                echo "<p class=".htmlspecialchars('text-danger').">Your account has been banned @@</p> ";
                            }
                            else {
                                $_SESSION['username'] = $username;
                                $_SESSION['email'] = $email;
                                echo '<script>alert("Logged in successfully")</script>';
                                header("Location:Admin/AddUser.php");
                            }
                        }else {
                            if(!filter_var($email,FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
                                echo "<p class=".htmlspecialchars('text-danger').">That's not a valid format of an email</p> ";
                            }else {
                                echo "<p class=".htmlspecialchars('text-danger').">Your email you typed in is not registered</p> ";
                            }
                        }
                    }
                }?>
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
                <button type="submit" class="btn btn-outline-primary col-12">Login</button>
                <br>
                <br>
                <div class="row">
                    <a href="signup.php" class="text-info col-12">Create Account?</a>

                </div>

            </form>
        </div>
    </div>
<?php $conn->close();?>
<?php include_once("master/footer.php"); ?>