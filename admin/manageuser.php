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
        firebase.database().ref('User').on('value', (snapshot) => {
            try {
                snapshot.forEach(s => {
                    console.log(s)
                    const data = s.val();
                    document.getElementById('content').innerHTML += "<tr><th scope='row'>" + data.uId + "</th><td>" + data.name + "</td><td>" + data.gender + "</td><td>" + data.email + "</td><td>" + data.phone + "</td><td><a onclick='deleteUser(" + data.uId + ")'><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='red' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></a></td></tr>"


                });
            } catch (e) {
                console.log(e);
            }
        })

    }
</script>
<?php include "./footer.php"; ?>