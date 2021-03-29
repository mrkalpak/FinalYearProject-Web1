<?php include "./Iheader.php"; ?>

    
<form class="mt-5" method="POST">
  
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control w-75" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control w-75" placeholder="Password" required>
  <br>
  <button class="btn w-75 btn-outline-primary btn-block" type="submit">Sign in</button>
  
</form>



</div>

</div>

</center>
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