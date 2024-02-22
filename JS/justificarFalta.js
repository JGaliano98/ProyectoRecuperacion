window.addEventListener("load", function(){
    
    var btnJustificar = document.getElementById("btnJustificar");
    btnJustificar.addEventListener("click", function(ev) {
        ev.preventDefault();

        debugger;
        // Obtener los valores de los campos del formulario
        var idFalta = document.getElementById("idFalta").value;
        var ID_Justificacion = 1;
        var fechaFalta = document.getElementById("fecha").value;
        var motivo = document.getElementById("observaciones").value;
        const documentos = document.getElementById("documento1").files[0];
       
        var formData=new FormData();

        // Crear un objeto con los datos del usuario
        var datosJustificacion = {
            
            ID_Justificacion: ID_Justificacion,
            fecha: fechaFalta,
            motivo: motivo,
            idFalta: idFalta,
        };

        //alert(JSON.stringify(datosJustificacion));

        formData.append("json",JSON.stringify(datosJustificacion));
        formData.append("documento",documentos);

        // Enviar los datos al servidor mediante una solicitud fetch
        fetch("http://localhost/ProyectoRecuperacion/API/API_Justificacion.php", {
            method: "POST",
            body: formData
        })
        .then(x => x.json())
        .then(y => {
           alert("Justificación realizada con exito");
        })
        .catch(error => {
            console.error('Hubo un error:', error);
            alert('Hubo un error al procesar la solicitud');
        });
    });
});
