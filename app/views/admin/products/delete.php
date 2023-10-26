<?php include_once HEADER ?>

<script src="<?= ROOT . 'js/adminCreateProduct.js'  ?>"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<?php include_once ERROR_FORM ?>

<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center">Baja de producto</h1>
    </div>
    <div class="card-body">
        <form action="<?= ROOT ?>adminproduct/delete/<?= $dataView['product']->id ?>" method="POST" enctype="multipart/form-data">

            <div class="text-left">
                <label for="type">Tipo de producto</label>
                <select name="type" id="type" class="form-control" disabled>
                    <option value="">Selecciona el tipo de  producto</option>
                    <?php foreach ($dataView['typeList'] as $type): ?>
                        <option value="<?= $type->value ?>"
                            <?= isset($dataView['product']->type) ? ( $dataView['product']->type == $type->value ? 'selected="selected"' : '' ) : '' ?> > <?= $type->description ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group text-left mb-2">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" disabled
                       class="form-control" required
                       placeholder="Escribe el nombre del producto"
                       value="<?= $dataView['product']->name ?? '' ?>">
            </div>

            <div class="form-group text-left">
                <input type="submit" value="Borrar producto" class="btn btn-success">
                <a href="<?= ROOT ?>adminproduct" class="btn btn-info">Regresar</a>
            </div>

        </form>
    </div>
</div>

<?php include_once FOOTER ?>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>