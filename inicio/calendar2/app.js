const valoresURL = window.location.search;
const parametroURL = new URLSearchParams(valoresURL);
var idusu = parametroURL.get('idu');
var myModal = new bootstrap.Modal(document.getElementById('myModal'));
let frm = document.getElementById('formulario');
let eliminar = document.getElementById('btnEliminar');
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev next today',
            center: 'title',
            right: 'dayGridMonth timeGridWeek listWeek'

        },
        footerToolbar:{
            right: 'prevYear nextYear'
        },
        events: base_url + 'Home/listar',
        editable: true,
        dateClick: function(info){
            frm.reset();
            
            id = document.getElementById('id').value;
            console.log(id);
            document.getElementById('start').value = info.dateStr;
            document.getElementById('btnAccion').textContent = 'Registrar';
            eliminar.classList.add('d-none');
            document.getElementById('titulo').textContent = 'Registro de eventos';
            myModal.show(); 
            console.log(id)
            console.log('form'+JSON.stringify(frm))
            console.log(info)
        },
        eventClick: function(info){
            console.log(info);
            document.getElementById('id').value = info.event.extendedProps.idevento;
            document.getElementById('titulo').textContent = 'Modificar evento';
            document.getElementById('btnAccion').textContent = 'Modificar';
            eliminar.classList.remove('d-none');
            document.getElementById('title').value = info.event.title;
            document.getElementById('description').value = info.event.endStr;
            document.getElementById('start').value = info.event.startStr;
            document.getElementById('color').value = info.event.backgroundColor;
            document.getElementById('end').value = info.event.endStr;
            document.getElementById('hora').value = info.event.extendedProps.idevento;
            console.log(document.getElementById('id').value);
            myModal.show();
        },
        eventDrop: function(info){
            const id = info.event.extendedProps.idevento;
            const fecha = info.event.startStr;
            console.log(id);
            console.log(fecha);
                const url = base_url + 'Home/drop';
                const http = new XMLHttpRequest();
                const data = new FormData();
                data.append('id', id);
                data.append('fecha', fecha);
                http.open('POST', url, true);
                http.send(data);
                console.log();
                http.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status== 200){
                        
                        console.log(this.responseText);
                        
                        const respuesta = JSON.parse(this.responseText);
                        
                        console.log(respuesta);
                        if(respuesta.estado){
                            calendar.refetchEvents();
                        }
                        Swal.fire(
                            'Aviso', respuesta.msg, respuesta.tipo
                        );
                    }
                }
        }
    });
    calendar.render();
    frm.addEventListener('submit', function(e){
        e.preventDefault();
        const title = document.getElementById('title').value;
        const descripcion = document.getElementById('description').value;
        const fecha = document.getElementById('start').value;
        const color = document.getElementById('color').value;
        const id = document.getElementById('id').value;
        const idusuario = idusu;
        console.log(idusuario) 
        console.log(title)
        console.log(fecha)
        console.log(color)
        console.log(id)
        console.log(descripcion)
        if( title == '' || fecha == '' || color == ''){
            Swal.fire(
                'Aviso', 'Todos los campos son requeridos', 'warning'
            );
        }else{
            const url = base_url + 'Home/registrar';
            console.log(url)
            const http = new XMLHttpRequest();
            http.open('POST', url, true);
            http.send(new FormData(frm));
            console.log('frm: '+JSON.stringify(frm));
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status== 200){
                    
                    console.log(this.responseText);
                    
                    const respuesta = JSON.parse(this.responseText);
                    
                    console.log(respuesta);
                    if(respuesta.estado){
                        calendar.refetchEvents();
                    }
                    myModal.hide();
                    Swal.fire(
                        'Aviso', respuesta.msg, respuesta.tipo
                    );
                }
            }
        }

    });
    eliminar.addEventListener('click', function(){
        myModal.hide();
        Swal.fire({
            title: '¿Seguro que quieres eliminar este evento?',
            text: "Esta acción no se podrá revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#30D662',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, elimínalo',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const id = document.getElementById('id').value;
                const url = base_url + 'Home/eliminar/' + id;
                const http = new XMLHttpRequest();
                http.open('GET', url, true);
                http.send(new FormData(frm));
                console.log();
                http.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status== 200){
                        
                        console.log(this.responseText);
                        
                        const respuesta = JSON.parse(this.responseText);
                        
                        console.log(respuesta);
                        if(respuesta.estado){
                            calendar.refetchEvents();
                        }
                        Swal.fire(
                            'Aviso', respuesta.msg, respuesta.tipo
                        );
                    }
                }
            }
        })
    })
});