console.log('JS OK!');

// alert('JS OK!');



/*--------------------------------------------------------------
# => SIDEBAR JS
--------------------------------------------------------------*/

// const toggleBtn = document.getElementById('toggle-btn');
// const sidebar   = document.getElementById('sidebar');

// // Función para actualizar el estado del sidebar en localStorage
// function updateSidebarState(isVisible) {
//     localStorage.setItem('sidebarVisible', isVisible ? 'true' : 'false');
// }

// // Aplicar el estado guardado solo si existe en el localStorage
// document.addEventListener('DOMContentLoaded', () => {
//     const storedState = localStorage.getItem('sidebarVisible');

//     if (storedState === 'false') {
//         sidebar.classList.remove('show');
//     } else if (storedState === 'true') {
//         sidebar.classList.add('show');
//     }
// });

// if (toggleBtn && sidebar) {
//     // Al hacer clic en el botón, mostrar/ocultar el menú
//     toggleBtn.addEventListener('click', function (event) {
//         event.stopPropagation();
//         sidebar.classList.toggle('show');

//         // Guardar el estado actual del sidebar en localStorage
//         const isVisible = sidebar.classList.contains('show');
//         updateSidebarState(isVisible);
//     });
// }


/*--------------------------------------------------------------
# => Simple SIDEBAR
--------------------------------------------------------------*/

// const toggleBtn = document.getElementById('toggle-btn');
// const sidebar = document.getElementById('sidebar');

// if (toggleBtn && sidebar) {

//     // Al hacer clic en el botón, mostrar/ocultar el menú
//     toggleBtn.addEventListener('click', function (event) {
//         // Evitar que el evento se propague al documento
//         event.stopPropagation();
//         sidebar.classList.toggle('show');
//     });

//     // Escuchar clics en cualquier parte del documento
//     document.addEventListener('click', function (event) {
//         // Si el clic no ocurrió dentro del menú o en el botón, ocultar el menú
//         if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
//             // Ocultar el menú
//             sidebar.classList.remove('show');
//         }
//     });
// }

document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar   = document.getElementById('sidebar');
    const overlay   = document.querySelector('.sidebar-overlay');

    if (toggleBtn && sidebar && overlay) {
        // Mostrar/ocultar el menú y la superposición al hacer clic en el botón
        toggleBtn.addEventListener('click', function (event) {
            event.stopPropagation();
            sidebar.classList.toggle('show'); // Alternar clase para el sidebar
            overlay.classList.toggle('show'); // Alternar clase para la superposición
        });

        // Ocultar el menú y la superposición al hacer clic en la superposición
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('show'); // Ocultar el sidebar
            overlay.classList.remove('show'); // Ocultar la superposición
        });

        // Ocultar el menú y la superposición al hacer clic fuera del sidebar o del botón
        document.addEventListener('click', function (event) {
            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                sidebar.classList.remove('show'); // Ocultar el sidebar
                overlay.classList.remove('show'); // Ocultar la superposición
            }
        });
    }
});

/*--------------------------------------------------------------
# => DATATABLES
--------------------------------------------------------------*/

const myTable = document.getElementById('myDataTable');

if (myTable) {
    new DataTable('#myDataTable', {
        language: {
            url: './public/vendor/datatables/es-ES.json',
        },
    });
}