(function( $ ) {
	'use strict';
	   $(document).ready(function() {
	   	
	   	 $('#with-altField').multiDatesPicker({
			                    altField: '#altField',
			                    dateFormat: "yy-m-d"
		                    });

          $('.date_slote').datepicker({
                 dateFormat: 'yy-mm-dd'
           });
	    
	     $('.timepiker').ptTimeSelect();

	      [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
            new CBPFWTabs( el );
          });

          
	   
	   });	

})( jQuery );
