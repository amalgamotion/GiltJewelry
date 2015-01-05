/**
*	@name							Accordion
*	@descripton						This Jquery plugin makes creating accordions pain free
*	@version						1.3
*	@requires						Jquery 1.2.6+
*
*	@author							Jan Jarfalk
*	@author-email					jan.jarfalk@unwrongest.com
*	@author-website					http://www.unwrongest.com
*
*	@licens							MIT License - http://www.opensource.org/licenses/mit-license.php


(function(jQuery){
     jQuery.fn.extend({  
         accordion: function() {       
            return this.each(function() {
            	var $ul = jQuery(this);
            	
				if($ul.data('accordiated'))
					return false;
													
				jQuery.each($ul.find('ul, li>div'), function(){
					jQuery(this).data('accordiated', true);
					jQuery(this).hide();
				});
				
				jQuery.each($ul.find('a'), function(){
					jQuery(this).click(function(e){
						activate(this);
						//jQuery(this).addClass("selected");
						return void(0);
					});
				});
				
				var active = (location.hash)?$(this).find('a[href=' + location.hash + ']')[0]:'';

				if(active){
					activate(active, 'toggle');
					jQuery(active).parents().show();
				}
				
				function activate(el,effect){	
					jQuery(el).parent('li').toggleClass('active').siblings().removeClass('active').children('ul, div').slideUp('fast');
					jQuery(el).siblings('ul, div')[(effect || 'slideToggle')]((!effect)?'fast':null);
				}
				
            });
        } 
    }); 
})(jQuery);
 
*/


function openNavigation(leftNav,ct){	
	if(leftNav.length!=ct){			
		var dms=leftNav[ct].parent().parent().parent().attr("class");			
		leftNav[ct].trigger('click');		
		if(dms!='content'){						
			setTimeout(function(){ openNavigation(leftNav,ct+1); },500);
		}
	}
}

function set_mail() {
	//alert("sdfdsaf");
	var submitted_mail;
	submitted_mail=document.getElementById('webform_current_mid').value;
	document.getElementById('webform_dynamic_mid').value=submitted_mail;
}

function getOpen(parentElms){			
	parentElms.trigger('mouseenter');		
	var neparentElm=parentElms.parent().parent().parent().children('a');		
	if(parentElms.attr('href') == '/vintage-and-antique/vintage-and-antique' || parentElms.attr('href') == '/era/era' || parentElms.attr('href') == '/artisan/artisan' || parentElms.attr('href') == '/vintage-and-antique/rings-0' || parentElms.attr('href') == '/vintage-and-antique/mens') {					
			parentElms.next('ul').show();
			parentElms.addClass('active');
	}		
	if(typeof neparentElm!='undefined'){	
		/* if(specificurl == '/vintage-and-antique/vintage-and-antique' || specificurl == '/era/era' || specificurl == '/artisan/artisan' || specificurl == '/catalog/rings') {					
			jQuery(this).next('ul').show();
			jQuery(this).addClass('active');
		} */
		setTimeout(function(){ getOpen(neparentElm); },500);
	}
}

