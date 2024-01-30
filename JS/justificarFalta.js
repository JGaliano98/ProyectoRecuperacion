window.addEventListener("load", function(){
    
    var btnJustificar = document.getElementById("btnJustificar");
    btnJustificar.addEventListener("click", function(ev) {
        debugger;
        ev.preventDefault();

        // Obtener los valores de los campos del formulario
        var ID_Justificacion = 1;
        var fechaFalta = document.getElementById("fecha").value;
        var motivo = document.getElementById("observaciones").value;
        var documento = document.getElementById("documento1").value;
       


        // Crear un objeto con los datos del usuario
        var datosJustificacion = {
            ID_Justificacion: ID_Justificacion,
            fecha: fechaFalta,
            motivo: motivo,
            documento: documento,
        };

        alert(JSON.stringify(datosJustificacion));

        // Enviar los datos al servidor mediante una solicitud fetch
        fetch("http://localhost/ProyectoRecuperacion/API/API_Justificacion.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(datosJustificacion)
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
