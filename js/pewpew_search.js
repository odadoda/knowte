jQuery(document).ready( function(){
	jQuery(function ($) {
	var posts = jQuery('.posts');
	
	$("#pewpew_searchbar").focus();    
	
	jQuery("#pewpew_searchbar").keyup(function(evt){
	    var charCode = (evt.which) ? evt.which : evt.keyCode ;

		if(charCode != 13){

    		var querystrig = jQuery(this).val();
    		
    		if( querystrig.length > 1 ){
    		
    			jQuery.ajax({
    				type:"post",
    				dataType:"html",
    				url:pewpew.ajaxurl,
    				data:{action:"pewpew_search", s:querystrig},
    				success: function(response){
    				    jQuery('#main-post-list').html(response);
    				}
                });
                
    		}
		}
	});


	jQuery("#pewpew_searchform").submit( function( event ){
    	event.preventDefault();
    	var url = "/tag/"+$(this).children("#pewpew_searchbar").val();
    	window.location.href = url;
    	return false;
    });
    });
       
});