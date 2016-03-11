$(document).ready(function(){
	
	"use strict";
    
    var source   = $("#entries").html(),
        template = Handlebars.compile(source);

    $.getJSON("data/entries.js", function(data) {
 
        $("#content-placeholder").html(template(data));
		
		$(".entries").gridalicious({
			width: 250, 
			gutter: 1, 
			selector: '.entry', 
			animate: true
		});
		
		/*$('.entries').flexipage({ 
			perpage: 9,
			pager: true, 
			navigation : false
		});*/
      
    }).error(function() {
        console.log("error");
    });

});

