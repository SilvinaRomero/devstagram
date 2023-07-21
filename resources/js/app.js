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
});

dropzone.on('sending',function(file,xhr,formData){
    // console.log('file '+file);
    
    // console.log('formdata ess '+formData);
    // console.log('type of '+typeof(formData));
});

dropzone.on('success',function(file,response){
    console.log(response);
});

dropzone.on('error',function(file,message){
    // console.log(message);
});

dropzone.on('removedfile',function(){
    // console.log('Archivo eliminado');
});
