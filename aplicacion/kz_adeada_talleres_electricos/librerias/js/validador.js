$.extend({
		/* PARAMOS LA EJECUCIÓN*/
		stop: function(e){
        if (e.preventDefault) e.preventDefault();
        if (e.stopPropagation) e.stopPropagation();
    }, 
    /* PERSONALIZAMOS LA SALIDA POR PANTALLA */
    alert: function(str) {
    	alert(str);	
    }
});


$(document).ready(function(){

	$("form.validable").bind("submit", function(e){
		if (typeof filters == 'undefined') return;
	    $(this).find("input, textarea, select").each(function(x,el){ 
	        if ($(el).attr("className") != 'undefined') { 
		$(el).removeClass("error");
	        $.each(new String($(el).attr("className")).split(" "), function(x, klass){
	            if ($.isFunction(filters[klass]))
	                if (!filters[klass](el))  $(el).addClass("error");
	        });
	        }
	    });
		if ($(this).find(".error").size() > 0) {
			$.stop(e || window.event);
			return false;
		}
	    return true;
	});
});
