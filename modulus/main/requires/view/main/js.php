<script src="/public/resource/main/vendor/jquery/jquery.min.js"></script>
<script src="/public/resource/main/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/public/resource/general/js/alertify.min.js"></script>
<script src="/public/resource/general/js/general.js"></script>
<script src="/public/resource/general/js/ajax.js"></script>

<?php if(isset($_SESSION['message'])) : ?>
    <script type="text/javascript">
        messageManagement(<?php echo json_encode($_SESSION['message']); ?>);
    </script>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

