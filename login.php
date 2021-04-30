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
</div>

<?php
// session_start();
if (isset($_POST['email'])) {
    extract($_POST);
?>
    <!--validating for signin using email and password-->
   <script>var email = "<?php echo $email; ?>"
var password = "<?php echo $password; ?>"
document.getElementById('mainContainerDiv').style.visibility = "hidden"
document.getElementById('loading').style.visibility = "visible"
firebase.auth().signInWithEmailAndPassword(email, password).then((user) => {
    //signin
    firebase.auth().onAuthStateChanged((user) => {
        if (user) {
            uid = user.uid
            if (user.uid) {
                firebase.database().ref('Users/' + user.uid).on('value', (snapshot) => {
                    if (snapshot.hasChild('name')) {
                        document.location = './dashboard.php';
                    }
                });
            }
        } else {
            alert("User Login Failed")
            document.location = './'
        }

    });
})
    .catch((error) => {
        //error


        document.location = './newregistration.php'
    })</script>
<?php
    exit;
}
?>
>