<!-- login page code -->

<?php include "./header.php"; ?>



<script>
    function signupwithgoogle() {
        var provider = new firebase.auth.GoogleAuthProvider();
        firebase.auth()
            .signInWithPopup(provider)
            .then((result) => {
                /** @type {firebase.auth.OAuthCredential} */
                var credential = result.credential;

                // This gives you a Google Access Token. You can use it to access the Google API.
                var token = credential.accessToken;
                // The signed-in user info.
                var user = result.user;
                if (user.uid != null) {

                    if (result.additionalUserInfo.isNewUser) {
                        document.location = './newregistration.php';
                    } else {
                        document.location = './dashboard.php';
                    }

                } else {
                    alert("User login Failed");
                    document.location = './logout.php';
                }

            }).catch((error) => {
                // Handle Errors here.
                var errorCode = error.code;
                var errorMessage = error.message;
                // The email of the user's account used.
                var email = error.email;
                // The firebase.auth.AuthCredential type that was used.
                var credential = error.credential;
                alert(errorMessage)
                document.location = './'

            });
    }
</script>

<!-- for google signup onclick function = "signupwithgoogle()" -->
<!-- for new register redirect to newregistration.php through document.location -->
<!-- for already to login.php through document.location -->

<!-- start of frontend code -->
<!-- end of frontend code -->




<?php include "./footer.php"; ?>