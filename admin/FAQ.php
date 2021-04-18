<?php include "./header.php"; ?>
    <script>
         firebase.auth().onAuthStateChanged((user)=>{

        if(user){
            uid = user.uid
            
        }else{
            alert('Admin Not Login Please Login')
            document.location='./'
        }
    })
   
    function submitdata(){
        var ans = document.getElementById('ans').value 
        var que = document.getElementById('que').value
        var id= "<?php echo uniqid(); ?>"
        firebase.auth().onAuthStateChanged((user) => {
            if (user) {
                firebase.database().ref('FAQ/'+id).set({
                    answer:ans,
                    question:que,
                    id:id
                }).then((result) => {
                    alert("FAQ Added")
                    document.location='./FAQ.php'
                }).catch((err) => {
                    alert('Error : '+err)
                    // document.location='./changeGoal.php'
                });
            }
        });
        return false;
    }
    </script>

<!-- <form action="#" onsubmit="return submitdata();" method="post"> -->
<!--use above statement-->
<!-- start of frontend code -->
<form action="#" onsubmit="return submitdata();" method="post">
<input type="text" name="que" id="que"><br>
<input type="text" name="ans" id="ans"><br>
<input type="submit" value="Submit">
</form>
<!-- end of frontend code -->

<?php include "./footer.php"; ?>