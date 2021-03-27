<?php include "./header.php"; ?>
<?php
// session_start();
if (isset($_POST['email'])) {
    extract($_POST);
?>
    <!--validating for signin using email and password-->
    <script>
        var email = "<?php echo $email; ?>"
        var password = "<?php echo $password; ?>"

        firebase.auth().signInWithEmailAndPassword(email, password).then((user) => {
                //signin
                firebase.auth().onAuthStateChanged((user) => {
                    if (user) {
                        document.location = './dashboard.php';
                    } else {
                        alert("User Login Failed")
                        document.location = './'
                    }
                });
            })
            .catch((error) => {
                //error
                var msg = error.message
                alert(msg)
                document.location = './'
            })
    </script>
<?php
    exit;
}
?>
<!--  while using form use name of email input as "email" -->
<!--  while using form use name of password input as "password" -->
<!-- start of frontend code -->
<!-- end of frontend code -->
<?php include "./footer.php"; ?>