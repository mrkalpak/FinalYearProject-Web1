<?php include "./Iheader.php"; ?>

            <button type="button" class="btn  text-white" onclick="document.location='login.php'" style="background-color:#4747d1;  border-radius:20px 20px 20px 20px ;width:200px">Login with Email</button><br><br>
                <button type="button" class="  btn  " style="background-color:#e6e6e6;  border-radius: 20px 20px 20px 20px;width:200px" onclick="signupwithgoogle()"><svg id="fi_2702602" enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg"><g><path d="m120 256c0-25.367 6.989-49.13 19.131-69.477v-86.308h-86.308c-34.255 44.488-52.823 98.707-52.823 155.785s18.568 111.297 52.823 155.785h86.308v-86.308c-12.142-20.347-19.131-44.11-19.131-69.477z" fill="#fbbd00"></path><path d="m256 392-60 60 60 60c57.079 0 111.297-18.568 155.785-52.823v-86.216h-86.216c-20.525 12.186-44.388 19.039-69.569 19.039z" fill="#0f9d58"></path><path d="m139.131 325.477-86.308 86.308c6.782 8.808 14.167 17.243 22.158 25.235 48.352 48.351 112.639 74.98 181.019 74.98v-120c-49.624 0-93.117-26.72-116.869-66.523z" fill="#31aa52"></path><path d="m512 256c0-15.575-1.41-31.179-4.192-46.377l-2.251-12.299h-249.557v120h121.452c-11.794 23.461-29.928 42.602-51.884 55.638l86.216 86.216c8.808-6.782 17.243-14.167 25.235-22.158 48.352-48.353 74.981-112.64 74.981-181.02z" fill="#3c79e6"></path><path d="m352.167 159.833 10.606 10.606 84.853-84.852-10.606-10.606c-48.352-48.352-112.639-74.981-181.02-74.981l-60 60 60 60c36.326 0 70.479 14.146 96.167 39.833z" fill="#cf2d48"></path><path d="m256 120v-120c-68.38 0-132.667 26.629-181.02 74.98-7.991 7.991-15.376 16.426-22.158 25.235l86.308 86.308c23.753-39.803 67.246-66.523 116.87-66.523z" fill="#eb4132"></path></g></svg>	&nbsp;Login with Google</button>
                
                
            </div>

        </div>
    </div>

</center>
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