<?php include "./header.php"; ?>

<div id="mainContainerDiv">
    <div class=" mx-auto mt-3 mb-3" style=" border: 2px solid lightgrey; border-radius: 10px; width: 50%; ">
        <form method="POST" onsubmit="return submitdata();">
            <div class="form-group mx-2 ">
                <label for="que">Question :</label>
                <input type="text" class="form-control" name="que" id="que">
            </div>
            <div class="form-group mx-2">
                <label for="ans">Answer :</label>
                <input type="text" class="form-control" name="ans" id="ans">
            </div>
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary text w-25">Add</button>
            </div>
        </form>
    </div>
<div id="content" class="w-75 mx-auto">
    <h3 class="text-center">
        FAQ
    </h3>
</div>
</div>
<script>
  loading(true)
    // user validation
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
        firebase.database().ref('FAQ').on('value', (snapshot) => {
            try {
                snapshot.forEach(s => {
                    // console.log(s)
                    const data = s.val();
                    document.getElementById('content').innerHTML += '<div class="card my-3">\
                        <div class="card-header">\
                        ' + data.question + '\
                        </div>\
                        <div class="card-body">\
                        <blockquote class="blockquote mb-0">\
                        ' + data.answer + '\
                        </blockquote>\
                        </div>\
                        </div>'
                 
                    loading(false)
                });
            } catch (e) {
                console.log(e);
            }
        })
    }

    function submitdata() {
        loading(true)
        var ans = document.getElementById('ans').value
        var que = document.getElementById('que').value
        var id = "<?php echo uniqid(); ?>"
        firebase.auth().onAuthStateChanged((user) => {
            if (user) {
                firebase.database().ref('FAQ/' + id).set({
                    answer: ans,
                    question: que,
                    id: id
                }).then((result) => {
                    alert("FAQ Added")
                    document.location = './FAQ.php'
                }).catch((err) => {
                    alert('Error : ' + err)

                });
            }
        });
        return false;
        loading(false)
    }
</script>

<!-- end of frontend code -->

<?php include "./footer.php"; ?>