/*==========================
* Archivo JS para visualizar y gestionar productos  en el front
 
=======================*/
// en este js manejaremos la carga de información de la data de las sucursales
document.addEventListener('DOMContentLoaded', function () {
    //cargarSucursales();
    cargarDivisas();
    cargarBodegas();
    cargarMateriales();
    
});

//traer materiales
function cargarMateriales() {
    fetch('http://localhost:8080/api/materials.php?action=list')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                poblarCheckboxesMateriales(data.data);
            } else {
                console.error('Error al obtener materiales:', data.message);
            }
        })
        .catch(error => {
            console.error('Excepción en la solicitud de materiales:', error);
        });
}
// cargar los materiales en los checkboxes
function poblarCheckboxesMateriales(materiales) {
    const container = document.getElementById('materiales-container');
    container.innerHTML = ''; // Limpiar contenido previo si existe

    if (!Array.isArray(materiales) || materiales.length === 0) {
        container.textContent = 'No hay materiales disponibles.';
        return;
    }

    materiales.forEach(material => {
        const label = document.createElement('label');
        label.classList.add('material-option');

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'material';
        checkbox.value = material.id;

        label.appendChild(checkbox);
        label.appendChild(document.createTextNode(' ' + material.name));

        const wrapper = document.createElement('div');
        wrapper.classList.add('checkbox-wrapper');
        wrapper.appendChild(label);

        container.appendChild(wrapper);
    });
}

//traer divisas
function cargarDivisas() {
    fetch('http://localhost:8080/api/currency.php?action=list')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                poblarSelectDivisas(data.data);
            } else {
                console.error('Error al obtener divisas:', data.message);
            }
        })
        .catch(error => {
            console.error('Excepción en la solicitud de divisas:', error);
        });
}

//traer bodegas
function cargarBodegas() {
    fetch('http://localhost:8080/api/warehouses.php?action=list')
        .then(response => {
            if (!response.ok) {   
                throw new Error(`HTTP error: ${response.status}`);
            }
            return response.json();
        })
        .then(data => { 
            if (data.success) {
                poblarSelectBodegas(data.data);
            } else {
                console.error('Error al obtener bodegas:', data.message);
            }
        })
        .catch(error => {
            console.error('Excepción en la solicitud de bodegas:', error);
        });
}

// cargar bodegas en el select
function poblarSelectBodegas(bodegas) {
    const select = document.getElementById('bodega');   
    // Limpiar opciones existentes excepto la primera
    select.innerHTML = '<option value=""></option>';  
    if (!Array.isArray(bodegas) || bodegas.length === 0) {
        return;
    }
    bodegas.forEach(bodega => {
        const option = document.createElement('option');
        option.value = bodega.id;
        option.textContent = bodega.name;
        //agregar data-attr="" segun el, 2da pocision del array
        //esto es para poder enviar el id de la bodega al servidor  
        option.dataset.warehouseId = bodega.warehouse_id;


        select.appendChild(option);
    }
    );
}
//traer las sucursales
function cargarSucursales() {
    fetch('http://localhost:8080/api/agencies.php?action=list')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                poblarSelectSucursales(data.data);
            } else {
                console.error('Error al obtener sucursales:', data.message);
            }
        })
        .catch(error => {
            console.error('Excepción en la solicitud de sucursales:', error);
        });
}

// cargar sucursales en el select
function poblarSelectSucursales(sucursales) {
    const select = document.getElementById('sucursal');

    // Limpiar opciones existentes excepto la primera
    select.innerHTML = '<option value=""></option>';

    if (!Array.isArray(sucursales) || sucursales.length === 0) {
        return;
    }

    sucursales.forEach(sucursal => {
        const option = document.createElement('option');
        option.value = sucursal.id;
        option.textContent = sucursal.name;
        select.appendChild(option);
    });
}

//cargar divisas en el select
function poblarSelectDivisas(divisas) {
    const select = document.getElementById('divisa');
    // Limpiar opciones existentes excepto la primera
    select.innerHTML = '<option value=""></option>';  
    if (!Array.isArray(divisas) || divisas.length === 0) {
        return;
    }
    divisas.forEach(divisa => {
        const option = document.createElement('option');
        option.value = divisa.id;
        option.textContent = divisa.name;
        select.appendChild(option);
    }
    );
}



