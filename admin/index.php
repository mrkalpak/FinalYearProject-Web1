<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Android Health Monitoring</title>
    <link rel="stylesheet" href="../css/style.css">

</head>


<body style="background-color: lightgrey;">
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-storage.js"></script>
    <script src="../JS/firebase-init.js"></script>

    <!-- boostrap code -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <center>
        <div id="loading" style="height:0px; visibility: hidden;  margin-left: 45%;position: absolute;top: 45%; -ms-transform: translateY(-50%);transform: translateY(-50%);">
            <center>
                <div class="loader"></div>
            </center>
        </div>
        <div id="mainContainerDiv">
            <div style=" 
    display:block;
    background-image: url('../img/1.png');
    background-size: 100% 100%;
    width: 350px;
    height: 90vh;
    max-height: 100%;
    background-repeat: no-repeat; 
    border:2px solid #767474;
    margin-top:2.5%;
    margin-bottom:1%; 
    border-radius: 10px 10px 10px 10px;
    ">


                <div class="row h-50">
                    <div class="col ">
                        <center><img src="../img/logo2.png" alt="profile" height="100px" width="100px" class="rounded-circle " style="margin-top: 75px;">
                            <h4 class="mt-2 text-white">Android Health Monitoring</h4>
                        </center>
                    </div>
                </div>
                <div class="row h-50">

                    <div class="col"></div>

                    <div class="w-100"></div>
                    <div class="col">
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
            </div>
            </center>
        </div>
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
                    // document.location = './'
                })
        </script>
    <?php
        exit;
    }
    ?>
    

    <?php include "./footer.php"; ?>