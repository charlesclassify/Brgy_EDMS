<h1 class="mt-4">User</h1>

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div></div> <!-- Empty div to push the button to the right -->
        <a href="<?php echo site_url('main/add_user') ?>" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add User</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="user-datatables">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>FullName</th>
                        <th>Barangay</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($users as $key => $user) {
                        $user_id = $user->user_id; ?>

                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $user->username ?></td>
                            <td><?php echo $user->firstname ?> <?php echo $user->lastname ?></td>
                            <td>Brgy. <?php echo $user->barangay ?></td>
                            <td><?php echo $user->role ?></td>
                            <td class="text-center">
                                <?php if ($user->status == "active") { ?>
                                    <span class="badge bg-primary ">
                                        <?= ucfirst($user->status) ?>
                                    </span>
                                <?php } else { ?>
                                    <span class="badge bg-danger">
                                        <?= ucfirst($user->status) ?>
                                    </span>
                                <?php } ?>

                            </td>
                            <td class="text-center">
                                <a href="<?php echo site_url('main/edit_user/' . $user_id); ?>" style="color:gold; padding-left:6px;" title="Click here to edit user details"><i class="fas fa-edit"></i></a>
                                <?php {
                                ?>
                                    <?php $status = $user->status;
                                    if ($status == 'active') { ?>
                                        <a href="<?php echo site_url('main/deactivate_user/' . $user_id); ?>" style="color:red; padding-left:6px;" title="Click here to deactivate this user" onclick="return confirm('Are you sure you want to deactivate user?')"><i class="fas fa-ban"></i></a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url('main/reactivate_user/' . $user_id); ?>" style="color:green; padding-left:6px;" title="Click here to activate this user" onclick="return confirm('Are you sure you want to reactivate user?')"><i class="fas fa-check-circle"></i></a>
                                    <?php } ?>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>