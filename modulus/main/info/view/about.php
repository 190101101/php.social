<h3 class="mt-4 mb-3">About
    <small>page</small>
</h3>
<?php breadcump();  ?>

<div class="row">
    <div class="col-lg-6">
        <img class="img-fluid rounded mb-4" src="<?php echo Setting::about_image(); ?>" style="height: 100%;">
    </div>
    <div class="col-lg-6">
        <?php echo Setting::about(); ?>
    </div>
    <div class="col-md-12">
        <div>
            <?php echo Setting::about_under(); ?>
        </div>
    </div>
</div>