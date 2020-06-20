<?php include('header.php'); ?>
     <div class="container bg-white p-3">
	 <div class="row justify-content-center">
  <div class="col-sm-6 offset-md-4">
    <div class="card bg-white rounded shadow-lg mb-5">
      <div class="card-body">
	  
          <?php
          echo form_open(base_url('forget/password'));
          ?>
          <h2 class="text-info" align="center">Forget Password</h2>
       <?php 
       $session = session();
       if (!empty($session->getFlashdata('notfound'))) : ?>
       <div class="alert alert-danger">
          <?= esc($session->getFlashdata('notfound')) ?>
          </div>
          <?php endif ?>
          <?php
          if (!empty($session->getFlashdata('exist'))) : ?>
       <div class="alert alert-danger">
          <?= esc($session->getFlashdata('exist')) ?>
          </div>
          <?php endif ?>
          <?php
          if (!empty($session->getFlashdata('success'))) : ?>
       <div class="alert alert-success">
          <?= esc($session->getFlashdata('success')) ?>
          </div>
          <?php endif ?>
          <?= \Config\Services::validation()->listErrors('custom') ?>
          <?= csrf_field() ?>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <?php echo form_close(); ?>
</div>
    </div>
  </div>
  </div>
       </div>
      <?php include('footer.php'); ?>