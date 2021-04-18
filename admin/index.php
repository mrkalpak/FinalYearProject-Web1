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
                    firebase.database().ref('Admin/' + user.uid).on('value', (snapshot) => {
                    const data = snapshot.val()
                    if (data.name) {
                        document.location = './dashboard.php';
                    } else {
                        alert("You are not an admin")
                    }
                });

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

<form method="post"">
<input type="text" name="email" id="email">
<input type="text" name="password" id="password">
<input type="submit" value="submit" id="submit">
</form>
<!-- start of frontend code -->
<!-- end of frontend code -->

<?php include "./footer.php"; ?>