function imgResizer() {
  var width = $('.attachment-sela-hero-thumbnail').width();
  $('.attachment-sela-hero-thumbnail').css('height', width*(7/16));
  console.log("RESIZE");
}




$(document).ready(function() {

  $('#calendar').fullCalendar({

    // THIS KEY WON'T WORK IN PRODUCTION!!!
    // To make your own Google API key, follow the directions here:
    // http://fullcalendar.io/docs/google_calendar/

    // Production Key:
    // googleCalendarApiKey: 'AIzaSyBaWrN6Qhm6bSYw7iypKur4sP0rprvsX9A',

    // Testing Key:
    googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',


    // US Holidays
    events: {
      url: 'https://www.google.com/calendar/feeds/qc6lru9dnaj9o1k480aqvtgh3o%40group.calendar.google.com/public/basic',
      className: 'gcal-event'
    },

    eventClick: function(event) {
      // opens events in a popup window
      window.open(event.url, 'gcalevent', 'width=700,height=600');
      return false;
    },

    loading: function(bool) {
      $('#loading').toggle(bool);
    }

  });

});



// $(document).ready(function() {
//   $('#calendar').fullCalendar({
//     editable: false,
//     eventLimit: true,
//     header: {
//       left: 'prev,next today',
//       center: 'title',
//       right: 'month,agendaWeek'
//     },
//     events: {
//       url: 'https://www.google.com/calendar/feeds/qc6lru9dnaj9o1k480aqvtgh3o%40group.calendar.google.com/public/basic',
//       className: 'gcal-event'
//     },
//     eventClick: function(event) {
//       if (event.url) {
//         window.open(event.url);
//         return false;
//       }
//     },
//     theme: true,
//     themeButtonIcons: {
//       prev: 'circle-triangle-w',
//       next: 'circle-triangle-e',
//       prevYear: 'seek-prev',
//       nextYear: 'seek-next'
//     }
//   });

//   $('span.ui-icon').replaceTag('<div>', true);
// });

// $(document).ready(function() {
//   imgResizer();
// });
// $(window).resize(imgResizer);