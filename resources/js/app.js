Dropzone.options.dropzone = {
    url: "{{ route('imagenes.store') }}",
    paramName: "file", // Nombre del campo
    maxFilesize: 5, // Tamaño máximo en MB
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    init: function () {
        console.log("Dropzone inicializado"); // Mensaje al inicializar

        this.on("success", function (file, response) {
            console.log("Archivo cargado exitosamente:", response); // Mensaje al subir archivo exitosamente
            document.querySelector('#imagen').value = response.archivo; // Actualiza el campo oculto
        });

        this.on("error", function (file, errorMessage) {
            console.error("Error al cargar archivo:", errorMessage); // Mensaje al fallar la carga
        });

        this.on("addedfile", function (file) {
            console.log("Archivo añadido:", file.name); // Mensaje al añadir archivo
        });

        this.on("sending", function (file, xhr, formData) {
            console.log("Enviando archivo:", file.name); // Mensaje al enviar archivo
        });

        this.on("queuecomplete", function () {
            console.log("Todos los archivos han sido procesados"); // Mensaje al finalizar la cola
        });
    }
};
