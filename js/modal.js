// Función para actualizar la información del carrito en la ventana modal
function actualizarInfoCarritoModal(productos_en_carrito) {
    let info = '';
    let total = 0;
    productos_en_carrito.forEach(producto => {
        const nombre = producto.nombre;
        const cantidad = producto.cantidad;
        const precio = parseFloat(producto.precio_normal);
        // Verificar si las propiedades son válidas
        if (nombre && cantidad && !isNaN(precio)) {
            const subtotal = precio * parseInt(cantidad);
            info += `${nombre}: ${cantidad} x $${precio.toFixed(2)}\n`;
            total += subtotal;
        }
    });
    info += `Total: $${total.toFixed(2)}`;
    $('#pedidoProductos').val(info);
    $('#precio_total').text('$' + total.toFixed(2)); // Actualiza el precio total en el modal
}

// Llamar a la función para mostrar el carrito al cargar la página
$(document).ready(function () {
    let productos = [];

    // Función para mostrar los productos del carrito
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
                    success: function (response) {
                        console.log(response);
                        const res = JSON.parse(response);
                        let html = '';
                        let total_pagar = 0;
                        res.datos.forEach(element => {
                            // Calcula el subtotal multiplicando el precio por la cantidad
                            let subtotal = element.precio_normal * element.cantidad;
                            total_pagar += subtotal;

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
                        $('#total_pagar').text(total_pagar.toFixed(2));
                        
                        // Actualizar la información en el modal
                        actualizarInfoCarritoModal(res.datos);
                    },

                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        }
    }

    // Llamar a la función para mostrar el carrito al cargar la página
    mostrarCarrito();

});
