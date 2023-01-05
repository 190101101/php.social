<h3 class="mt-4 mb-3">Contact
    <small>page</small>
</h3>
<?php breadcump();  ?>

<div class="row">
    <div class="col-lg-8 mb-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d194472.6747714288!2d49.71487296415121!3d40.394769471246086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307d6bd6211cf9%3A0x343f6b5e7ae56c6b!2z0JHQsNC60YMsINCQ0LfQtdGA0LHQsNC50LTQttCw0L0!5e0!3m2!1sru!2s!4v1670710571204!5m2!1sru!2s" width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="col-lg-4 mb-4">
        <h3>Contact Details</h3>
        <p>
            <?php echo Setting::street(); ?>
            <br>
        </p>
        <p>
            <abbr title="Phone">P</abbr>: <?php echo Setting::phone(); ?>
        </p>
        <p>
            <abbr title="Email">E</abbr>:
            <a href="mailto:name@example.com"><?php echo Setting::email(); ?>
            </a>
        </p>
        <p>
            <abbr title="Hours">H</abbr>: <?php echo Setting::working(); ?>
        </p>

        <div>
            <img src="<?php echo Setting::contact_image(); ?>" style="width: 100%;">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 mb-4">
        <h3>Send us a Message</h3>
        <form action="/contact" method="POST">
            <?php if(!User::has()): ?>
            <div class="control-group form-group">
                <div class="controls">
                    <label>email:</label>
                    <input type="email" class="form-control" name="contact_email" required
                        <?php if(old::contact_email()): ?>
                        value="<?php echo old::contact_email(); ?>" 
                        <?php else: ?>
                        placeholder="email" 
                        <?php endif; ?>
                        >
                </div>
            </div>
            <?php endif; ?>
            <div class="control-group form-group">
                <div class="controls">
                    <label>theme:</label>
                    <select class="form-control" name="contact_theme" required>
                        <option value="help">help</option>
                        <option value="payment">payment</option>
                        <option value="other">other</option>
                    </select>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>message:</label>
                    <textarea class="form-control" name="contact_message" minlength="10" maxlength="999" required ><?php if(old::contact_message()): echo old::contact_message(); endif; ?></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Send Message</button>
        </form>
    </div>
</div>