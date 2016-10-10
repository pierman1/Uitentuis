jQuery(document).ready(function($) {

	'use strict'

	var launcher = {

		init: function() {

            var body = document.querySelector('body');
            
            if (body.classList.contains('page-template-page--home')) {
                
                home.fullpage();
                home.sectionNavigation();
                home.slidesNavigation();
                home.addDataAttrMenu();

            }
		}
	}

	var home = {
		
		fullpage: function() {
			var arrowDown = $('.section__arrow-down');

			$('#fullpage').fullpage({
	    
		        menu: '#menu-header-menu',
		        lockAnchors: false,
		        anchors:['showcase', 'research', 'projects', 'about', 'contact'],
		        sectionSelector: '.section',
		        slideSelector: '.slide',
		        menu: '#menu-header-menu',
		        slidesNavigation: false,
		        paddingTop: '40px',
		        onLeave: function(index, nextIndex, direction){
		            
		            if(index == 4 && direction =='down') {

		                arrowDown.addClass('section__arrow-down--hidden');

		            } else if (nextIndex !== 5) {

		            	arrowDown.removeClass('section__arrow-down--hidden');

		            }
		        },
		        afterLoad: function(anchorLink, index){
		        	
		        	if (index == 5) {
		        		arrowDown.addClass('section__arrow-down--hidden');
		        		console.log('its 5')
		        	} 
				}
			})
		},

		sectionNavigation: function() {
			var arrowDown = $('.section__arrow-down');
			var backButton = $('.section-contact__back-button');
						
			arrowDown.on('click', function(e) {
				e.preventDefault();
				$.fn.fullpage.moveSectionDown();
			});

			backButton.on('click', function(e) {
				$.fn.fullpage.moveTo('showcase', 1);
			});
		},

		slidesNavigation: function() {
			var next = $('.section-projects .next');
			var prev = $('.section-projects .prev');

			console.log(next);

			next.on('click', function() {
				$.fn.fullpage.moveSlideRight();
			});

			prev.on('click', function() {
				$.fn.fullpage.moveSlideLeft();
			});
		},

		addDataAttrMenu: function() {
			var menuItems = $('.menu-item');

			$.each($(menuItems), function(menuItem) {
				var link = $(this).find($('a'));
				var href = link.attr('href');
				var dataMenuAnchor = href.substring(1, href.length);


				$(this).attr('data-menuanchor', dataMenuAnchor);

			})
		}
 	}
	launcher.init();
})
