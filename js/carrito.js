 mostrarCarrito();

        function mostrarCarrito() {
            if (localStorage.getItem("productos") != null) {
                let array = JSON.parse(localStorage.getItem('productos'));
                if (array.length > 0) {
                    $.ajax({
                        url: 'ajax.php',
                        type: 'POST',
                        async: true,
                        data: {
                            action: 'buscar',
                            data: array
                        },
                        success: function(response) {
                            console.log(response);
                            const res = JSON.parse(response);
                            let html = '';
                            res.datos.forEach(element => {
                                // Calcula el subtotal multiplicando el precio por la cantidad
                                let subtotal = element.precio_normal * element.cantidad;

                                html += `
                            <tr>
                                <td>${element.nombre}</td>
                                <td>${element.precio_normal}</td>
                                <td>${element.cantidad}</td>
                                <td>${subtotal}</td>
                            </tr>
                        `;
                            });
                            $('#tblCarrito').html(html);
                            $('#total_pagar').text(res.total);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            }
        }

        $('#btnEnviar').on('click', function () {
            enviarPedido();
        });

        $('#btnVaciar').on('click', function () {
            limpiarCarrito();
        });

        function enviarPedido() {
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: {
                    action: 'guardar_pedido'
                },
                success: function (response) {
                    console.log(response);
                    // Puedes realizar acciones adicionales después de enviar el pedido
                    // Por ejemplo, limpiar el carrito y redirigir al usuario
                    limpiarCarrito();
                    alert('¡Pedido enviado con éxito!');
                    window.location.href = './'; // Redirigir a la página principal
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        function limpiarCarrito() {
            // Limpiar el carrito local
            localStorage.removeItem('productos');
            // Actualizar la interfaz del carrito
            $('#tblCarrito').html('');
            $('#total_pagar').text('0.00');
        }