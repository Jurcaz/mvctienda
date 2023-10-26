<?php include_once HEADER ?>

<?php include_once ERROR_FORM ?>

<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center"><?= $dataView['subtitle'] ?></h1>
    </div>
    <div class="card-body">
        <form action="<?= ROOT ?>login/olvido" method="POST">
            <div class="form-group text-left mb-2">
                <label for="email">Correo electrónico:</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group text-left">
                <input type="submit" value="Enviar" class="btn btn-success">
                <a href="<?= ROOT ?>login" class="btn btn-info">Cancelar</a>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="row">
            <p>Recibirás un correo electrónico, comprueba tu bandeja de Spam</p>
        </div>
    </div>
</div>

<?php include_once FOOTER ?>
