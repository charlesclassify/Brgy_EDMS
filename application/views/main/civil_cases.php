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
                        <th>Complainant</th>
                        <th>Remarks</th>
                        <th>Attachments</th>
                        <th>Print</th>
                        <th>Action</th>
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
                            <td><?php echo $civ->complainant ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div id="modalContainer"></div>
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
</script>