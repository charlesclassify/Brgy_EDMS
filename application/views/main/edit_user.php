<h1 class="mt-4">Edit User</h1>
<div class="row justify-content-center">
    <div class="card col-md-6 align-center">
        <div class="card-body">
            <?= form_open_multipart('main/edit_user/' . $user->user_id, array('onsubmit' => 'return confirm(\'Are you sure you want to update this user?\')')); ?>

            <div class="form-group">
                <label for="first_name" class="bold-label">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="Enter First Name" class="form-control <?php echo form_error('first_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('firstname', $user->firstname); ?>">
            </div>
            <div class="form-group">
                <label for="last_name" class="bold-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name" class="form-control <?php echo form_error('last_name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('lastname', $user->lastname); ?>">
            </div>
            <div class="form-group">
                <label for="username" class="bold-label">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" class="form-control <?php echo form_error('username') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('username', $user->username); ?>">
            </div>
            <div class="form-group">
                <label for="password" class="bold-label">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('password') ?>">
            </div>
            <div class="form-group">
                <label for="barangay" class="bold-label">Barangay</label>
                <select class="form-control form-control" name="barangay" id="barangay" title="Choose barangay" required>
                    <option value="<?= ($user->barangay); ?>" selected hidden><?= ($user->barangay); ?></option>
                    <?php foreach ($barangay as $bar) { ?>
                        <option value="<?= $bar->barangay ?>, <?= $bar->city_municipality ?>, <?= $bar->province ?>">Brgy. <?= $bar->barangay ?>, <?= $bar->city_municipality ?>, <?= $bar->province ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="role" class="bold-label">Role</label><br>
                <select name="role" id="role-select" data-live-search="true" data-style="btn-sm btn-outline-secondary" class="form-control <?php echo form_error('role') ? 'is-invalid' : ''; ?>">
                    <option selected hidden value="<?= $user->role ?>"><?= ucfirst($user->role) ?></option>

                    <option value="Super Admin">Super Admin</option>
                    <option value="Admin">Admin</option>
                    <option value="Staff">Staff</option>
                </select>
            </div>
            <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" name="submit" class="btn btn-primary" style="margin-right:5px"><i class=" fas fa-save"></i> Submit</button>
                <button type="reset" class="btn btn-danger" style="margin-right:5px"><i class=" fas fa-trash"></i> Clear</button>
                <a class="btn btn-secondary" href="<?= base_url('main/user') ?>"><i class="fas fa-reply" style="margin-right:5px"></i> Back</a>
            </div>
            </form>
        </div>
    </div>
</div>