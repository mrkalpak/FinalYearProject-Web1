<?php include "./header.php"; ?>
<script>
  var database = firebase.database();
  var queid;
  firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      uid = user.uid
      fetchData(uid)

    } else {
      alert('User Validation Failed')
      document.location = './'
    }
  })

  function fetchData(uid) {
    
     firebase.database().ref('Users/' + uid).on('value', (snapshot) => {
        const data = snapshot.val();
        document.getElementById('name').setAttribute('value',""+data.name)
        document.getElementById('email').setAttribute('value',""+data.email)
      });
     firebase.database().ref('questions').on('value', (snapshot) => {
        const data = snapshot.val();
        queid= data.count
      });

    }
    function submitdata(){
        var name = document.getElementById('name').value 
        var email = document.getElementById('email').value
        var title = document.getElementById('title').value
        var question = document.getElementById('question').value
        firebase.auth().onAuthStateChanged((user) => {
            if (user) {
              ++queid;
                firebase.database().ref('Questions/'+queid).set({
                    name:name,
                    email:email,
                    title:title,
                    question:question
                  
                }).then((result) => {
                  firebase.database().ref('Questions').set({
                   count:queid
                }).then((result) => {
                    // alert('We answer you shortly')
                    // document.location='./changeGoal.php'
                }).catch((err) => {
                    alert('Error : '+err)
                    // document.location='./changeGoal.php'
                });
                    alert('We answer you shortly')
                    
                }).catch((err) => {
                    alert('Error : '+err)
                    
                });
               
            }
        });
        return false;
    }
</script>
<div class="container my-3 " style="width: 50%; border: 2px solid lightgrey; border-radius: 10px;">
  <form method="POST" action="" onsubmit="return submitdata()">

    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" readonly class="form-control" name="name" id="name">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" readonly class="form-control" name="email" id="email" value="">
    </div>
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" >
    </div>
    <div class="form-group">
      <label for="question">Question</label>
      <textarea name="question" id="question" cols="30" rows="5" class="form-control"></textarea>
      <div class="text-center my-3">
        <button type="submit" class="btn btn-primary text">Submit</button>
      </div>
    </div>


  
    <?php include "./footer.php"; ?>