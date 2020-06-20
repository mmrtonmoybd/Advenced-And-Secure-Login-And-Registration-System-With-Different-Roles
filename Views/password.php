<?php include('header.php'); ?>
     <div class="container bg-white p-3">
	 <div class="row justify-content-center">
  <div class="col-sm-6 offset-md-4">
    <div class="card bg-white rounded shadow-lg mb-5">
      <div class="card-body">
	  
          <?php
          echo form_open(base_url("forget/password/{$username}/{$key}"));
          ?>
          <h2 class="text-info" align="center">Login</h2>
       <?php 
       $session = session();
       if (!empty($session->getFlashdata('ipass'))) : ?>
       <div class="alert alert-danger">
          <?= esc($session->getFlashdata('ipass')) ?>
          </div>
          <?php endif ?>
          <?php //$session = session();
      if (!empty($session->getFlashdata('success'))) : ?>
      <div class="alert alert-success">
      <p><?= esc($session->getFlashdata('success')) ?></p>
      </div>
      <?php endif; ?>
          <?php if (!empty($session->getFlashdata('active'))) : ?>
          <div class="alert alert-danger">
          <?= esc($session->getFlashdata('active')) ?>
          </div>
          <?php endif ?>
          <?= \Config\Services::validation()->listErrors('custom') ?>
          <?= csrf_field() ?>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
  </div>
  <div class="form-group">
    <label for="password">Confrim Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder=" Confrim Password" name="cpassword" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <?php echo form_close(); ?>
</div>
    </div>
  </div>
  </div>
       </div>
      <?php include('footer.php'); ?>