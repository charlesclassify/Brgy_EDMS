<style>
    .form-group {
        margin-bottom: 20px;
    }

    .modal-header {
        background-color: #201658;
        color: white;
    }

    .modal-dialog {
        max-width: 500px;
    }

    label {
        margin-bottom: 12px;
    }
</style>

<div class="modal fade" id="civil_case_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <?= form_open_multipart('main/submit_add_civil_case', array('onsubmit' => 'return confirm(\'Are you sure you want to add this civil case?\')')); ?>
            <div class="modal-header" style="background-color:#201658; color:white;">
                <h5 class="modal-title" id="staticBackdropLabel">Enter Civil Case Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group col-12 d-inline-block">
                    <label for="civil_case_no" class="bold-label">Civil Case No:</strong></label>
                    <input type="text" id="civil_case_no" name="civil_case_no" class="form-control" required>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="date_filed" class="bold-label">Date Filed:</strong></label>
                    <input type="date" id="date_filed" name="date_filed" class="form-control" required>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="civil_case_name" class="bold-label">Civil Case Name:</strong></label>
                    <input type="text" id="civil_case_name" name="civil_case_name" class="form-control" required>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="complainant" class="bold-label">Complainant/s:</strong></label>
                    <input type="text" id="complainant" name="complainant" class="form-control" required>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="respondent" class="bold-label">Respondent/s:</strong></label>
                    <input type="text" id="respondent" name="respondent" class="form-control" required>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="purok" class="bold-label">Purok:</strong></label>
                    <input type="text" id="purok" name="purok" class="form-control" required>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="complaint" class="bold-label">Complaint:</strong></label>
                    <textarea type="text" id="complaint" name="complaint" class="form-control" required></textarea>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="relief" class="bold-label">Relief/s:</strong></label>
                    <input type="text" id="relief" name="relief" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>