// Obtener datos del formulario 
function obtenerDatosFormulario() {
   const materialesSeleccionados = Array.from(document.querySelectorAll('input[name="material"]:checked'))
        .map(checkbox => parseInt(checkbox.value, 10));

    return {
        code: document.getElementById("codigo").value.trim(),
        name: document.getElementById("nombre").value.trim(),
        price: parseFloat(document.getElementById("precio").value),
        warehouse_id: parseInt(document.getElementById("bodega").value, 10),
        agency_id: parseInt(document.getElementById("sucursal").value, 10),
        currency_id: parseInt(document.getElementById("divisa").value, 10),
        description: document.getElementById("descripcion").value.trim(),
        materials: materialesSeleccionados,
        // Nota: 'materiales' y 'stock' no están contemplados en tu controller 'storeAjax'.
    };
}

// Enviar datos al API con fetch, usando la ruta y acción correctas
function enviarDatosFormulario() {
    const datos = obtenerDatosFormulario();

    fetch("http://localhost:8080/api/products.php?action=create", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(datos)
    })
    .then(response => {
        if (!response.ok) throw new Error("Error en la solicitud");
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert("Producto guardado correctamente. ID: " + data.id);
            limpiarFormulario();
        } else {
            alert("Error: " + (data.message || "Error desconocido"));
            console.error("Error guardando producto:", data);
        }
    })
    .catch(error => {
        console.error("Error al guardar producto:", error);
        alert("Error al guardar el producto");
    });
}


// limpiar el formulario después de enviar
function limpiarFormulario() {
  //vaciar campos y limpiar checkboxes
  document.getElementById("formProducto").reset();
  const checkboxes = document.querySelectorAll('input[name="material"]');
  checkboxes.forEach(checkbox => {
    checkbox.checked = false;
  } );
  
  
}


document.getElementById('bodega').addEventListener('change', function () {
    const bodegaId = parseInt(this.value);

    if (!bodegaId) {
        poblarSelectSucursales([]); // Limpia si no hay selección
        return;
    }

    fetch(`http://localhost:8080/api/agencies.php?action=listByWarehouse&warehouse_id=${bodegaId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                poblarSelectSucursales(data.data);
            } else {
                console.error('Error al cargar sucursales:', data.message);
            }
        })
        .catch(error => {
            console.error('Error de red:', error);
        });
});


document.addEventListener('DOMContentLoaded', function () {
    const btnListar = document.getElementById('btnListarProductos');
    const btnCerrar = document.getElementById('btnCerrarLista');
    const contenedor = document.getElementById('containerListarProductos');
    const tbody = document.getElementById('tbodyProductos');

    // Ocultar el contenedor al cargar
    contenedor.style.display = 'none';

    btnListar.addEventListener('click', function () {
        fetch('http://localhost:8080/api/products.php?action=list')
            .then(function (response) {
                return response.json();
            })
            .then(function (json) {
                if (json.success && Array.isArray(json.data)) {
                    //console.log('Productos:', json.data); // Solo productos

                    // Limpiar tbody por si hay datos previos
                    tbody.innerHTML = '';

                    // Insertar cada producto como fila
                    json.data.forEach(function (producto) {
                        const tr = document.createElement('tr');

                          tr.innerHTML = `
                                <td>${producto.code}</td>
                                <td>${producto.name}</td>
                                <td>${producto.warehouse_name}</td>
                                <td>${producto.agency_name}</td>
                                <td>${producto.currency_name}</td>
                                <td>${producto.price}</td>
                                <td>${producto.description}</td>
                            `;

                        tbody.appendChild(tr);
                    });

                    contenedor.style.display = 'block'; // Mostrar tabla
                } else {
                    alert('No se pudieron obtener los productos');
                }
            })
            .catch(function (error) {
                console.error('Error al obtener productos:', error);
                alert('Error al obtener productos');
            });
    });

    btnCerrar.addEventListener('click', function () {
        contenedor.style.display = 'none';
    });
});