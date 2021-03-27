<?php include "./header.php"; ?>

<script>
    if (confirm("Are you sure you want to Logout? ")) {
        firebase.auth().signOut().then(() => {
            document.location = './index.php';
        }).catch((error) => {
            alert("Logout Unsucessful");
        });
    } else {
        document.location = './dashboard.php';
    }
</script>
<?php include "./footer.php"; ?>