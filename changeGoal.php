<?php include "./header.php"; ?>
    <script>
         firebase.auth().onAuthStateChanged((user)=>{

        if(user){
            uid = user.uid
            getdata(uid)
        }else{
            alert('User Not Login Please Login')
            document.location='./'
        }
    })
    function getdata(uid) {
       
        firebase.database().ref('Goals/'+uid).on('value',(snapshot)=>{
        const data = snapshot.val()
        document.getElementById('stepGoal').value = data.stepGoal; 
        document.getElementById('caloriesGoal').value = data.caloriesGoal;        
        })
    }
    function submitdata(){
        var stepGoal = document.getElementById('stepGoal').value 
        var caloriesGoal = document.getElementById('caloriesGoal').value
        firebase.auth().onAuthStateChanged((user) => {
            if (user) {
                firebase.database().ref('Goals/'+user.uid).set({
                    stepGoal:stepGoal,
                    caloriesGoal:caloriesGoal
                }).then((result) => {
                    alert('Your new Step Goal is '+stepGoal+' and Calories Goal is '+caloriesGoal)
                    // document.location='./changeGoal.php'
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
<!-- end of frontend code -->

<?php include "./footer.php"; ?>