/* ------- DARK/LIGHT THEME TOGGLE ------- */

// USAR UN CONTENEDOR PARA EL SWITCH: <div class="theme-toggle" id="theme-toggle"></div>


if (document.getElementById('theme-toggle')) {

    // Función para alternar el tema entre claro y oscuro
    function toggleTheme() {
        const currentTheme = document.documentElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);

        // Actualizar la clase del switch
        document.getElementById('theme-toggle').classList.toggle('night', newTheme === 'dark');
    }

    // Cargar el tema almacenado o establecer el tema claro por defecto
    (function () {
        // Desactivar las transiciones al cargar la página
        document.documentElement.classList.add('no-transition');

        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);

        // Ajustar el estado inicial del switch
        document.getElementById('theme-toggle').classList.toggle('night', savedTheme === 'dark');

        // Habilitar transiciones después de la carga inicial
        setTimeout(() => {
            document.documentElement.classList.remove('no-transition');
        }, 100);
    })();

    // Añadir evento de clic al switch
    document.getElementById('theme-toggle').addEventListener('click', toggleTheme);

} else {

    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-bs-theme', savedTheme);
}
