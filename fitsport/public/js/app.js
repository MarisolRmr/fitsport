import Dropzone from "dropzone";
Dropzone.autoDiscover = false;
const dropzone = new Dropzone ('#dropzone',{
    dictDefaultMessage:"Sube archivos pdf/xml aquí",
    acceptedFiles: ".pdf,.xml",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 2,
    uploadMultiple: false,
    
    //Trabajando con imagen en el contenedor de dropzone
    init: function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada ={};
            imagenPublicada.size = 1234
            imagenPublicada.name=
                document.querySelector('[name="imagen"]').value;
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                '/uploads/${imagenPublicada.name}'
            );
            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});

//Eventos de Dropzone
//dropzone.on('sending', function(file, xhr, formdata){
//    console.log(file);
//});

//Evento de envio correcto de imagen
dropzone.on('success', function(file, response){
    document.querySelector('[name="imagen"]').value  =response.imagen;
});

//Envío cuando hay error
dropzone.on('error', function(file, message){
    console.log(message);
});

//Remover un archivo
dropzone.on('removedfile', function(){
   document.querySelector('[name="imagen"]').value="";
});