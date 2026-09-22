<?php

$editar = isset($producto);

if ($editar)
{
    $action =
        site_url(
            'productos/actualizar/' .
            $producto->idprod
        );
}
else
{
    $action =
        site_url(
            'productos/guardar'
        );
}

?>


<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow">

            <div class="card-header">

                <h3>

                    <?= $editar
                        ? 'Modificar producto'
                        : 'Agregar producto'
                    ?>

                </h3>

            </div>


            <div class="card-body">


                <?= validation_errors(
                    '<div class="alert alert-danger">',
                    '</div>'
                ) ?>


                <form
                    action="<?= $action ?>"
                    method="post">


                    <!-- CLAVE -->

                    <div class="mb-3">

                        <label class="form-label">

                            Clave del producto

                        </label>

                        <input
                            type="text"
                            name="claveprod"
                            class="form-control"
                            required

                            value="<?= $editar
                                ? html_escape(
                                    $producto->claveprod
                                )
                                : set_value(
                                    'claveprod'
                                )
                            ?>">

                    </div>


                    <!-- DESCRIPCIÓN -->

                    <div class="mb-3">

                        <label class="form-label">

                            Descripción

                        </label>

                        <textarea
                            name="descripcion"
                            class="form-control"
                            rows="3"
                            required><?= $editar
                                ? html_escape(
                                    $producto->descripcion
                                )
                                : set_value(
                                    'descripcion'
                                )
                            ?></textarea>

                    </div>


                    <!-- LÍNEA -->

                    <div class="mb-3">

                        <label class="form-label">

                            Línea

                        </label>


                        <select
                            name="idlinea"
                            class="form-select"
                            required>

                            <option value="">

                                Selecciona una línea

                            </option>


                            <?php foreach (
                                $lineas as $linea
                            ): ?>

                                <option
                                    value="<?= $linea->idlinea ?>"

                                    <?= $editar &&
                                        $producto->idlinea ==
                                        $linea->idlinea
                                        ? 'selected'
                                        : ''
                                    ?>>

                                    <?= html_escape(
                                        $linea->descripcion_linea
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- PRECIO COMPRA -->

                    <div class="mb-3">

                        <label class="form-label">

                            Precio de compra

                        </label>

                        <input
                            type="number"
                            name="preciocompra"
                            class="form-control"
                            step="0.01"
                            min="0"
                            required

                            value="<?= $editar
                                ? $producto->preciocompra
                                : set_value(
                                    'preciocompra'
                                )
                            ?>">

                    </div>


                    <!-- PRECIO VENTA -->

                    <div class="mb-3">

                        <label class="form-label">

                            Precio de venta

                        </label>

                        <input
                            type="number"
                            name="precioventa"
                            class="form-control"
                            step="0.01"
                            min="0"
                            required

                            value="<?= $editar
                                ? $producto->precioventa
                                : set_value(
                                    'precioventa'
                                )
                            ?>">

                    </div>


                    <!-- ESTADO -->

                    <?php if ($editar): ?>

                    <div class="mb-3">

                        <label class="form-label">

                            Estado

                        </label>


                        <select
                            name="status_prod"
                            class="form-select">

                            <option
                                value="1"
                                <?= $producto->status_prod == 1
                                    ? 'selected'
                                    : ''
                                ?>>

                                Activo

                            </option>


                            <option
                                value="0"
                                <?= $producto->status_prod == 0
                                    ? 'selected'
                                    : ''
                                ?>>

                                Inactivo

                            </option>

                        </select>

                    </div>

                    <?php endif; ?>


                    <button
                        type="submit"
                        class="btn btn-primary">

                        <?= $editar
                            ? 'Guardar cambios'
                            : 'Registrar producto'
                        ?>

                    </button>


                    <a
                        href="<?= site_url('productos') ?>"
                        class="btn btn-secondary">

                        Cancelar

                    </a>


                </form>

            </div>

        </div>

    </div>

</div>