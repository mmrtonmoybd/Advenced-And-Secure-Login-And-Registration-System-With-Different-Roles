<?php include('header.php'); ?>
     <div class="container-fluid pt-3 pb-3 bg-white">
	 <div class="row justify-content-sm-center">
  <div class="col-sm-6">
    <div class="card bg-white p-3 rounded shadow-lg mb-5">
      <div class="card-body">
      <?php $session = session();
      if (!empty($session->getFlashdata('success'))) : ?>
      <div class="alert alert-success">
      <p><?= esc($session->getFlashdata('success')) ?></p>
      </div>
      <?php endif; ?>
      <?php
      if (!empty($session->getFlashdata('inkey'))) : ?>
      <div class="alert alert-danger">
      <p><?= esc($session->getFlashdata('inkey')) ?></p>
      </div>
      <?php endif; ?>
      <?php
      if (!empty($session->getFlashdata('notfound'))) : ?>
      <div class="alert alert-danger">
      <p><?= esc($session->getFlashdata('notfound')) ?></p>
      </div>
      <?php endif; ?>
      <?php
      if (!empty($session->getFlashdata('timeexp'))) : ?>
      <div class="alert alert-danger">
      <p><?= esc($session->getFlashdata('timeexp')) ?></p>
      </div>
      <?php endif; ?>
      <?php
      if (!empty($session->getFlashdata('usernotfounf'))) : ?>
      <div class="alert alert-danger">
      <p><?= esc($session->getFlashdata('usernotfounf')) ?></p>
      </div>
      <?php endif; ?>
      <?= \Config\Services::validation()->listErrors('custom') ?>
</div>
    </div>
  </div>
  </div>
       </div>
      <?php include('footer.php'); ?>