   </div>
   </main>
   <footer class="py-4 bg-light mt-auto">
       <div class="container-fluid px-4">
           <div class="d-flex align-items-center justify-content-between small">
               <div class="text-muted">Copyright &copy; Your Website 2023</div>
               <div>
                   <a href="#">Privacy Policy</a>
                   &middot;
                   <a href="#">Terms &amp; Conditions</a>
               </div>
           </div>
       </div>
   </footer>
   </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

   <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
   <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
   <script src="<?= base_url('assets/js/scripts.js'); ?>"></script>
   <script>
       $(document).ready(function() {
           $('#user-datatables').dataTable({
               "lengthMenu": [10, 25, 50, 75, 100]
           });

           $('#criminal_case-datatables').dataTable({
               "lengthMenu": [10, 25, 50, 75, 100]
           });
           $('#civil_case-datatables').dataTable({
               "lengthMenu": [10, 25, 50, 75, 100]
           });
           $('#barangay-datatables').dataTable({
               "lengthMenu": [10, 25, 50, 75, 100]
           });
       });
   </script>
   </body>


   </html>