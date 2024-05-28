<style>
    td {
        text-align: center;
    }
</style>



<h1 class="mt-4">Criminal Case</h1>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div></div>
        <button type="button" data-bs-toggle="modal" class="btn btn-primary addCriminalCase">
            <i class="fa-solid fa-file-circle-plus"></i> Add Criminal Case
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-bordered table striped table table-sm" id="criminal_case-datatables">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Date Filed</th>
                        <th>Criminal Case No.</th>
                        <th>Case Name</th>
                        <th>Attachments</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1;
                    foreach ($criminal as $key => $crim) {
                        $criminal_case_id = $crim->criminal_case_id ?>
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $crim->date_filed ?></td>
                            <td><?php echo $crim->criminal_case_no ?></td>
                            <td><?php echo $crim->criminal_case_name ?></td>
                            <td style="text-align: center;">
                                <a type="button" data-bs-toggle="modal" class="btn btn-info addAttachments" data-caseId="<?php echo $criminal_case_id; ?>">
                                    <i class="fa-solid fa-file-arrow-up"></i> Add Attachments
                                </a>
                                <!-- <?php if (!empty($crim->file_path)) { ?>
                                    <a href="<?php echo base_url('Main/view_criminal_case_file/' . $criminal_case_id); ?>" target="_blank">View File</a>
                                <?php } else { ?>
                                    No attachment
                                <?php } ?> -->
                            </td>
                            <td>
                                <a href="#" style="color:darkcyan; padding-left:6px;" title="Click here to view case"><i class="fas fa-eye"></i></a>
                                <a href="#" style="color:gold; padding-left:6px;" title="Click here to view case"><i class="fa-solid fa-print"></i></a>
                                <a href="#" style="color:red; padding-left:6px;" title="Click here to delete case"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="modalContainer"></div>
    <div id="attachmentsContainer"></div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function handleAddCriminalCaseBtn(event) {
            event.preventDefault();
            loadModalContent('<?php echo base_url('Main/add_criminal_case/'); ?>');
        }
        var receiveButtons = document.querySelectorAll('.addCriminalCase');
        receiveButtons.forEach(function(button) {
            button.addEventListener('click', handleAddCriminalCaseBtn);
        });

        function handleAddAttachmentsBtn(event) {
            event.preventDefault();
            var caseId = this.getAttribute('data-caseId');
            loadModalContent1('<?php echo base_url('main/add_criminal_attachments_modal/'); ?>/' + caseId);
        }
        var receiveButtons = document.querySelectorAll('.addAttachments');
        receiveButtons.forEach(function(button) {
            button.addEventListener('click', handleAddAttachmentsBtn);
        });
    });

    function loadModalContent(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('modalContainer').innerHTML = data;
                $('#criminal_case_modal').modal('show');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function loadModalContent1(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('attachmentsContainer').innerHTML = data;
                $('#add_criminal_attachments_modal').modal('show');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>