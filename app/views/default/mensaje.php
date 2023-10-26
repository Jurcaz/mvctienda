<?php include_once HEADER ?>

    <div class="card p-4 bg-light">
        <h2 class="text-center"><?= $dataView['subtitle'] ?></h2>
        <div class="alert <?= $dataView['color'] ?> mt-3">
            <h4><?= $dataView['text'] ?></h4>
        </div>
        <a href="<?= ROOT . $dataView['url'] ?>" class="btn <?= $dataView['colorButton'] ?>">
            <?= $dataView['textButton'] ?>
        </a>
    </div>

<?php include_once FOOTER ?>