var myModal = new bootstrap.Modal(document.getElementById('myModal'))
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'es',
      headerToolbar: {
          left: 'prev, next, today',
          center: 'title',
          right: 'dayGridMonth, timeGridWeek, listWeek'
      },
      dateClick: function(info){
        document.getElementById('start').value = info.dateStr;
        document.getElementById('titulo').textContent = 'Registro de eventos';
        myModal.show(); 
      }
    });
    calendar.render();
  });