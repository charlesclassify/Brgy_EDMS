<style>
    .form-group {
        margin-bottom: 20px;
    }

    .modal-header {
        background-color: #201658;
        color: white;
    }

    .modal-dialog {
        max-width: 850px;
    }

    label {
        margin-bottom: 10px;
    }
</style>

<div class="modal fade" id="edit_criminal_case_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#201658; color:white;">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Criminal Case: <?php echo $criminal->criminal_case_no ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-group col-12 d-inline-block">
                    <label for="criminal_case_no" class=" bold-label">Criminal Case No.:</label>
                    <input type="text" value="<?php echo $criminal->criminal_case_no ?>" class="form-control" required></input>
                </div>

                <div class="row">
                    <div class="form-group col-6 d-inline-block">
                        <label for="criminal_case_name" class="bold-label">Criminal Case Name:</label>
                        <input type="text" value="<?php echo $criminal->criminal_case_name ?>" class="form-control" required></input>
                    </div>
                    <div class="form-group col-6 d-inline-block">
                        <label for="date_filed" class="bold-label">Date Filed:</label>
                        <input type="text" value="<?php echo $criminal->date_filed ?>" class="form-control" required></input>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6 d-inline-block">
                        <label for="respondents" class="bold-label">Respondent/s:</label>
                        <input type="text" value="<?php echo $criminal->respondent ?>" class="form-control" required></input>
                    </div>
                    <div class="form-group col-6 d-inline-block">
                        <label for="complainants" class="bold-label">Complainant/s:</label>
                        <input type="text" value="<?php echo $criminal->complainant ?>" class="form-control" required></input>
                    </div>
                </div>


                <div class="form-group col-12 d-inline-block">
                    <label for="complaint" class="bold-label">Complaint:</label>
                    <input type="text" value="<?php echo $criminal->complaint ?>" class="form-control" required></input>
                </div>
                <div class="form-group col-12 d-inline-block">
                    <label for="complaint" class="bold-label">Relief:</label>
                    <input type="text" value="<?php echo $criminal->relief ?>" class="form-control" required></input>
                </div>

                <div class="row">
                    <div class="form-group col-6 d-inline-block">
                        <label for="schedule_of_hearing" class="bold-label">Schedule of Hearing:</label>
                        <input type="date" value="" class="form-control" required></input>
                    </div>
                    <div class="form-group col-6 d-inline-block">
                        <label for="remarks" class="bold-label">Remarks:</label>
                        <input type="text" value="" class="form-control" placeholder="Enter Remarks" required></input>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6 d-inline-block">
                        <label for="mode_of_settlement" class="bold-label">Mode of Settlement:</label>
                        <input type="text" value="" class="form-control" placeholder="Enter Mode of Settlement" required></input>
                    </div>
                    <div class="form-group col-6 d-inline-block">
                        <label for="date_settled" class="bold-label">Date Settled:</label>
                        <input type="date" value="" class="form-control" required></input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>