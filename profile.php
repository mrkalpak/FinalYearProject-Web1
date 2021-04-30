<?php include "./header.php"; ?>
<style>
    .profile-pic-div {
        height: 150px;
        width: 150px;
        position: relative;
        top: 10%;
        left: 50%;
        transform: translate(-50%, 0%);
        border-radius: 50%;
        overflow: hidden;
        border: 1px solid grey;
    }

    #photo {
        height: 100%;
        width: 100%;
    }
    #uploadBtn {
  height: 30px;
  width: 100%;
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  text-align: center;
  background: rgba(0, 0, 0, 0.7);
  color: wheat;
  line-height: 30px;
  font-family: sans-serif;
  font-size: 15px;
  cursor: pointer;
  display: none;
}

    #file {
        display: none;
    }
</style>
<div id="mainContainerDiv">
<div class=" mx-auto mt-3 mb-3" style=" border: 2px solid lightgrey; border-radius: 10px; width: 50%; ">

    <div class="profile-pic-div mt-3" >
        <img src="./img/blank.png" id="photo" style="object-fit: cover;">
        <input type="file" accept="image/*" id="file">
        <label for="file" id="uploadBtn">Choose Photo</label>
    </div>
    <div class="content">
        <form method="POST" onsubmit="return submitdata();">
            <div class="form-row">
                <div class="form-group mx-2 col mt-3">
                    <label for="name">Name :</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group mx-2 col mt-3">
                    <label for="phone">Phone :</label>
                    <input type="number" class="form-control" id="phone">
                </div>
            </div>
            <div class="form-row">
            <div class="form-group mx-2 col mt-3">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email">
            </div>

            <div class="form-group mx-2 col mt-3">
                <label for="height">Height :</label>
                <input type="number" class="form-control" id="height">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group mx-2 col mt-3">
                <label for="weight">Weight :</label>
                <input type="number" class="form-control" id="weight">
            </div>
            <div class="form-group mx-2 col mt-3">
                <label for="">Gender :</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>
            </div>

    </div>
    <div class="text-center mb-3">
        <button type="submit" class="btn btn-primary text w-25">Update</button>
    </div>

    </form>
    <center><a href="" onclick="return resetpass() ">Click here for reset password</a></center>
</div>
</div>
</div>
<script src="./JS/profile.js"></script>
<?php include "./footer.php"; ?>