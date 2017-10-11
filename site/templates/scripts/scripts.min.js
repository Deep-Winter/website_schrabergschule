(function ($, window, document, undefined) {

   'use strict';
  
  $(function () {
    $('.navigation-trigger').on('click', function() {
      $('#mobile-navigation').slideToggle(250);
    });

    var GammaSettings = {
            historyapi : false,
						// order is important!
						viewport : [ {
							width : 1200,
							columns : 5
						}, {
							width : 900,
							columns : 4
						}, {
							width : 500,
							columns : 3
						}, { 
							width : 320,
							columns : 2
						}, { 
							width : 0,
							columns : 2
						} ]
				};

        function fncallback() {}

		window.Gamma.init( GammaSettings, fncallback );
		
		$('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
            },
            defaultDate: moment().format(),
            locale: 'de',
            editable: false,
            navLinks: false, // can click day/week names to navigate views
            eventLimit: false, // allow "more" link when too many events
            events: {
                url: '../kalenderdaten/',
                error: function () {
                    $('#script-warning').show();
                }
            },
            loading: function (bool) {
                $('#loading').toggle(bool);
            }
        });

  });

})(jQuery, window, document);
