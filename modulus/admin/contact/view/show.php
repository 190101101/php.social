<?php breadcump_form_panel();  ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  
    <div class="col-lg-9">
        <?php $contact = $data->contact; ?>
        <div class="row">
            <div class="col-lg-11">
                <h2>contact show</h2>
            </div>
            <div class="col-lg-1">
                <a class="btn btn-sm btn-success" href="/panel/contact/page/1">back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>id</label>
                    <input class="form-control" value="<?php echo $contact->contact_id; ?>" readonly>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>email</label>
                    <input class="form-control" value="<?php echo $contact->contact_email; ?>" readonly>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>created</label>
                    <input class="form-control" value="<?php echo $contact->contact_created; ?>" readonly>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label>theme</label>
                    <input class="form-control" value="<?php echo $contact->contact_theme; ?>" readonly>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>ip</label>
                    <input class="form-control" value="<?php echo $contact->contact_ip; ?>" readonly>
                </div>
            </div>
            <div class="col-lg-12">
                <label>contact text</label>
                <textarea type="text" rows="5" readonly class="form-control" placeholder="contact text"><?php echo $contact->contact_message; ?></textarea>
            </div>
            <div class="col-lg-12 mt-3">
                <a class="btn btn-sm btn-outline-danger"
                    href="/panel/contact/destroy/<?php echo $contact->contact_id; ?>">delete</a>
            </div>
        </div>
    </div>
</div>