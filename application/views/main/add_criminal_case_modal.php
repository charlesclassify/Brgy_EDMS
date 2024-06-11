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

<div class="modal fade" id="criminal_case_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <?= form_open_multipart('', array('onsubmit' => 'return confirm(\'Are you sure you want to add this criminal case?\')')); ?>
            <div class="modal-header" style="background-color:#201658; color:white;">
                <h5 class="modal-title" id="staticBackdropLabel">Enter Criminal Case Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6 d-inline-block">
                        <label for="criminal_case_no" class="bold-label">Criminal Case No:</label>
                        <input type="text" id="criminal_case_no" name="criminal_case_no" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 d-inline-block">
                        <label for="date_filed" class="bold-label">Date Filed:</label>
                        <input type="date" id="date_filed" name="date_filed" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 d-inline-block">
                        <label for="criminal_case_name" class="bold-label">Criminal Case Name:</label>
                        <input type="text" id="criminal_case_name" name="criminal_case_name" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 d-inline-block">
                        <label for="purok" class="bold-label">Purok:</label>
                        <input type="text" id="purok" name="purok" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 d-inline-block">
                        <label for="respondent" class="bold-label">Respondent/s:</label>
                        <input type="text" id="respondent" name="respondent" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 d-inline-block">
                        <label for="complainant" class="bold-label">Complainant/s:</label>
                        <input type="text" id="complainant" name="complainant" class="form-control" required>
                    </div>
                </div>

                <div class="form-group col-12 d-inline-block">
                    <label for="complaint" class="bold-label">Complaint:</label>
                    <textarea type="text" id="complaint" name="complaint" class="form-control" required></textarea>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="relief" class="bold-label">Relief/s:</label>
                    <input type="text" id="relief" name="relief" class="form-control" required>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="file_upload" class="bold-label">Upload File:</label>
                    <input type="file" id="file_upload" name="file_upload" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>