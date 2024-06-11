<h1 class="mt-4">Barangay</h1>

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div></div> <!-- Empty div to push the button to the right -->
        <a href="<?php echo site_url('main/add_barangay') ?>" class="btn btn-primary"><i class="fa-solid fa-square-plus"></i> Add Barangay</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="barangay-datatables">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Barangay</th>
                        <th>City/Municipality</th>
                        <th>Province</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($barangay as $key => $barangay) {
                        $barangay_id = $barangay->barangay_id; ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $barangay->barangay ?></td>
                            <td><?php echo $barangay->city_municipality ?></td>
                            <td><?php echo $barangay->province ?></td>
                            <td class="text-center">
                                <?php if ($barangay->status == "active") { ?>
                                    <span class="badge bg-primary ">
                                        <?= ucfirst($barangay->status) ?>
                                    </span>
                                <?php } else { ?>
                                    <span class="badge bg-danger">
                                        <?= ucfirst($barangay->status) ?>
                                    </span>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo site_url('main/edit_barangay/' . $barangay_id); ?>" style="color:gold; padding-left:6px;" title="Click here to edit barangay details"><i class="fas fa-edit"></i></a>
                                <?php {
                                ?>
                                    <?php $status = $barangay->status;
                                    if ($status == 'active') { ?>
                                        <a href="<?php echo site_url('main/deactivate_barangay/' . $barangay_id); ?>" style="color:red; padding-left:6px;" title="Click here to deactivate this barangay" onclick="return confirm('Are you sure you want to deactivate barangay?')"><i class="fas fa-ban"></i></a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url('main/reactivate_barangay/' . $barangay_id); ?>" style="color:green; padding-left:6px;" title="Click here to activate this barangay" onclick="return confirm('Are you sure you want to reactivate barangay?')"><i class="fas fa-check-circle"></i></a>
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