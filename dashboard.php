<?php include "./header.php"; ?>
<style>
    .hr{
    height: 0.5px;
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
}
</style>
<div class="container" id="mainContainerDiv"> 
    <center>
        <h2>
            Dashboard
        </h2>
        <hr class="hr">
        <div class="row">
            <div class="col-lg-3">
                <br>
                <img src="./img/blank.png"  id="profileImage" alt="fetching" height="200px" width="200px" class="rounded-circle">
                <h3 class="mt-2">
                    Welcome
                </h3>
                <h3>
                    <span id="name"  style="font-family: 'Times New Roman', Times, serif;">
                       User 
                    </span>
                </h3>
            </div>
            <div class="col-lg-9">
                <h4>
                    Your Statistics
                </h4>
                <hr class="hr" style="width: 90%;">
                <div class="row">
                    <div class="col-md-6">
                        <center>
                            <div class="card" style="background-color: rgba(255, 255, 255, 0.2); margin: 20px;" >
                                <div class="card-body">
                                    <h3>
                                        Steps
                                    </h3>
                                    <br>
                                    <br>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar" id="stepProgressBar" role="progressbar" style="width: 1%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <br><br>
                                    <h3 id="stepProgress">
                                        1/100
                                    </h3>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="col-md-6">
                        <center>
                            
                            <div class="card" style="background-color: rgba(255, 255, 255, 0.2); margin: 20px;" >
                                <div class="card-body">
                                    <h3>
                                        Calories
                                    </h3>    
                                    <br>
                                    <br>
                                    <div class="progress" style="height: 20px;">
                                        <div id="caloriesProgressBar" class="progress-bar" role="progressbar" style="width: 1%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <br><br>
                                    <h3 id="calorieProgress">
                                        1/100
                                    </h3>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <center>
        <hr class="hr">
        <h3>
            History
        </h3>    
        <hr class="hr">
    </center>
    <div class="row" id="statistics">
        <div class="col-md-6" id="barChartDiv">
            <canvas class="my-4"  id="barChart" ></canvas>
        </div>
        <div class="col-md-6">
            <table class="table text-center table-hover table-stripped">
                <thead>
                    <th>
                      
                            Date
                        
                    </th>
                    <th>
                       
                            Steps
                       
                    </th>
                    <th>
                        
                            Calories
                      
                    </th>
                </thead>
                <tbody id="statisticsBody" style="overflow: scroll;"></tbody>
            </table>
        </div>
    </div>
</div>
<script>
    var stepGoal = 0
    var calorieGoal = 0
    var dates = []
    var steps = []
    firebase.auth().onAuthStateChanged((user)=>{
        if(user){
            uid = user.uid
            fetchData(uid)
            
        }else{
            alert('User Validation Failed')
            document.location='./'
        }
    })

    function fetchData(uid){
        firebase.database().ref('Users/'+uid).on('value',(snapshot)=>{
            const data = snapshot.val()
            if(data.image=="default"){
                document.getElementById('profileImage').setAttribute('src','./img/blank.png')
            }else{
                document.getElementById('profileImage').setAttribute('src',''+data.image)
            }
            document.getElementById('name').innerHTML=data.name;
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
            var today = yyyy + '-' + mm + '-' + dd ; 
    
            firebase.database().ref('Data/'+uid+"/"+today).on('value',(snapshot1)=>{
                firebase.database().ref('Goals/'+uid).on('value',(snapshot2)=>{
                    var steps = snapshot1.val().steps
                    var stepGoal = snapshot2.val().stepGoal
                    var calorieGoal = snapshot2.val().caloriesGoal
                    document.getElementById('stepProgress').innerHTML=steps+"/"+stepGoal
                    if(parseFloat(steps)>=parseFloat(stepGoal)){
                        document.getElementById('stepProgress').innerHTML=document.getElementById('stepProgress').innerHTML+"<br>Goal Achieved..."
                    }else{
                        document.getElementById('stepProgress').innerHTML=document.getElementById('stepProgress').innerHTML+"<br>Remaining Goal = \
                        "+(parseInt(stepGoal)-parseInt(steps))
                    }
                    var percent = (parseInt(steps)*100)/parseInt(stepGoal)
                    document.getElementById('stepProgressBar').setAttribute('style','width:'+percent+'%;')
                    document.getElementById('stepProgressBar').setAttribute('aria-valuenow',percent)

                    var calories = parseInt(steps)*0.04
                    var caloriesPercent = parseInt(calories)*100/parseInt(calorieGoal)
                    document.getElementById('caloriesProgressBar').setAttribute('style','width:'+caloriesPercent+'%;')
                    document.getElementById('caloriesProgressBar').setAttribute('aria-valuenow',percent)
                    document.getElementById('calorieProgress').innerHTML = parseFloat(calories).toFixed(2)+" / "+calorieGoal
                    if (parseFloat(calories)>=parseFloat(calorieGoal)){
                        document.getElementById('calorieProgress').innerHTML = document.getElementById('calorieProgress').innerHTML+"<br>Goal Achieved..."
                    }else{
                        document.getElementById('calorieProgress').innerHTML = document.getElementById('calorieProgress').innerHTML+"<br>Remaining Goal =\
                        "+parseFloat(parseFloat(calorieGoal)-parseFloat(calories)).toFixed(2)
                    }
                })
            })
            
        })
        firebase.database().ref('Data/'+uid).on('value',(s)=>{
            var d = s.val()
            var rows = []
            s.forEach(element => {
                rows.push([element.key,element.val().steps])
            });
            var x = 0
            document.getElementById('statisticsBody').innerHTML=""
            for(i=rows.length-1;i>=rows.length-5;i--){
                addRow(rows[i][0],rows[i][1])
                x=x+1
                if(x>=10){
                    return
                }
            }
            x=0
            dates = []
            steps = []
            for(i=rows.length-5;i<rows.length;i++){
                x=x+1
                dates.push(rows[i][0])
                steps.push(rows[i][1])
                if(x>=10){
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
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>


<script>

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
</script>
<?php include "./footer.php"; ?>