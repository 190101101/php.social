<h3 class="mt-4 mb-3">FAQ 
    <small>page</small>
</h3>
<?php breadcump();  ?>

<ul class="pagination justify-content-center">
    <?php pagination::selector($data->page, 'info/faq/'); ?>
</ul>

<table class="table table-hover">
    <tbody>
        <?php foreach($data->faq as $faq): ?>
        <tr>
            <td>
                <details title='click me'>
                    <summary>
                        #<?php echo $faq->faq_id; ?>: <?php echo $faq->faq_text; ?>
                    </summary>
                    <span>
                    <?php echo $faq->faq_subtext; ?>
                    </span>
                </details>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<ul class="pagination justify-content-center">
    <?php pagination::selector($data->page, 'info/faq/'); ?>
</ul>