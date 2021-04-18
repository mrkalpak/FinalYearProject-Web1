<?php include "./header.php"; ?>

<div id="content" class="w-75 mx-auto">     
        <h3 class="text-center">
            FAQ
        </h3>     
</div>

<script>
  
  firebase.database().ref('FAQ').on('value', (snapshot) => {
    try {
      snapshot.forEach(s => {
        // console.log(s)
        const data = s.val();
        document.getElementById('content').innerHTML+= '<div class="card mt-3">\
  <div class="card-header">\
   '+data.question+'\
  </div>\
  <div class="card-body">\
    <blockquote class="blockquote mb-0">\
    '+data.answer+'\
    </blockquote>\
  </div>\
</div>'

  
      });
    } catch (e) {
      console.log(e);
    }
  })
</script>

 <?php include "./footer.php"; ?>