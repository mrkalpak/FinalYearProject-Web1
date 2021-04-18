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
<div class=" mx-auto mt-3 mb-3" style=" border: 2px solid lightgrey; border-radius: 10px; width: 50%; ">

    <div class="profile-pic-div mt-3" >
        <img src="./img/blank.png" id="photo" style="object-fit: cover;">
        <input type="file" accept="image/*" id="file">
        <label for="file" id="uploadBtn">Choose Photo</label>
    </div>
    <div class="content">
        <form method="POST" onsubmit="return submitdata();">
            <div class="form-row">
                <div class="form-group mx-2 col mt-3">
                    <label for="name">Name :</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group mx-2 col mt-3">
                    <label for="phone">Phone :</label>
                    <input type="number" class="form-control" id="phone">
                </div>
            </div>
            <div class="form-row">
            <div class="form-group mx-2 col mt-3">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email">
            </div>

            <div class="form-group mx-2 col mt-3">
                <label for="height">Height :</label>
                <input type="number" class="form-control" id="height">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group mx-2 col mt-3">
                <label for="weight">Weight :</label>
                <input type="number" class="form-control" id="weight">
            </div>
            <div class="form-group mx-2 col mt-3">
                <label for="">Gender :</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>
            </div>

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
  var gender = "none";
  var Imgname, ImgUrl;

  

  // user validation
  firebase.auth().onAuthStateChanged((user) => {

    if (user) {
      uid = user.uid
      getdata(uid)
    } else {
      alert('User Not Login Please Login')
      document.location = './'
    }
  });

  function submitdata() {
    var name = document.getElementById('name').value
    var phone = document.getElementById('phone').value
    var email = document.getElementById('email').value
    var height = document.getElementById('height').value
    var weight = document.getElementById('weight').value
    // // var gender = document.getElementsByName('gender').value
    // console.log(gender)
    // if(gender==undefined){
    //   gender="none";
    // }

    firebase.auth().onAuthStateChanged((user) => {
      if (user) {
        console.log(user.uid);
        firebase.database().ref('Users/' + user.uid).update({
          email: email,
          gender: gender,
          height: height,
          name: name,
          phone: phone,
          weight: weight

        }).then((result) => {
          alert("Profile Updated")
          // document.location='./changeGoal.php'
        }).catch((err) => {
          alert('Error : ' + err)
          // document.location='./changeGoal.php'
        });

      }
    });
    return false;
  }



  // getting data
  function getdata(uid) {

    firebase.database().ref('Users/' + uid).on('value', (snapshot) => {
      const data = snapshot.val()
      document.getElementById('name').value = data.name
      document.getElementById('phone').value = data.phone
      document.getElementById('email').value = data.email
      document.getElementById('height').value = data.height
      document.getElementById('weight').value = data.weight
      document.getElementById(data.gender).checked=true;

      // var storage = firebase.storage();
      firebase.storage().ref('images/' + uid).getDownloadURL()
        .then((url) => {
          var img = document.getElementById('photo');
          img.setAttribute('src', url);
          
        })
        .catch((error) => {
          var img = document.getElementById('photo');
          img.setAttribute('src', "./img/blank.png");
          
        });

    });
    return false;
  }


  // resset passs 
  function resetpass(){
  firebase.auth().sendPasswordResetEmail(firebase.auth().currentUser.email).then(function () {
    alert("Email Sent!!!!!!!!!!!!!")
  }).catch(function (error) {
    // An error happened.
  });
  return false;
}




  //if user hover on img div 

  imgDiv.addEventListener('mouseenter', function () {
    uploadBtn.style.display = "block";
  });

  //if we hover out from img div

  imgDiv.addEventListener('mouseleave', function () {
    uploadBtn.style.display = "none";
  });

  //lets work for image showing functionality when we choose an image to upload

  //when we choose a phooto to upload

  file.addEventListener('change', function () {
    //this refers to file
    const choosedFile = this.files[0];

    if (choosedFile) {

      const reader = new FileReader(); //FileReader is a predefined function of JS

      reader.addEventListener('load', function () {
        img.setAttribute('src', reader.result);

      });

      reader.readAsDataURL(choosedFile);
      var uploadTask = firebase.storage().ref('images/' + uid).put(this.files[0]);

    }
  });
</script>


<?php include "./footer.php"; ?>