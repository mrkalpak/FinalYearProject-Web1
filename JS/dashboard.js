var stepGoal = 0
var calorieGoal = 0
var dates = []
var steps = []
// document.getElementById('mainContainerDiv').style.visibility="hidden"
// document.getElementById('loading').style.visibility="visible"

// login verification
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
        uid = user.uid
        fetchData(uid)

    } else {
        alert('User Validation Failed')
        document.location = './'
    }
})
// fetching data

function fetchData(uid) {
    firebase.database().ref('Users/' + uid).on('value', (snapshot) => {
        const data = snapshot.val()

        document.getElementById('name').innerHTML = data.name;
        firebase.storage().ref('images/' + uid).getDownloadURL()
            .then((url) => {
                var img = document.getElementById('profileImage');
                img.setAttribute('src', url);
            })
            .catch((error) => {
                var img = document.getElementById('profileImage');
                img.setAttribute('src', './img/blank.jpg');
            });
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        var today = yyyy + '-' + mm + '-' + dd;
// fetching steps
        firebase.database().ref('Data/' + uid + "/" + today).on('value', (snapshot1) => {
            var steps = snapshot1.val().steps == undefined ? 0 : snapshot1.val().steps

            firebase.database().ref('Goals/' + uid).on('value', (snapshot2) => {

                var stepGoal = snapshot2.val().stepsGoal
                var calorieGoal = snapshot2.val().caloriesGoal
                document.getElementById('stepProgress').innerHTML = steps + "/" + stepGoal
                if (parseFloat(steps) >= parseFloat(stepGoal)) {
                    document.getElementById('stepProgress').innerHTML = document.getElementById('stepProgress').innerHTML + "<br>Goal Achieved..."
                } else {
                    document.getElementById('stepProgress').innerHTML = document.getElementById('stepProgress').innerHTML + "<br>Remaining Goal = \
                        " + (parseInt(stepGoal) - parseInt(steps))
                }
                var percent = (parseInt(steps) * 100) / parseInt(stepGoal)
                document.getElementById('stepProgressBar').setAttribute('style', 'width:' + percent + '%;')
                document.getElementById('stepProgressBar').setAttribute('aria-valuenow', percent)

                var calories = parseInt(steps) * 0.04
                var caloriesPercent = parseInt(calories) * 100 / parseInt(calorieGoal)
                document.getElementById('caloriesProgressBar').setAttribute('style', 'width:' + caloriesPercent + '%;')
                document.getElementById('caloriesProgressBar').setAttribute('aria-valuenow', percent)
                document.getElementById('calorieProgress').innerHTML = parseFloat(calories).toFixed(2) + " / " + calorieGoal
                if (parseFloat(calories) >= parseFloat(calorieGoal)) {
                    document.getElementById('calorieProgress').innerHTML = document.getElementById('calorieProgress').innerHTML + "<br>Goal Achieved..."
                } else {
                    document.getElementById('calorieProgress').innerHTML = document.getElementById('calorieProgress').innerHTML + "<br>Remaining Goal =\
                        " + parseFloat(parseFloat(calorieGoal) - parseFloat(calories)).toFixed(2)
                }
            })
        })
        alert("heyehjhkjha")
        // document.getElementById('loading').style.visibility="hidden"
        // document.getElementById('mainContainerDiv').style.visibility="visible"
    })
// printing table
    firebase.database().ref('Data/' + uid).on('value', (s) => {
        var d = s.val()
        var rows = []
        s.forEach(element => {
            rows.push([element.key, element.val().steps])
        });
        var x = 0
        document.getElementById('statisticsBody').innerHTML = ""

        if (rows.length > 5) {
            for (i = rows.length - 1; i >= rows.length - 5; i--) {
                addRow(rows[i][0], rows[i][1])
                x = x + 1
                if (x >= 10) {
                    return
                }
            }
        } else {
            for (i = rows.length - 1; i >= 0; i--) {
                addRow(rows[i][0], rows[i][1])
                x = x + 1
                if (x >= 10) {
                    return
                }
            }
        }
        x = 0
        dates = []
        steps = []

        i = rows.length - 5
        if (i < 0)
            i = 0
        for (; i < rows.length; i++) {
            x = x + 1
            dates.push(rows[i][0])
            steps.push(rows[i][1])
            if (x >= 10) {
                return
            }
        }

        drawChart()
    })
}
    function addRow(date, steps){
        var parent = document.getElementById('statisticsBody')
        var tr = document.createElement('tr')
        var td1 = document.createElement('td')
        var td2 = document.createElement('td')
        var td3 = document.createElement('td')
        td1.setAttribute('style','text-align: center;')
        td2.setAttribute('style','text-align: center;')
        td3.setAttribute('style','text-align: center;')
        td1.innerHTML=date
        td2.innerHTML=steps
        td3.innerHTML=parseFloat(parseInt(steps)*0.04).toFixed(2)
        tr.appendChild(td1)
        tr.appendChild(td2)
        tr.appendChild(td3)
        parent.appendChild(tr)

    }








// chart code
var myBarChart = null
function drawChart(){
    var ctxB = document.getElementById("barChart").getContext('2d');
        myBarChart = new Chart(ctxB, {
        type: 'bar',
        data: {
            labels: dates,
            datasets: [{
            label:null,
            data: steps,
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
            }]
        },
        optionss: {
            scales: {
            yAxes: [{
                ticks: {
                beginAtZero: true
                }
            }]
            }
        }
        });
    }