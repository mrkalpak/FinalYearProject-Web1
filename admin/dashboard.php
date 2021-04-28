<?php include "./header.php"; ?>

<div class="container" id="mainContainerDiv">
    <center>
        <h2>
            Dashboard
        </h2>
        <hr class="hr">
        <div class="row">
            <div class="col-md-6">
                <br>
                <img src="" id="profileImage" alt="fetching" height="200px" width="200px" style="object-fit: cover;" class="rounded-circle">
                <h3 class="mt-2">
                    Welcome
                </h3>
                <h3>
                    <span id="name" style="font-family: 'Times New Roman', Times, serif;">
                        Admin
                    </span>
                    
                    <svg onclick="document.location='./profile.php'" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="blue" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
                </h3>
            </div>

            <div class="col-md-6">
                <center>
                    <div class="card mt-5">
                        <div class="card-body">
                            <h3>
                                Users
                            </h3>

                            <br><br>
                            <h3 id="usercount">
                               
                            </h3>
                        </div>
                    </div>
                </center>
            </div>


        </div>
    </center>
</div>

<script>


    loading(true);
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

    

    function fetchData(uid) {
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
        });
        firebase.database().ref('Users').on('value', (snapshot) => {
            var count=0;
            try {
                snapshot.forEach(s => {
                    count++;
                });
                document.getElementById('usercount').innerHTML=count;
               
                loading(false);
            } catch (e) {
                console.log(e);
            }
        })
    }
</script>
<?php include "./footer.php"; ?>