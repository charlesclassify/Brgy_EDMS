<style>
    .form-group {
        margin-bottom: 20px;
    }

    .modal-header {
        background-color: #201658;
        color: white;
    }

    .modal-dialog {
        max-width: 1250px;
    }

    label {
        margin-bottom: 10px;
    }

    @media print {

        .modal-header,
        .modal-footer,
        .btn,
        .form-control {
            display: none !important;
        }

        .printable {
            display: block;
        }

        .modal-content {
            border: none !important;
        }
    }

    .printable {
        display: none;
    }
</style>

<div class="modal fade" id="add_civil_attachments_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <?= form_open_multipart('main/submit_add_civil_attachments', array('onsubmit' => 'return confirm(\'Are you sure you want to add these attachments?\')')); ?>
            <div class="modal-header" style="background-color:#201658; color:white;">
                <h5 class="modal-title" id="staticBackdropLabel">Add Attachments for Case No: <strong><?= $civil_case->civil_case_no ?></strong></h5>
                <input type="hidden" name="civil_case_id" id="civil_case_id" value="<?= $civil_case->civil_case_id ?>">
                <input type="hidden" name="date_filed" id="date_filed" value="<?= $civil_case->date_filed ?>">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                $file_fields = [
                    'form_7' => 'Form #7',
                    'notice_of_hearing' => 'Notice of Hearing',
                    'summon' => 'Summon',
                    'pangkat' => 'Notice for Constitution of Pangkat',
                    'settlement' => 'Settlement'
                ];

                foreach ($file_fields as $field_key => $label) {
                    $file_path_var = $field_key . '_path';
                    $file_path = $civil_case->$file_path_var;
                    echo '<div class="row printable">
                            <label class="bold-label">' . $label . ':</label>';
                    if (!empty($file_path)) {
                        echo '<p><a href="' . base_url($file_path) . '" target="_blank">' . $label . ' - View File</a></p>';
                    } else {
                        echo '<p>No File Uploaded</p>';
                    }
                    echo '</div>';

                    echo '<div class="row">
                            <label for="file_upload_' . $field_key . '" class="bold-label">' . $label . ':</label>
                            <div class="form-group col-8 d-inline-block">
                                <input type="file" id="file_upload_' . $field_key . '" name="file_upload_' . $field_key . '" class="form-control">
                            </div>
                            <div class="form-group col-4 d-inline-block">';
                    if (!empty($file_path)) {
                        echo '<a href="' . base_url($file_path) . '" target="_blank" class="btn" style="background-color:darkcyan; color:white"><i class="fas fa-eye"></i> View Uploaded File</a>';
                        echo '<button type="button" class="btn btn-warning" style="margin-left:5px;" onclick="printFile(\'' . base_url($file_path) . '\')"><i class="fas fa-print"></i> Print File</button>';
                    } else {
                        echo '<button type="button" class="btn" style="background-color:darkcyan; color:white" disabled><i class="fas fa-eye"></i> No File Uploaded</button>';
                    }
                    echo '</div></div>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    function printFile(url) {
        var printWindow = window.open(url, '_blank');
        printWindow.onload = function() {
            setTimeout(function() {
                printWindow.print();
            }, 500); // Adding a slight delay to ensure the file is loaded
        };
    }
</script>