jQuery(document).ready(function() {
	// jQuery('#block-taxonomy_menu_block-1 li ul').css('display','none');
	// jQuery("#block-taxonomy_menu_block-1 .current_tids").parents().show();
	// jQuery("#block-taxonomy_menu_block-1 .current_tids").children().show();
	// jQuery("#block-taxonomy_menu_block-1 .current_tids a").eq(0).addClass('active_name');
	//jQuery("#block-taxonomy_menu_block-1 .current_tids" ).closest('ul').prev('a').addClass('active').removeClass('arrow_images');
	// jQuery("#block-taxonomy_menu_block-1 .current_tids").parents('li').find('.arrow_images').addClass('active');

	// jQuery('#block-taxonomy_menu_block-2 li ul').css('display','none');
	// jQuery("#block-taxonomy_menu_block-2 .current_tids").parents().show();
	// jQuery("#block-taxonomy_menu_block-2 .current_tids").children().show();
	// jQuery("#block-taxonomy_menu_block-2 .current_tids a").eq(0).addClass('active_name');

	// jQuery('#block-taxonomy_menu_block-3 li ul').css('display','none');
	// jQuery("#block-taxonomy_menu_block-3 .current_tids").parents().show();
	// jQuery("#block-taxonomy_menu_block-3 .current_tids").children().show();
	// jQuery("#block-taxonomy_menu_block-2 .current_tids a").eq(0).addClass('active_name');
	 
	 
	jQuery('#block-taxonomy_menu_block-1 ul ul,#block-taxonomy_menu_block-2 ul ul,#block-taxonomy_menu_block-3 ul ul').hide();
	var pathname = window.location.pathname;
	var leftNav=[];
    jQuery('#block-taxonomy_menu_block-1 li a,#block-taxonomy_menu_block-2 li a,#block-taxonomy_menu_block-3 li a').each(function(){
		var hrefs = jQuery(this).attr('href');	
		//alert(hrefs);
		if(hrefs == 'javascript:void(0)' || hrefs == '/vintage-and-antique/vintage-and-antique' || hrefs == '/era/era' || hrefs == '/artisan/artisan' || hrefs == '/catalog/rings-0' || hrefs == '/catalog/mens' || hrefs == '/vintage-and-antique/rings' || hrefs == '/vintage-and-antique/mens' || hrefs == '/vintage-and-antique/wedding-engagement') {
			leftNav[leftNav.length]=jQuery(this); 			
		}		
		if(pathname==jQuery(this).attr('href')){	
			
			var getText=jQuery(this).text();
			jQuery(this).css("color","#000").css("font-weight","bold");
			var parentElm=jQuery(this).parent().parent().parent().children('a');
			
			setTimeout(function(){ getOpen(parentElm); },500);	
		
			if(hrefs == '/vintage-and-antique/vintage-and-antique' || hrefs == '/era/era' || hrefs == '/artisan/artisan' || hrefs == '/catalog/rings-0' || hrefs == '/catalog/mens' || hrefs == '/vintage-and-antique/rings' || hrefs == '/vintage-and-antique/mens' || hrefs == '/vintage-and-antique/wedding-engagement') {

				//if(jQuery(this).hasClass("arrow_image")){
					jQuery(this).next('ul').show();
					jQuery(this).addClass('active');
				//}
			}	
			
			
			//jQuery(this).parent().html(getText);
			//for(i=0;i<leftNav.length;i++){						
				//leftNav.reverse();	
				//setTimeout(function(){ openNavigation(leftNav,0); },500);
				//jQuery(this).parents('.content').children('a').addClass('myclass');				
				
				//break;
			//}			
			return false;
		}			
	}); 
		
	
	/* jQuery('#block-taxonomy_menu_block-1 li a,#block-taxonomy_menu_block-2 li a,#block-taxonomy_menu_block-3 li a').click(		
		function() {				
			var href = jQuery(this).attr('href');			
			if(href == 'javascript:void(0)') {
				var openMe = jQuery(this).next();
				var mySiblings = jQuery(this).parent().siblings().find('ul');
				if (openMe.is(':visible')) {
					//alert(1);
					jQuery(this).removeClass('active');
					openMe.slideUp('fast');  
				} else {
					//alert(2);
					jQuery(this).addClass('active');
					openMe.slideDown('fast');
					mySiblings.slideUp('fast', function() {
						jQuery(this).prev().removeClass('active');
						//jQuery(this).removeClass('active');
					});					
				}
			 }
	      }
	);  */
	
	/* jQuery('#block-taxonomy_menu_block-1 li,#block-taxonomy_menu_block-2 li,#block-taxonomy_menu_block-3 li').hover(function() {
		//jQuery('ul', this).css('display', 'block');  
		jQuery(this).children('ul').slideDown(100);
		if (jQuery(this).children('ul').length > 0){
			jQuery(this).children('a').addClass('active');
		}
		//alert(jQuery(this).children('a').attr('href'));
	}, function() {
		jQuery(this).children('ul').slideUp(100);
		jQuery(".current_tids").children('ul').slideDown(100);
		jQuery(".current_tids").parents('ul').slideDown(100);
		//if (jQuery(this).children('ul').length > 0){
			jQuery(this).children('a').removeClass('active');
		//}
	});   */
	
	jQuery('#left-column ul').dcAccordion({
		eventType: 'hover',
		hoverDelay: 400,
		menuClose: false,
		autoClose: false,
		saveState: true,
		autoExpand: false,
		//classExpand: 'current-menu-item',
		classDisable: '',
		showCount: false,
		disableLink: true,
		//cookie: 'dc_jqaccordion_widget-2',
		speed: 'slow'
	});		
	
});