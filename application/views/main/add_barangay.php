<h1 class="mt-4">Add Barangay</h1>
<div class="row justify-content-center">
    <div class="card col-md-6 align-center">
        <div class="card-body">
            <?= form_open_multipart('', array('onsubmit' => 'return confirm(\'Are you sure you want to add this barangay?\')')); ?>

            <div class="form-group">
                <label for="barangay" class="bold-label">Barangay</label>
                <input type="text" id="barangay" name="barangay" placeholder="Enter Barangay" class="form-control <?php echo form_error('barangay') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('barangay'); ?>">
            </div>
            <br />
            <div class="form-group">
                <label for="city_municipality" class="bold-label">City/Municipality</label>
                <input type="text" id="city_municipality" name="city_municipality" placeholder="Enter City/Municipality" class="form-control <?php echo form_error('city_municipality') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('city_municipality'); ?>">
            </div>
            <br />
            <div class="form-group">
                <label for="province" class="bold-label">Province</label>
                <input type="text" id="province" name="province" placeholder="Enter Province" class="form-control <?php echo form_error('province') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('province'); ?>">
            </div>
            <br />
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" name="submit" class="btn btn-primary" style="margin-right:5px"><i class=" fas fa-save"></i> Submit</button>
                <button type="reset" class="btn btn-danger" style="margin-right:5px"><i class=" fas fa-trash"></i> Clear</button>
                <a class="btn btn-secondary" href="<?= base_url('main/barangay') ?>"><i class="fas fa-reply" style="margin-right:5px"></i> Back</a>
            </div>
            </form>
        </div>
    </div>
</div>