<?php include('header.php'); ?>
     <div class="container-fluid pt-3 pb-3 bg-white">
	 <div class="row justify-content-sm-center">
  <div class="col-sm-6">
    <div class="card bg-white p-3 rounded shadow-lg mb-5">
      <div class="card-body">
	  
          <form class="" method="POST" action="register">
          <h2 class="text-info" align="center">Registration</h2>
          <?php if (! empty($errors)) : ?> 
       <?php foreach ($errors as $field => $error) : ?> <div class="alert alert-danger">
       <p><?= $error ?></p></div> <?php endforeach ?> <?php endif ?>
       <?php if (! empty($errorsi)) : ?> 
       <?php foreach ($errorsi as $field => $error) : ?> <div class="alert alert-danger">
       <p><?= $error ?></p></div> <?php endforeach ?> <?php endif ?>
          <?= \Config\Services::validation()->listErrors('custom') ?>
          <?= csrf_field() ?>
          <div class="form-group">
    <label for="name">Your full name</label>
    <input type="text" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Enter name" name="name" required>
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
    <small id="emailHelp" class="form-text text-muted">We will never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="exampleInputUsername1" aria-describedby="usernameHelp" placeholder="Enter username" name="username" required>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
  </div>
  <div class="form-group">
    <label for="cpassword">Confirm password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm password" name="cpassword" required>
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>
</div>
    </div>
  </div>
  </div>
       </div>
    <?php include('footer.php'); ?>