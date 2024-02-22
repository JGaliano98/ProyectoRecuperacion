document.addEventListener('DOMContentLoaded', function() {
    cargarAsignaturas().then(() => {
        inicializarDragAndDrop();
        cargarHorarioExistente(); 
    });
    generarTabla();
    document.getElementById('guardarHorario').addEventListener('click', guardarHorario);
});

function cargarAsignaturas() {
    return fetch('http://localhost/ProyectoRecuperacion/API/API_Asignatura.php')
        .then(response => response.json())
        .then(asignaturas => {
            const contenedorAsignaturas = document.getElementById('asignaturas');
            asignaturas.forEach(asignatura => {
                const divAsignatura = document.createElement('div');
                divAsignatura.draggable = true;
                divAsignatura.className = 'asignatura';
                divAsignatura.innerText = asignatura.nombre;
                divAsignatura.setAttribute('data-id', asignatura.ID);
                contenedorAsignaturas.appendChild(divAsignatura);
            });
        })
        .catch(error => console.error('Error al cargar las asignaturas:', error));
}

function inicializarDragAndDrop() {
    let asignaturas = document.querySelectorAll('.asignatura');
    let celdas = document.querySelectorAll('#horario td');

    asignaturas.forEach(asignatura => {
        asignatura.addEventListener('dragstart', function(e) {
            e.dataTransfer.setData('text', e.target.innerText);
            e.dataTransfer.setData('id_asignatura', asignatura.getAttribute('data-id'));
        });
    });

    celdas.forEach(celda => {
        celda.addEventListener('dragover', e => e.preventDefault());

        celda.addEventListener('drop', function(e) {
            e.preventDefault();
            const data = e.dataTransfer.getData('text');
            const idAsignatura = e.dataTransfer.getData('id_asignatura');
            // Llamada a la API para obtener el nombre de la asignatura por ID
            fetch(`http://localhost/ProyectoRecuperacion/API/API_Asignatura.php?id=${idAsignatura}`)
                .then(response => response.json())
                .then(asignatura => {
                    e.target.innerText = asignatura.nombre; 
                })
                .catch(error => console.error('Error al obtener el nombre de la asignatura:', error));
            e.target.setAttribute('data-id-asignatura', idAsignatura);
        });

        celda.addEventListener('dblclick', function(e) {
            e.target.innerText = '';
            e.target.removeAttribute('data-id-asignatura');
        });
    });
}

function generarTabla() {
    let tabla = document.getElementById('horario');
    let dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
    let horas = ['1', '2', '3', '4', '5', '6'];

    let filaEncabezado = tabla.insertRow();
    filaEncabezado.insertCell(); 

    dias.forEach(dia => {
        let celda = filaEncabezado.insertCell();
        celda.innerText = dia;
    });

    horas.forEach(hora => {
        let fila = tabla.insertRow();
        let celdaHora = fila.insertCell();
        celdaHora.innerText = hora;

        dias.forEach(dia => {
            let celda = fila.insertCell();
            celda.setAttribute('data-hora', hora); 
            celda.setAttribute('data-dia', dia);
            celda.className = "celdaHorario";
        });
    });
}

function cargarHorarioExistente() {
    fetch('http://localhost/ProyectoRecuperacion/API/API_Horario.php')
        .then(response => response.json())
        .then(horario => {
            if(Array.isArray(horario)) {
                horario.forEach(item => {
                    let celdas = document.querySelectorAll(`#horario td[data-dia="${item.dia}"][data-hora="${item.hora_inicio}"]`);
                    celdas.forEach(celda => {
                        fetch(`http://localhost/ProyectoRecuperacion/API/API_Asignatura.php?id=${item.ID_Asignatura}`)
                            .then(response => response.json())
                            .then(asignatura => {
                                celda.innerText = asignatura.nombre;
                            })
                            .catch(error => console.error('Error al obtener el nombre de la asignatura:', error));
                        celda.setAttribute('data-id-asignatura', item.ID_Asignatura);
                    });
                });
            }
        })
        .catch(error => console.error('Error al cargar el horario existente:', error));
}



function guardarHorario() {
    let userId = document.getElementById('userId').value;
    let celdas = document.querySelectorAll('#horario td[data-id-asignatura]');
    let horariosParaGuardar = [];

    celdas.forEach(celda => {
        let dia = celda.getAttribute('data-dia');
        let horaInicio = celda.getAttribute('data-hora');
        let idAsignatura = celda.getAttribute('data-id-asignatura');
        let horaFin = parseInt(horaInicio) + 1;

        if (dia && horaInicio && idAsignatura && userId) {
            horariosParaGuardar.push({
                ID_Usuario: userId,
                ID_Asignatura: idAsignatura,
                hora_inicio: horaInicio,
                hora_fin: horaFin,
                dia: dia
            });
        }
    });

    // Primero eliminar el horario existente
    fetch('http://localhost/ProyectoRecuperacion/API/API_Horario.php', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log('Horario Eliminado:', data);
        if (horariosParaGuardar.length > 0) {
            return fetch('http://localhost/ProyectoRecuperacion/API/API_Horario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(horariosParaGuardar)
            });
        }
    })
    .then(response => {
        if (response) {
            return response.json();
        }
    })
    .then(data => {
        if (data) {
            console.log('Horario guardado:', data);
        }
    })
    .catch(error => console.error('Error en la operación del horario:', error));
}
