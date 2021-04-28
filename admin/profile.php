<?php include "./header.php"; ?>
<style>
    .profile-pic-div {
        height: 150px;
        width: 150px;
        position: relative;
        top: 10%;
        left: 50%;
        transform: translate(-50%, 0%);
        border-radius: 50%;
        overflow: hidden;
        border: 1px solid grey;
    }

    #photo {
        height: 100%;
        width: 100%;
    }

    #uploadBtn {
        height: 30px;
        width: 100%;
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        background: rgba(0, 0, 0, 0.7);
        color: wheat;
        line-height: 30px;
        font-family: sans-serif;
        font-size: 15px;
        cursor: pointer;
        display: none;
    }

    #file {
        display: none;
    }
</style>
<div id="mainContainerDiv">
    <div class=" mx-auto mt-3 mb-3" style=" border: 2px solid lightgrey; border-radius: 10px; width: 50%; ">

        <div class="profile-pic-div mt-3">
            <img src="../img/blank.png" id="photo" style="object-fit: cover;">
            <input type="file" accept="image/*" id="file">
            <label for="file" id="uploadBtn">Choose Photo</label>
        </div>

        <form method="POST" onsubmit="return submitdata();">

            <div class="form-group mx-2 ">
                <label for="name">Name :</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group mx-2">
                <label for="phone">Phone :</label>
                <input type="number" class="form-control" id="phone">
            </div>

            <div class="form-group mx-2 ">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email">
            </div>



            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary text w-25">Update</button>
            </div>

        </form>
        <center><a href="" onclick="return resetpass() ">Click here for reset password</a></center>

    </div>
</div>
<script>
    const imgDiv = document.querySelector('.profile-pic-div');
    const img = document.querySelector('#photo');
    const file = document.querySelector('#file');
    const uploadBtn = document.querySelector('#uploadBtn');
 
    loading(true)


    // user validation
    firebase.auth().onAuthStateChanged((user) => {
        if (user) {
            uid = user.uid
            if (user.uid != null) {
                firebase.database().ref('Admin/' + user.uid).on('value', (snapshot) => {
                    if (snapshot.hasChild('name')) {
                        getdata(uid)
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

    function submitdata() {
        loading(true)
        var name = document.getElementById('name').value
        var phone = document.getElementById('phone').value
        var email = document.getElementById('email').value
      

        firebase.auth().onAuthStateChanged((user) => {
            if (user) {
                // console.log(user.uid);
                firebase.database().ref('Admin/' + user.uid).update({
                    email: email,
                    name:name,
                    phone:phone

                }).then((result) => {

                    alert("Profile Updated")
                    // document.location='./changeGoal.php'
                }).catch((err) => {
                    alert('Error : ' + err)
                    // document.location='./changeGoal.php'
                });

            }
        });
        loading(false)
        return false;
    }



    // getting data
    function getdata(uid) {

        firebase.database().ref('Admin/' + uid).on('value', (snapshot) => {
            const data = snapshot.val()
            document.getElementById('name').value = data.name
            document.getElementById('phone').value = data.phone
            document.getElementById('email').value = data.email
           
            // var storage = firebase.storage();
            firebase.storage().ref('images/' + uid).getDownloadURL()
                .then((url) => {
                    var img = document.getElementById('photo');
                    img.setAttribute('src', url);
                    loading(false)

                })
                .catch((error) => {
                    var img = document.getElementById('photo');
                    img.setAttribute('src', "../img/blank.png");

                });

        });
        loading(false)
        return false;
    }


    // resset passs 
    function resetpass() {
        firebase.auth().sendPasswordResetEmail(firebase.auth().currentUser.email).then(function() {
            alert("Email Sent!!!!!!!!!!!!!")
        }).catch(function(error) {
            // An error happened.
        });
        return false;
    }




    //if user hover on img div 

    imgDiv.addEventListener('mouseenter', function() {
        uploadBtn.style.display = "block";
    });

    //if we hover out from img div

    imgDiv.addEventListener('mouseleave', function() {
        uploadBtn.style.display = "none";
    });

    //lets work for image showing functionality when we choose an image to upload

    //when we choose a phooto to upload

    file.addEventListener('change', function() {
        //this refers to file
        const choosedFile = this.files[0];

        if (choosedFile) {

            const reader = new FileReader(); //FileReader is a predefined function of JS

            reader.addEventListener('load', function() {
                img.setAttribute('src', reader.result);

            });

            reader.readAsDataURL(choosedFile);
            var uploadTask = firebase.storage().ref('images/' + uid).put(this.files[0]);

        }
    });
</script>


<?php include "./footer.php"; ?>