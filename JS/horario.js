// script.js
document.addEventListener('DOMContentLoaded', function() {
    generarTabla();

    let asignaturas = document.querySelectorAll('.asignatura');
    let celdas = document.querySelectorAll('#horario td');

    asignaturas.forEach(function(asignatura) {
        asignatura.addEventListener('dragstart', function(e) {
            e.dataTransfer.setData('text', e.target.innerText);
        });
    });

    celdas.forEach(function(celda) {
        celda.addEventListener('dragover', function(e) {
            e.preventDefault();
        });

        celda.addEventListener('drop', function(e) {
            e.preventDefault();
            let data = e.dataTransfer.getData('text');
            e.target.innerText = data;
        });
    });
});

function generarTabla() {
    let tabla = document.getElementById('horario');
    let dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
    let horas = ['Primera', 'Segunda', 'Tercera', 'Cuarta', 'Quinta', 'Sexta'];

    // Crear fila de encabezado para los días
    let filaEncabezado = tabla.insertRow();
    filaEncabezado.insertCell(); // Celda vacía en la esquina superior izquierda
    dias.forEach(function(dia) {
        let celda = filaEncabezado.insertCell();
        celda.innerText = dia;
    });

    // Crear filas con las horas
    for (let i = 0; i < horas.length; i++) {
        let fila = tabla.insertRow();
        let celdaHora = fila.insertCell();
        celdaHora.innerText = horas[i];
        for (let j = 0; j < dias.length; j++) {
            fila.insertCell();
        }
    }
}
