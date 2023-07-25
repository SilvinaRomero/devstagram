// import './bootstrap';
// import '../css/app.css'; 

import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage:"Sube aquí tu imagen",
    acceptedFiles:".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles:1,
    uploadMultiple:false,

    init: function(){
        if(document.querySelector('[name="image"]').value.trim()){
            const imagenPublicada = {};
            imagenPublicada.size=1234;
            imagenPublicada.name = document.querySelector('[name="image"]').value;

            this.options.addedfile.call(this,imagenPublicada);
            this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success','dz-complete');
        }
    }
});

// dropzone.on('sending',function(file,xhr,formData){
//     console.log('file '+file);
    
//     console.log('formdata ess '+formData);
//     // console.log('type of '+typeof(formData));
// });

dropzone.on('success',function(file,response){
    console.log(response.image);
    document.querySelector('[name="image"]').value = response.image;
});

// dropzone.on('error',function(file,message){
//     console.log(message);
// });

dropzone.on('removedfile',function(){
    document.querySelector('[name="image"]').value = '';
});
