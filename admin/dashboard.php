<?php include "./header.php"; ?>
<script>
    loading(true)
    // login verification
    firebase.auth().onAuthStateChanged((user) => {
        if (user) {
            uid = user.uid
            if (user.uid != null) {
                firebase.database().ref('Admin/' + user.uid).on('value', (snapshot) => {
                    if (snapshot.hasChild('name')) {
                        fetchData(uid)
                    } else {
                        document.location = './index.php';
                    }
                });
            }


        } else {
            alert('User Validation Failed')
            document.location = './index.php'
        }
    })

    function loading(flag) {
        if (flag) {
            document.getElementById('mainContainerDiv').style.visibility = "hidden"
            document.getElementById('loading').style.visibility = "visible"
        } else {
            document.getElementById('mainContainerDiv').style.visibility = "visible"
            document.getElementById('loading').style.visibility = "hidden"
        }
    }
    function fetchData(uid){
        firebase.database().ref('Admin/' + uid).on('value', (snapshot) => {
        const data = snapshot.val()

        document.getElementById('name').innerHTML = data.name;
        firebase.storage().ref('images/' + uid).getDownloadURL()
            .then((url) => {
                var img = document.getElementById('profileImage');
                img.setAttribute('src', url);
            })
            .catch((error) => {
                var img = document.getElementById('profileImage');
                img.setAttribute('src', '../img/blank.jpg');
            });
    }
</script>

<div class="container" id="mainContainerDiv">
    <center>
        <h2>
            Dashboard
        </h2>
        <hr class="hr">
        <div class="row">
            <div class="col-md-6">
                <br>
                <img src="../img/blank.png" id="profileImage" alt="fetching" height="200px" width="200px" style="object-fit: cover;" class="rounded-circle">
                <h3 class="mt-2">
                    Welcome
                </h3>
                <h3>
                    <span id="name" style="font-family: 'Times New Roman', Times, serif;">
                        Admin
                    </span>
                </h3>
            </div>

            <div class="col-md-6">
                <center>
                    <div class="card" style="background-color: rgba(255, 255, 255, 0.2); margin: 20px;">
                        <div class="card-body">
                            <h3>
                                Users
                            </h3>

                            <br><br>
                            <h3 id="usercount">
                                000000
                            </h3>
                        </div>
                    </div>
                </center>
            </div>


        </div>
    </center>
</div>

<?php include "./footer.php"; ?>