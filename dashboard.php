<?php include "./header.php"; ?>

<div class="container" id="mainContainerDiv"> 
    <center>
        <h2>
            Dashboard
        </h2>
        <hr class="hr">
        <div class="row">
            <div class="col-lg-3">
                <br>
                <img src="./img/blank.png"  id="profileImage" alt="fetching" height="200px" width="200px" style="object-fit: cover;" class="rounded-circle">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="./JS/dashboard.js"></script>
<?php include "./footer.php"; ?>