<?php include_once HEADER ?>

<?php include_once ERROR_FORM ?>

<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center">Vista de usuarios - Crear usuario</h1>
    </div>
    <div class="card-body">
        <form action="<?= ROOT ?>adminuser/create" method="POST">
            <div class="form-group text-left mb-2">
                <label for="name">Usuario:</label>
                <input type="text" name="name" id="name"
                       class="form-control" required
                       placeholder="Escribe el nombre completo"
                       value="<?= $dataView['data']['name'] ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email"
                       class="form-control" required
                       placeholder="Escriba el correo electrónico"
                       value="<?= $dataView['data']['email'] ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="password1">Contraseña:</label>
                <input type="password" name="password1"
                       class="form-control" required
                       placeholder="Escribe una contraseña">
            </div>
            <div class="form-group text-left mb-2">
                <label for="password2">Repita la contraseña:</label>
                <input type="password" name="password2"
                       class="form-control" required
                       placeholder="Repite la contraseña">
            </div>
            <div class="form-group text-left">
                <input type="submit" value="Enviar datos" class="btn btn-success">
                <a href="<?= ROOT ?>adminuser" class="btn btn-info">Regresar</a>
            </div>
        </form>
    </div>
</div>

<?php include_once FOOTER ?>

