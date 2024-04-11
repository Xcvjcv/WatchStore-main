<?php include_once("master/header.php");
include_once('./database.php');
if ($_SESSION['username'] == '') {
    ?>
    <script>
        alert("Please log in to view your account");
        window.location.href = 'login.php';
    </script>
    <?php
}else { ?>
    <div>
        <h1>Welcome,<?php echo $_SESSION['username'];?></h1>
        <div>
            <h3>User Information</h3>
            <hr>
            <p><strong>Username:<?php echo $_SESSION['username'];?></strong> </p>
            <p><strong>Email:<?php echo $_SESSION['email'];?></strong> </p>
        </div>
        <br>
        <form action="Admin/ManagementUser.php" method="get">
            <button type="submit" class="btn btn-success">Admin Page>> </button>
        </form>

        <br>
        <form id="logoutForm" method="get" action="account.php">
            <button type="submit" name='logout' class="btn btn-outline-danger">Logout</button>
        </form>
    </div>
<?php
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<?php $conn->close();
include_once("master/footer.php"); ?>
