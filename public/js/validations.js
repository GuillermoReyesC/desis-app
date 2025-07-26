/**====================================
 * validaciones de campos en formularios
======================================= */

document.getElementById('btnGuardar').addEventListener('click', function (e) {
    e.preventDefault(); // Prevenir envío inmediato

    const codigo = document.getElementById('codigo').value.trim();
    const nombre = document.getElementById('nombre').value.trim();
    const precio = document.getElementById('precio').value.trim();
    const materiales = document.querySelectorAll('input[name="material"]:checked');
    const bodega = document.getElementById('bodega').value;
    const sucursal = document.getElementById('sucursal').value;
    const moneda = document.getElementById('divisa').value;
    const descripcion = document.getElementById('descripcion').value.trim();

    // Validación: campo código vacío
    if (codigo === '') {
        alert("El código del producto no puede estar en blanco.");
        return;
    }
    // Validación: longitud código entre 5 y 15 caracteres
    if (codigo.length < 5 || codigo.length > 15) {
        alert("El código del producto debe tener entre 5 y 15 caracteres.");
        return;
    }

    // Validación: código debe contener al menos una letra y un número, solo letras y números
    const formatoValido = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/;
    if (!formatoValido.test(codigo)) {
        alert("El código del producto debe contener letras y números.");
        return;
    }

    // Validación: campo nombre vacío
    if (nombre === '') {
        alert("El nombre del producto no puede estar en blanco.");
        return;
    }

    // Validación: longitud nombre entre 2 y 50 caracteres
    if (nombre.length < 2 || nombre.length > 50) {
        alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
        return;
    }

    // Validación: campo precio vacío
    if (precio === '') {
        alert("El precio del producto no puede estar en blanco.");
        return;
    }
        //validacion numero positivo
    if (parseFloat(precio) <= 0)
    {
        alert("El precio del producto debe ser un número positivo.");
        return;
    }
    // Validación: precio número positivo con hasta dos decimales
    const regexPrecio = /^\d+(\.\d{1,2})?$/;
    if (!regexPrecio.test(precio)) {
        alert("El precio del producto debe ser un número positivo con hasta dos decimales.");
        return;
    }

    // Validación: al menos dos materiales seleccionados
    if (materiales.length < 2) {
        alert("Debe seleccionar al menos dos materiales para el producto.");
        return;
    }

    // Validación: bodega seleccionada
    if (bodega === '') {
        alert("Debe seleccionar una bodega.");
        return;
    }

    // Validación: sucursal seleccionada
    if (sucursal === '') {
        alert("Debe seleccionar una sucursal para la bodega seleccionada.");
        return;
    }

    // Validación: moneda seleccionada
    if (moneda === '') {
        alert("Debe seleccionar una moneda para el producto.");
        return;
    }

    // Validación: descripción no vacía
    if (descripcion === '') {
        alert("La descripción del producto no puede estar en blanco.");
        return;
    }

    // Validación: longitud descripción entre 10 y 1000 caracteres
    if (descripcion.length < 10 || descripcion.length > 1000) {
        alert("La descripción del producto debe tener entre 10 y 1000 caracteres.");
        return;
    }

    // Verificar unicidad en base de datos 
    verificarCodigoUnico(codigo)
        .then(function (esUnico) {
            if (!esUnico) {
               // console.log("¿El código es único?:", esUnico);
                alert("El código del producto ya está registrado.");
                return;
            }
;
           // alert("Todas las validaciones pasaron. Código válido y único.");
            //si pasan las validaciones, guardar datos
            //esta funcion se define en index y envia los datos al servidor
            //console.log("Enviando datos del formulario...");
            enviarDatosFormulario(); 
            window.enviarDatosFormulario = enviarDatosFormulario;

        })
        .catch(function (error) {
            console.error("Error al verificar unicidad:", error);
            alert("Ocurrió un error al verificar el código en la base de datos.");
        });

});
function verificarCodigoUnico(codigo) {
    return fetch(`http://localhost:8080/api/products.php?action=checkCode&code=${encodeURIComponent(codigo)}`)
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (data.success) {
                return !data.exists; // true si es único
            } else {
                console.error("Respuesta inválida:", data.message);
                return false;
            }
        })
        .catch(function (error) {
            console.error("Excepción en fetch:", error);
            return false;
        });
}
