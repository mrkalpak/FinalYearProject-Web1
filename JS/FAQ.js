document.getElementById('mainContainerDiv').style.visibility="hidden"
document.getElementById('loading').style.visibility="visible"

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
document.getElementById('loading').style.visibility="hidden"
        document.getElementById('mainContainerDiv').style.visibility="visible"
  
      });
    } catch (e) {
      console.log(e);
    }
  })