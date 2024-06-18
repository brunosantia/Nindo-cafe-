<?php
include("./incluides/header.php"); ?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Menu</h1>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
            <p class="m-0 text-white px-2">/</p>
            <p class="m-0 text-white">Menu</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- carrito  Start -->
<section class="py-5">
    <div class="container px-4 px-lg-5">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody id="tblCarrito">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-5 ms-auto">
                <h4>Total a Pagar: <span id="total_pagar">0.00</span></h4>
                <div class="d-grid gap-2">
                    <div id="paypal-button-container"></div>
                    <button class="btn btn-warning" type="button" id="btnVaciar">Vaciar Carrito</button>
                    <!-- Botón para abrir el modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoProductoModal">
                        Enviar Pedido
                    </button>
                    <!-- Modal -->
                    <div id="nuevoProductoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="nuevoProductoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="nuevoProductoModalLabel">Nuevo Producto</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">


                                    <!-- Formulario de envío -->
                                    <form id="pedidoFormulario" action="enviar.php" method="POST" enctype="multipart/form-data" autocomplete="off">

                                        <!-- Cuadro del pedido del usuario -->
                                        <div id="pedidoUsuario">
                                            <h4 class="mb-3">Pedido del Usuario</h4>
                                            <textarea id="pedidoProductos" class="form-control" rows="4" type="text" name="pedidoProductos" readonly required></textarea>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nombre">Nombre</label>
                                                    <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="numero">Número</label>
                                                    <input id="numero" class="form-control" type="text" name="numero" placeholder="Número" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="correo">Correo</label>
                                                    <input id="correo" class="form-control" type="email" name="correo" placeholder="Correo electrónico" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="direccion">Dirección</label>
                                                    <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Dirección de entrega" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Campo oculto para enviar el texto plano de los productos -->
                                        <input type="hidden" id="productos_seleccionados_texto" name="productos_seleccionados_texto">
                                        <button class="btn btn-primary" type="submit">Enviar pedido</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--final del Nuevo botón -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- carrito  End -->
<?php
include("./incluides/footer.php"); ?>

</body>

</html>