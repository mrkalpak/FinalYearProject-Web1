<?php include "./header.php"; ?>

<div class="container text-center mt-4" style="border: 2px solid lightgrey; border-radius: 10px; ">
    <table class="table">
        <thead class="thead-light">

            <tr>
                <th scope="col">UID</th>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Email</th>
                <th scope="col">Contact No.</th>
                

            </tr>
        </thead>
        <tbody id="content">


        </tbody>
    </table>
</div>

<script>
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
        console.log('in')
        firebase.database().ref('Users').on('value', (snapshot) => {
            console.log('in1')
            try {
                var i=1;
                snapshot.forEach(s => {
                    console.log(s)
                    const data = s.val();
                    document.getElementById('content').innerHTML += "<tr><th scope='row'>" + i + "</th><td>" + data.name + "</td><td>" + data.gender + "</td><td>" + data.email + "</td><td>" + data.phone + "</td></tr>"
                    i++;

                });
            } catch (e) {
                console.log(e);
            }
        })

    }
     
</script>
<?php include "./footer.php"; ?>