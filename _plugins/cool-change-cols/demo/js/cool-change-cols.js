/*!
 * Cool Change Cols v1.5.0
 * http://joelthorner.com
 *
 * Copyright 2016 Joel Thorner - @joelthorner
 */
(function ( $ ) {
 
	$.fn.coolChangeCols = function( options, view ) {

		var CCClogMsg = 'cool-change-cols: ';

		var settings = $.extend({

			activeDefault : 				null,		//required
			itemToChangeSelector : 		null,		//required
			nameCookie : 					null,    //required
			classActiveButton : 			'active',
			mobileView : 					null, 
			mobileWidth : 					480,
			cookieDays : 					5,
			hideControlsOnMobile : 		false,
			effect : 						true,
			timeEffect : 					300,

			//events
			afterChangeView : 				function() {},
			afterLoadView : 					function() {},
			beforeChangeView : 				function() {},
			beforeLoadView : 					function() {},

			afterChangeViewMobile : 		function() {},
			afterOutViewMobile : 			function() {}

		}, options );
	

	// -- CONTROL OPTIONS -----------------------------------

		//control of data attr required
		if($('[data-ccc-view-name]').length === 0) console.error(CCClogMsg + '[ERROR] - Have not been found views!');
		
		if ($('[data-ccc-view-name]').length === 1) console.log(CCClogMsg + '[WARNING] - Have not been found views!');
		
		//control activeDefault
		if(settings.activeDefault==null) console.error(CCClogMsg + '[ERROR] - activeDefault setting is required');

		//control itemToChangeSelector
		if(settings.itemToChangeSelector==null) console.error(CCClogMsg + '[ERROR] - itemToChangeSelector setting is required');

		if(settings.nameCookie == null) console.error(CCClogMsg + '[ERROR] - nameCookie setting is required');

		//read coockie if not exists = undefined
		var CCCcookie = Cookies.get(settings.nameCookie);

	// -- END CONTROL OPTIONS ---------------------------------



	// -- ADD EVENTS CLICK ------------------------------------
		
		CCCclickEvents();

	// -- END ADD EVENTS CLICK --------------------------------



	// -- INIT ------------------------------------------------
		if (view && typeof(view) == 'string') {
			CCCevalEffects (view);
		}else{
			if(settings.mobileView != null)
			{
				CCCinit(false);
				$(window).resize(function(event) { CCCinit(true); });
			}else{
				CCCinit('no-mobile');
			}
		}

	// -- END INIT --------------------------------------------


		function CCCinit (resize) {
			if(resize!='no-mobile'){

				var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
				var windowWidth = $(window).innerWidth();
				
				if(isChrome) windowWidth = windowWidth + 17;

				if( windowWidth > settings.mobileWidth)
				{
					//si es mes gran fer el canvi de vista a normal
					CCCevalEffects(Cookies.get(settings.nameCookie));

					if(settings.hideControlsOnMobile) $('[data-ccc-view-name]').show();

					if(resize===true) CCCafterOutViewMobile(settings.afterOutViewMobile);
				}
				else
				{
					//ficar a versio mobile
					CCCevalEffects(settings.mobileView);

					if(settings.hideControlsOnMobile) $('[data-ccc-view-name]').hide();

					CCCafterChangeViewMobile(settings.afterChangeViewMobile);
				}
			}else
			{
				CCCevalEffects(Cookies.get(settings.nameCookie));
			}

			function CCCafterChangeViewMobile(doSomething){
				doSomething(settings.mobileView); 
			}

			function CCCafterOutViewMobile(doSomething){
				doSomething(settings.activeDefault);
			}
		}

		function CCCevalEffects (view){


			if(settings.effect)
			{
				if( CCCcookie )
				{
					CCCeffect(view, 'load');
				}
				else
				{
					CCCeffect(settings.activeDefault, 'load');
				}
			}
			else
			{
				$(settings.itemToChangeSelector).hide();

				if( CCCcookie )
				{
					CCCchangeView( CCCcookie , 'load');
				}
				else
				{
					CCCchangeView( settings.activeDefault, 'load');
				}
				$(settings.itemToChangeSelector).show();
			}
		}


		function CCCchangeView ( nameView , mode ){

			if(mode==='buttonClick') Cookies.set(settings.nameCookie, nameView, { expires: settings.cookieDays });
			
			var node = $('[data-ccc-view-name="' + nameView + '"]');

			if (!node.hasClass(settings.classActiveButton)) 
			{

				if(mode!='load')
				{
					CCCbeforeChangeView(settings.beforeChangeView);
				}
				else if(mode=='load')
				{
					CCCbeforeLoadView(settings.beforeLoadView);
				}

				$('[data-ccc-view-name]').removeClass(settings.classActiveButton);
				
				node.addClass(settings.classActiveButton);
				
				var classChangeTo = node.data('ccc-item-view');

				$(settings.itemToChangeSelector).each(function(index, el) {
					$(this).attr('class', classChangeTo);
				});

				// if(mode!='load')
				// {
				// 	CCCafterChangeView(settings.afterChangeView);
				// }
				// else if(mode=='load')
				// {
				// 	CCCafterLoadView(settings.afterLoadView);
				// }

			}
		}

		function CCCafterChangeView(doSomething){ var CCCval = CCCreturnView(); doSomething( CCCval ); }

		function CCCafterLoadView(doSomething){ var CCCval = CCCreturnView(); doSomething( CCCval ); }

		function CCCbeforeChangeView(doSomething){ var CCCval = CCCreturnView(); doSomething( CCCval ); }

		function CCCbeforeLoadView(doSomething){ var CCCval = CCCreturnView(); doSomething( CCCval ); }

		function CCCreturnView(){
			var res = Cookies.get(settings.nameCookie)
			if( res )
			{
				return res;
			}
			else
			{
				return settings.activeDefault;
			}
		}

		function CCCclickEvents (){

			$('[data-ccc-view-name]').each(function(index, el) {
				
				$(this).click(function(event) {

					Cookies.set(settings.nameCookie, $(this).data('ccc-view-name'), { expires: settings.cookieDays });

					if(settings.effect)
					{
						CCCeffect(Cookies.get(settings.nameCookie), 'buttonClick');
					}
					else
					{
						CCCchangeView($(this).data('ccc-view-name'), 'buttonClick');
					}

				});
			});
		}

		function CCCeffect(view, mode){
			var out = settings.timeEffect;
			var _in = settings.timeEffect;

			if(mode=='load')
			{
				var ___i=0;
				var ___max=$(settings.itemToChangeSelector).length;
				_in = settings.timeEffect * 2;

				$(settings.itemToChangeSelector).hide();
				CCCchangeView(view, mode);
				$(settings.itemToChangeSelector).fadeIn(_in, function(){

					if(___i==___max){
						CCCafterLoadView(settings.afterLoadView);
					}
					___i++;
				});



			}
			else
			{
				var ___i=0;
				var ___max=$(settings.itemToChangeSelector).length;
				$(settings.itemToChangeSelector).fadeOut(out, function() 
				{
					CCCchangeView(view, mode);

					$(settings.itemToChangeSelector).fadeIn(_in, function(){
						if(___i==___max){
							CCCafterChangeView(settings.afterChangeView);
						}
						___i++;
					});

				});

				

			}

			
		}

		return settings.nameCookie;

	};

 
}( jQuery ));