document.addEventListener("DOMContentLoaded", function() {


    const btnSeleccionar = document.getElementById('seleccionar');
    const fechaInput = document.getElementById('fechaSeleccionada');
    const horaSelect = document.getElementById('horaSeleccionada');
    const tbody = document.querySelector('#listaAsistencia tbody');


    let faltasParaEliminar = [];



    btnSeleccionar.addEventListener('click', function() {
        const fecha = fechaInput.value;
        const hora = horaSelect.value;
        if (!fecha || !hora) {
            alert("Por favor, seleccione una fecha y un tramo horario.");
            return;
        }

        cargarAlumnos(fecha, hora);
    });

    document.getElementById('guardarAsistencia').addEventListener('click', function() {
        const faltasParaGuardar = [];
        document.querySelectorAll('#listaAsistencia tbody tr').forEach(fila => {
            const idAlumno = fila.querySelector('button[data-id]').dataset.id;
            const botonSeleccionado = fila.querySelector('.asistenciaBtn.seleccionado');
            if (botonSeleccionado) {
                const tipoAsistencia = botonSeleccionado.dataset.tipo;
                faltasParaGuardar.push({
                    ID_Usuario: idAlumno,
                    fecha: fechaInput.value,
                    hora: horaSelect.value, 
                    estado: tipoAsistencia, 
                });
            }
        });
    
        guardarFaltas(faltasParaGuardar);
        eliminarFaltas();
    });
    



    function cargarAlumnos(fecha, hora) {
        fetch('./API/API_Usuario.php')
            .then(response => response.json())
            .then(alumnos => {
                tbody.innerHTML = '';

                //Añado los datos de los alumnos 

                alumnos.forEach(alumno => {
                    const fila = document.createElement('tr');
                    fila.innerHTML = `
                        <td>${alumno.nombre + " " + alumno.apellido1 + " " + (alumno.apellido2 || '')}</td>
                        <td><button class="asistenciaBtn" data-id="${alumno.ID}" data-tipo="J">J</button></td>
                        <td><button class="asistenciaBtn" data-id="${alumno.ID}" data-tipo="I">I</button></td>
                        <td><button class="asistenciaBtn" data-id="${alumno.ID}" data-tipo="R">R</button></td>
                    `;
                    tbody.appendChild(fila);
                });

                //Añado los manejadores

                agregarManejadoresEventosAsistencia();
                marcarAsistencias(fecha, hora);
            })
            .catch(error => console.error('Error:', error));
    }




   function agregarManejadoresEventosAsistencia() {
    document.querySelectorAll('.asistenciaBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!this.classList.contains('seleccionado')) {
                // Desmarca todos los botones de la fila y remueve las clases de colores
                this.closest('tr').querySelectorAll('.asistenciaBtn').forEach(b => {
                    b.classList.remove('seleccionado', 'justificada', 'injustificada', 'retraso');
                });
                // Marca este botón como seleccionado
                this.classList.add('seleccionado');
                // Aplica la clase de color según el tipo de asistencia
                switch (this.dataset.tipo) {
                    case 'J':
                        this.classList.add('justificada');
                        break;
                    case 'I':
                        this.classList.add('injustificada');
                        break;
                    case 'R':
                        this.classList.add('retraso');
                        break;
                }
            }
        });

        btn.addEventListener('dblclick', function() {
            if (this.classList.contains('seleccionado')) {
                this.classList.remove('seleccionado', 'justificada', 'injustificada', 'retraso');
                // Añadir a la lista de faltas para eliminar
                const faltaParaEliminar = {
                    ID_Usuario: this.dataset.id,
                    fecha: fechaInput.value,
                    hora: horaSelect.value
                };
                faltasParaEliminar.push(faltaParaEliminar);
            }
        });
    });
}



    function eliminarFaltas() {
        faltasParaEliminar.forEach(falta => {
            fetch('./API/API_Falta.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ...falta, accion: 'eliminar' }) 
            })
            .then(response => response.json())
            .then(data => console.log("Falta eliminada:", data))
            .catch(error => console.error('Error al eliminar falta:', error));
        });
        faltasParaEliminar = [];
    }
    




    function marcarAsistencias(fecha, hora) {
        fetch(`./API/API_Falta.php?fecha=${fecha}&hora=${hora}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Respuesta de red no fue ok');
                }
                return response.json();
            })
            .then(faltas => {
                faltas.forEach(falta => {
                    let estadoAbreviado;
                    let claseColor;
                    switch(falta.estado) {
                        case 'Justificada':
                            estadoAbreviado = 'J';
                            claseColor = 'justificada'; 
                            break;
                        case 'Injustificada':
                            estadoAbreviado = 'I';
                            claseColor = 'injustificada'; 
                            break;
                        case 'Retraso':
                            estadoAbreviado = 'R';
                            claseColor = 'retraso'; 
                            break;
                        default:
                            console.log('Estado desconocido:', falta.estado);
                            return;
                    }
    
                    // Busca el botón correspondiente, lo marca como seleccionado y aplica la clase de color
                    
                    const boton = document.querySelector(`button[data-id="${falta.ID_Usuario}"][data-tipo="${estadoAbreviado}"]`);
                    if (boton) {
                        boton.classList.add('seleccionado', claseColor);
                    } else {
                        console.log("Botón no encontrado para ID_Usuario:", falta.ID_Usuario, "con estado:", estadoAbreviado);
                    }
                });
            })
            .catch(error => console.error('Error al marcar asistencias:', error));
    }
    


    function guardarFaltas(faltas) {
        faltas.forEach(falta => {
           

            let estadoCompleto;
            switch(falta.estado) {
                case 'J':
                    estadoCompleto = 'Justificada';
                    break;
                case 'I':
                    estadoCompleto = 'Injustificada';
                    break;
                case 'R':
                    estadoCompleto = 'Retraso';
                    break;
                default:
                    console.error('Estado desconocido:', falta.estado);
                    return; 
            }
    
            const dataParaEnviar = {
                ...falta,
                estado: estadoCompleto
            };
    
            fetch('./API/API_Falta.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(dataParaEnviar)
            })
            .then(response => response.json())
            .then(data => console.log("Respuesta de guardar falta:", data))
            .catch(error => console.error('Error al guardar falta:', error));
        });
    }
    
     
    
});
