<style>
    .form-group {
        margin-bottom: 20px;
    }

    .modal-header {
        background-color: #201658;
        color: white;
    }

    .modal-dialog {
        max-width: 750px;
    }

    label {
        margin-bottom: 10px;
    }
</style>

<div class="modal fade" id="add_criminal_attachments_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <?= form_open_multipart('main/submit_add_criminal_attachments', array('onsubmit' => 'return confirm(\'Are you sure you want to add these attachments?\')')); ?>
            <div class="modal-header" style="background-color:#201658; color:white;">
                <h5 class="modal-title" id="staticBackdropLabel">Add Attachments for Case No: <strong><?= $criminal_case->criminal_case_no ?></strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="criminal_case_id" value="<?= $criminal_case->criminal_case_id ?>">
                <div class="form-group col-12 d-inline-block">
                    <label for="form_7" class="bold-label">Form #7:</label>
                    <input type="file" id="file_upload_form_7" name="file_upload_form_7" class="form-control" required>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="notice_of_hearing" class="bold-label">Notice of Hearing:</label>
                    <input type="file" id="file_upload_notice_of_hearing" name="file_upload_notice_of_hearing" class="form-control" required>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="summon" class="bold-label">Summon:</label>
                    <input type="file" id="file_upload_summon" name="file_upload_summon" class="form-control" required>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="notice_for_constitution_of_pangkat" class="bold-label">Notice for Constitution of Pangkat:</label>
                    <input type="file" id="file_upload_notice_for_constitution_of_pangkat" name="file_upload_notice_for_constitution_of_pangkat" class="form-control" required>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="settlement" class="bold-label">Settlement:</label>
                    <input type="file" id="file_upload_settlement" name="file_upload_settlement" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>