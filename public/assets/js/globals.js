function getAppURL(nroDirectories = 1) {

    // Obtener el pathname y eliminar el último "/" si existe
    const pathname = window.location.pathname.replace(/\/$/, "");

    // Identificar si estamos en localhost
    const isLocalhost = ["localhost", "127.0.0.1", "::1"].includes(window.location.hostname);

    // Construir la URL base
    const appURL = isLocalhost
        // En localhost, incluir los primeros dos directorios
        ? window.location.origin + pathname.split("/").slice(0, ++nroDirectories).join("/") + "/"
        : window.location.origin + "/"; // En producción, solo el dominio

    // console.log("appURL:", appURL);

    return appURL;
}

const APP_URL = getAppURL(2);
