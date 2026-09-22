<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1>
            Catálogo de productos
        </h1>

        <p class="text-muted">
            Administración de productos
        </p>

    </div>


    <a href="<?= site_url('productos/nuevo') ?>"
       class="btn btn-primary">

        + Agregar producto

    </a>

</div>


<?php if ($this->session->flashdata('mensaje')): ?>

    <div class="alert alert-success">

        <?= $this->session->flashdata('mensaje') ?>

    </div>

<?php endif; ?>


<div class="card shadow">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Clave</th>

                        <th>Producto</th>

                        <th>Línea</th>

                        <th>Compra</th>

                        <th>Venta</th>

                        <th>Stock</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>


                <tbody>

                <?php if (empty($productos)): ?>

                    <tr>

                        <td colspan="9"
                            class="text-center">

                            No hay productos registrados.

                        </td>

                    </tr>

                <?php else: ?>


                    <?php foreach ($productos as $p): ?>

                    <tr>

                        <td>
                            <?= $p->idprod ?>
                        </td>


                        <td>
                            <?= html_escape($p->claveprod) ?>
                        </td>


                        <td>
                            <?= html_escape($p->descripcion) ?>
                        </td>


                        <td>
                            <?= html_escape($p->descripcion_linea) ?>
                        </td>


                        <td>

                            $
                            <?= number_format(
                                $p->preciocompra,
                                2
                            ) ?>

                        </td>


                        <td>

                            $
                            <?= number_format(
                                $p->precioventa,
                                2
                            ) ?>

                        </td>


                        <td>
                            <?= $p->stock ?>
                        </td>


                        <td>

                            <?php if ($p->status_prod == 1): ?>

                                <span class="badge bg-success">
                                    Activo
                                </span>

                            <?php else: ?>

                                <span class="badge bg-secondary">
                                    Inactivo
                                </span>

                            <?php endif; ?>

                        </td>


                        <td>

                            <a href="<?= site_url(
                                'productos/editar/' . $p->idprod
                            ) ?>"
                            class="btn btn-sm btn-warning">

                                Modificar

                            </a>


                            <a href="<?= site_url(
                                'productos/eliminar/' . $p->idprod
                            ) ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm(
                                '¿Deseas eliminar este producto?'
                            );">

                                Eliminar

                            </a>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>