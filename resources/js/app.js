Dropzone.options.dropzone = {
    url: "/imagenes", // Ruta configurada en Laravel
    paramName: "file", // Nombre del parámetro para el archivo
    maxFilesize: 5, // Tamaño máximo en MB
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.doc,.docx,.pdf,.txt,.zip", // Tipos de archivos permitidos
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    success: function (file, response) {
        // Guardar la URL del archivo en el campo oculto
        document.querySelector('#archivo').value = response.archivo;
    }
};
