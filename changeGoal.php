<?php include "./header.php"; ?>
    
<div id="mainContainerDiv">
<!--use above statement-->
<!-- start of frontend code -->
<div class=" mx-auto mt-4" style=" border: 2px solid lightgrey; border-radius: 10px; width: 50%; ">
<form onsubmit="return submitdata();"  method="post" >
  <div class="form-group mx-4 mt-3">
    <label for="stepGoal">Step Goal:</label>
    <input type="number" class="form-control" id="stepGoal" >
    
  </div>
  <div class="form-group mx-4">
    <label for="caloriesGoal">Calories Goal:</label>
    <input type="number" class="form-control" id="caloriesGoal" >
  </div>
  <div class="text-center mb-3">
  <button type="submit" class="btn btn-primary text">Update</button></div>
</form>
</div>
<!-- end of frontend code -->
</div>
<script src="./JS/changeGoal.js"></script>
<?php include "./footer.php"; ?>