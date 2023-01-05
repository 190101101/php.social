<h3 class="mt-4 mb-3">Rule 
    <small>page</small>
</h3>
<?php breadcump();  ?>

<ul class="pagination justify-content-center">
    <?php pagination::selector($data->page, 'info/rule/'); ?>
</ul>
<table class="table table-hover">
    <tbody>
        <?php foreach($data->rule as $rule): ?>
        <tr>
            <td>#<?php echo $rule->rule_id; ?>: <?php echo $rule->rule_text; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<ul class="pagination justify-content-center">
    <?php pagination::selector($data->page, 'info/rule/'); ?>
</ul>