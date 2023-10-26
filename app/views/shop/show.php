<?php include_once HEADER?>

<div class="card p-4 bg-light mb-3">
    <h2 class="text-center"><?= $dataView['product']->name ?></h2>

    <?= html_entity_decode($dataView['product']->description) ?>
    <?php if($dataView['product']->type == 1): ?>
        <p>Publico objetivo: <?= $dataView['product']->people ?></p>
    <?php elseif ($dataView['product']->type == 2): ?>
        <p>Autor: <?= $dataView['product']->author ?></p>
    <?php endif; ?>

    <a class="btn btn-success" href="<?= ROOT ?>cart/addproduct/<?= $dataView['product']->id . ROOT . $dataView['user_id']?>">Comprar</a>
    <a class="btn btn-success" href="<?= ROOT . (!empty($dataView['back']) ? $dataView['back'] : 'shop')?>">Regresar</a>
</div>
<?php include_once FOOTER?>
