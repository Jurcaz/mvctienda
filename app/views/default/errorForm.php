<?php if(isset($dataView['errors']) && count($dataView['errors']) > 0): ?>
    <div class="alert alert-danger mt-3">
        <?php foreach ($dataView['errors'] as $value): ?>
            <strong><?= $value ?></strong><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
