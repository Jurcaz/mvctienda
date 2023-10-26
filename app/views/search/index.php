<?php include_once HEADER ?>

<div class="card p-4 bg-light mb-3">
    <div class="card-header">
        <h1 class="text-center"><?= $dataView['subtitle'] ?></h1>
    </div>
    <div class="card-body">
        <?php foreach($dataView['productsList'] as $key => $value): ?>
            <?php if ($key%4 == 0): ?>
                <div class="row">
            <?php endif; ?>

            <div class="card pt-2 col-sm-3">
                <img src="../img/<?= $value->image ?>"
                     class="img-responsive" width="100%"
                     alt="<?= $value->name ?>"
                >
                <a href="shop/show/<?= $value->id ?>"><p><?= $value->name ?></p></a>
            </div>

            <?php if ($key%4 == 3): ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<?php include_once FOOTER ?>
