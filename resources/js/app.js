import Dropzone from "dropzone";

//Subir archivos
//Permite cambiar la confuguración por defecto
Dropzone.autoDiscover =  false;

//Consiguración básica
const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube la imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    maxFiles: 1,
    uploadMultiple: false,

    //Mostrar la imgencuando hay errores en el formulario
    init: function(){
        //Si el usuario ha subido una imagen
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {};
            imagenPublicada.size = 6000; //Este valor no importa pero es requerido
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            //Extraer y mostrar la imagen
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            //Agregar estilos de Dropzone
            imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
        }
    }
});

//Si el archivo sube correctamente
dropzone.on('success', function(file, response){
    //Seleccionar campo imagen
    document.querySelector('[name="imagen"]').value = response.imagen;
});
//Evento remover el archivo
dropzone.on('removedfile', function(){
    document.querySelector('[name="imagen"]').value = '';
});