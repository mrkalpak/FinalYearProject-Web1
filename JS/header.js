firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        uid = user.uid

        hgetData(uid)

    } else {
        alert('User Validation Failed')
        document.location = './'
    }
})
// fetching data

function hgetData(uid) {
    firebase.database().ref('Users/' + uid).on('value', (snapshot) => {
        const data = snapshot.val()

        document.getElementById('user').innerHTML = data.name;
        firebase.storage().ref('images/' + uid).getDownloadURL()
            .then((url) => {
                var img = document.getElementById('profilepic');
                img.setAttribute('src', url);

            })
            .catch((error) => {
                var img = document.getElementById('profilepic');
                img.setAttribute('src', './img/image.jpg');
            });
    });
}