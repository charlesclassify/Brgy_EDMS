<h1 class="mt-4">Civil Case</h1>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div></div>
        <button type="button" data-bs-toggle="modal" class="btn btn-primary addCivilCase"><i class="fa-solid fa-file-circle-plus"></i> Add Civil Case</button>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-bordered table striped table table-sm" id="civil_case-datatables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date Filed</th>
                        <th>Civil Case No.</th>
                        <th>Case Name</th>
                        <th>Attachments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1;
                    foreach ($civil as $key => $civ) {
                        $civil_case_id = $civ->civil_case_id ?>
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $civ->date_filed ?></td>
                            <td><?php echo $civ->civil_case_no ?></td>
                            <td><?php echo $civ->civil_case_name ?></td>
                            <td style="text-align:center;">
                                <a type="button" data-bs-toggle="modal" class="btn btn-info addAttachments" data-caseId="<?php echo $civil_case_id; ?>">
                                    <i class="fa-solid fa-file-arrow-up"></i> Add Attachments
                                </a>
                            </td>
                            <td>
                                <a href="#" data-bs-toggle="modal" class="viewCivilCaseBtn" data-caseId="<?php echo $civil_case_id ?>" style="color:darkcyan; padding-left:6px;" title="Click here to view case"><i class="fas fa-eye"></i></a>
                                <a href="#" data-bs-toggle="modal" class="editCivilCaseBtn" data-caseId="<?php echo $civil_case_id ?>" style="color:gold; padding-left:6px;" title="Click here to view case"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" data-caseId="<?php echo $civil_case_id ?>" style="color:green; padding-left:6px;" title="Click here to view case"><i class="fa-solid fa-print"></i></a>
                                <a href="#" data-caseId="<?php echo $civil_case_id ?>" style="color:red; padding-left:6px;" title="Click here to view case"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div id="modalContainer"></div>
    <div id="attachmentsContainer"></div>
    <div id="viewCivilCaseContainer"></div>
    <div id="editCivilCaseContainer"></div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function handleAddCivilCaseBtn(event) {
            event.preventDefault();
            loadModalContent('<?php echo base_url('Main/add_civil_case/'); ?>');
        }
        var receiveButtons = document.querySelectorAll('.addCivilCase');
        receiveButtons.forEach(function(button) {
            button.addEventListener('click', handleAddCivilCaseBtn);
        });

        function handleAddAttachmentsBtn(event) {
            event.preventDefault();
            var caseId = this.getAttribute('data-caseId');
            loadModalContent1('<?php echo base_url('main/add_civil_attachments_modal/'); ?>/' + caseId);
        }
        var attachmentButtons = document.querySelectorAll('.addAttachments');
        attachmentButtons.forEach(function(button) {
            button.addEventListener('click', handleAddAttachmentsBtn);
        });

        function handleViewCivilCaseBtn(event) {
            event.preventDefault();
            var caseId = this.getAttribute('data-caseId');
            loadModalContent2('<?php echo base_url('main/view_civil_case_modal/'); ?>/' + caseId);
        }

        var viewButtons = document.querySelectorAll('.viewCivilCaseBtn');
        viewButtons.forEach(function(button) {
            button.addEventListener('click', handleViewCivilCaseBtn);
        });

        function handleEditCivilCaseBtn(event) {
            event.preventDefault();
            var caseId = this.getAttribute('data-caseId');
            loadModalContent3('<?php echo base_url('main/edit_civil_case_modal/'); ?>/' + caseId);
        }

        var editButtons = document.querySelectorAll('.editCivilCaseBtn');
        editButtons.forEach(function(button) {
            button.addEventListener('click', handleEditCivilCaseBtn);
        });
    });

    function loadModalContent(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('modalContainer').innerHTML = data;
                $('#civil_case_modal').modal('show');
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
                $('#add_civil_attachments_modal').modal('show');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function loadModalContent2(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('viewCivilCaseContainer').innerHTML = data;
                $('#view_civil_case_modal').modal('show');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function loadModalContent3(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('editCivilCaseContainer').innerHTML = data;
                $('#edit_civil_case_modal').modal('show');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>