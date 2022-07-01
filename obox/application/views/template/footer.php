<!-- Footer -->
      <footer class="sticky-footer bg-white" style="padding-top: 10px;padding-bottom: 10px;padding-left: 15%">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © <?= date('Y');?> PERUMDA BPR KABUPATEN CIREBON (BANK BKC) | All right reserved. Team IT</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
		<div class="modal-body">Pilih "<strong>Logout Akun</strong>" aja, supaya aman</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="<?php echo site_url('auth/logout') ?>">Logout Akun</a>
          <a class="btn btn-danger" href="https://mail.google.com/mail/u/0/?logout&hl=en">Logout Google Drive</a>
        </div>
      </div>
    </div>
  </div>