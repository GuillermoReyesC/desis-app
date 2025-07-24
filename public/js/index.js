/***********************
 * Archivo JS para visualizar y gestionar productos  en el front
 * 
 ***********************/


document.addEventListener('DOMContentLoaded', function () {
  cargarBodegas();
});

function cargarBodegas() {
  fetch('WarehousesController')
    .then(response => {
      if (!response.ok) {
        throw new Error('Error al obtener las bodegas');
      }
      return response.json();
    })
    .then(data => {
      const select = document.getElementById('select_bodega');
      
      data.forEach(bodega => {
        const option = document.createElement('option');
        option.value = bodega.id_bodega;
        option.textContent = bodega.nombre_bodega;
        select.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Error al cargar las bodegas:', error);
    });
}