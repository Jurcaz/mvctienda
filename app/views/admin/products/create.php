<?php include_once HEADER ?>

<script src="<?= ROOT . 'js/adminCreateProduct.js'  ?>"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<?php include_once ERROR_FORM ?>

<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center">Alta de producto</h1>
    </div>
    <div class="card-body">
        <form action="<?= ROOT ?>adminproduct/create" method="POST" enctype="multipart/form-data">

            <div class="text-left">
                <label for="type">Tipo de producto</label>
                <select name="type" id="type" class="form-control">
                    <option value="">Selecciona el tipo de  producto</option>
                    <?php foreach ($dataView['typeList'] as $type): ?>
                        <option value="<?= $type->value ?>"
                            <?= isset($dataView['dataForm']['type']) ? ( $dataView['dataForm']['type'] == $type->value ? 'selected="selected"' : '' ) : '' ?> > <?= $type->description ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group text-left mb-2">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name"
                       class="form-control" required
                       placeholder="Escribe el nombre del producto"
                       value="<?= $dataView['dataForm']['name'] ?? '' ?>">
            </div>

            <div class="form-group text-left mb-2">
                <label for="editor">Descripcion:</label>
                <textarea name="description" id="editor" class="form-control"><?= $dataView['dataForm']['description'] ?? '' ?></textarea>
            </div>

            <div id="book">
                <div class="form-group text-left">
                    <label for="author">Autor</label>
                    <input type="text" id="author" name="author" class="form-control"
                           placeholder="Escribe el autor del libro"
                           value="<?= $dataView['dataForm']['author'] ?? '' ?>">
                </div>

                <div class="form-group text-left">
                    <label for="publisher">Editorial</label>
                    <input type="text" id="publisher" name="publisher" class="form-control"
                           placeholder="Escribe la editorial del libro"
                           value="<?= $dataView['dataForm']['publisher '] ?? '' ?>">
                </div>

                <div class="form-group text-left">
                    <label for="pages">Páginas</label>
                    <input type="text" name="pages" id="pages" class="form-control"
                           placeholder="Escribe el número de páginas del libro"
                           value="<?= $dataView['dataForm']['pages'] ?? '' ?>">
                </div>
            </div>

            <div id="course">
                <div class="form-group text-left">
                    <label for="people">Publico objetivo</label>
                    <input type="text" id="people" name="people" class="form-control"
                           placeholder="Escribe a quien esta dirigido el curso"
                           value="<?= $dataView['dataForm']['people'] ?? '' ?>">
                </div>

                <div class="form-group text-left">
                    <label for="objetives">Objetivos</label>
                    <input type="text" id="objetives" name="objetives" class="form-control"
                           placeholder="Escribe los objetivos del curso"
                           value="<?= $dataView['dataForm']['objetives'] ?? '' ?>">
                </div>

                <div class="form-group text-left">
                    <label for="necesites">Conocimientos requeridos</label>
                    <input type="text" id="necesites" name="necesites" class="form-control"
                           placeholder="Escribe los conocimientos requeridos del curso"
                           value="<?= $dataView['dataForm']['necesites'] ?? '' ?>">
                </div>
            </div>

            <div class="form-group text-left">
                <label for="price">Precio:</label>
                <input type="text" name="price" id="price"
                       pattern="(\d|-)?(\d|,)*\.?\d*$"
                       class="form-control" required
                       placeholder="Escribe el valor del producto, sin comas ni simbolos"
                       value="<?= $dataView['dataForm']['price'] ?? '' ?>">
            </div>

            <div class="form-group text-left">
                <label for="discount">Descuento:</label>
                <input type="text" name="discount" id="discount"
                       pattern="(\d|-)?(\d|,)*\.?\d*$"
                       class="form-control" required
                       placeholder="Escribe el descuento del producto, sin comas ni simbolos"
                       value="<?= $dataView['dataForm']['discount'] ?? '' ?>">
            </div>

            <div class="form-group text-left">
                <label for="send">Coste envio:</label>
                <input type="text" name="send" id="send"
                       pattern="(\d|-)?(\d|,)*\.?\d*$"
                       class="form-control" required
                       placeholder="Escribe coste del envio, sin comas ni simbolos"
                       value="<?= $dataView['dataForm']['send'] ?? '' ?>">
            </div>

            <div class="form-group text-left">
                <label for="image">Imagen del producto:</label>
                <input type="file" name="image" id="image" class="form-control"
                       accept="image/jpeg,image/x-png,image/gif">
            </div>

            <div class="form-group text-left">
                <label for="published">Fecha del producto:</label>
                <input type="date" name="published" id="published"
                       class="form-control" required
                       placeholder="Fecha de la publicacion del producto (AAAA-MM-DD)"
                       value="<?= $dataView['dataForm']['published'] ?? '' ?>">
            </div>

            <div class="form-group text-left">
                <label for="relation1">Producto relacionado</label>
                <select name="relation1" id="relation1" class="form-control">
                    <option value="">Selecciona un producto relacionado</option>
                        <?php foreach ($dataView['catalogue'] as $item): ?>
                            <option value=" <?= $item->id ?>"
                                <?= isset($dataView['dataForm']['ralation1']) ? ( $dataView['dataForm']['ralation1'] == $item->value ? 'selected="selected"' : '' ) : '' ?>
                                > <?= $item->name ?> </option>
                        <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group text-left">
                <label for="relation2">Producto relacionado</label>
                <select name="relation2" id="relation2" class="form-control">
                    <option value="">Selecciona un producto relacionado</option>
                        <?php foreach ($dataView['catalogue'] as $item): ?>
                            <option value=" <?= $item->id ?>"
                                <?= isset($dataView['dataForm']['ralation2']) ? ( $dataView['dataForm']['ralation2'] == $item->value ? 'selected="selected"' : '' ) : '' ?>
                                > <?= $item->name ?> </option>
                        <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group text-left">
                <label for="relation3">Producto relacionado</label>
                <select name="relation3" id="relation3" class="form-control">
                    <option value="">Selecciona un producto relacionado</option>
                        <?php foreach ($dataView['catalogue'] as $item): ?>
                            <option value=" <?= $item->id ?>"
                                <?= isset($dataView['dataForm']['ralation3']) ? ( $dataView['dataForm']['ralation3'] == $item->value ? 'selected="selected"' : '' ) : '' ?>
                            > <?= $item->name ?> </option>
                        <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group text-left">
                <label for="status">Estado del producto</label>
                <select name="status" id="status" class="form-control">
                    <option value="void">Selecciona el estado del producto</option>
                    <?php foreach ($dataView['statusList'] as $status): ?>
                        <option value="<?= $status->value ?>"
                            <?= isset($dataView['dataForm']['status']) ? ( $dataView['dataForm']['status'] == $status->value ? 'selected="selected"' : '' ) : '' ?>
                            ><?= $status->description ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-check text-left">
                <input type="checkbox" name="mostSold" id="mostSold" class="form-check-input"
                    <?= isset($dataView['dataForm']['mostSold']) && $dataView['dataForm']['mostSold'] == '1' ? 'checked' : ''?>>
                <label for="mostSold" class="form-check-label" >Producto mas vendido</label>
            </div>

            <div class="form-check text-left">
                <input type="checkbox" name="new" id="new" class="form-check-input"
                    <?= isset($dataView['dataForm']['new']) && $dataView['dataForm']['new'] == '1' ? 'checked' : ''?>>
                <label for="new" class="form-check-label">Producto nuevo</label>
            </div>

            <div class="form-group text-left">
                <input type="submit" value="Crear producto" class="btn btn-success">
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
