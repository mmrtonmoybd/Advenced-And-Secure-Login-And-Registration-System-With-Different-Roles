<?php include('header.php'); ?>
     <div class="container bg-white p-3">
	 <div class="row justify-content-center">
  <div class="col-sm-6">
    <div class="card bg-white rounded shadow-lg mb-5">
      <div class="card-body">
	  
          <?php
          echo form_open(base_url('login'));
          ?>
          <h2 class="text-info" align="center">Login</h2>
       <?php 
       $session = session();
       if (!empty($session->getFlashdata('ipass'))) : ?>
       <div class="alert alert-danger">
          <?= esc($session->getFlashdata('ipass')) ?>
          </div>
          <?php endif ?>
          <?php if (!empty($session->getFlashdata('active'))) : ?>
          <div class="alert alert-danger">
          <?= esc($session->getFlashdata('active')) ?>
          </div>
          <?php endif ?>
          <?= \Config\Services::validation()->listErrors('custom') ?>
          <?= csrf_field() ?>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
  <?php echo form_close(); ?>
</div>
    </div>
  </div>
  </div>
       </div>
      <?php include('footer.php'); ?>