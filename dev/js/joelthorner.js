(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100);
      };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');


/*---------------------------------------------------------------------*/

var JT = {};

JT.main = {
	init : function () {
		JT.utils.init();
		JT.menu.init();
		JT.home.init();
		JT.notfound.init();
		JT.repo.init();
		JT.allScope.init();
	}
};

JT.utils = {
	init : function () {
		// first read json for all
		JT.thisPage = $('body').data('zone');
		JT.base_url = $('#base_url').data('url'); $('#base_url').remove();
		JT.utils.read_json(JT.base_url + 'joelthorner.json');
		
		JT.utils.smothAnchors('a.anchor-effect');
		JT.utils.bootstrap_inits();
		JT.utils.iframeQuickView('.ajax-demo-preview');
		JT.utils.highlights();
	},
	highlights : function () {
		hljs.initHighlightingOnLoad(); 
	},
	read_json : function (file, callback) {
		$.getJSON( file, function( data ) {
			JT.json = data;
		});
	},
	smothAnchors : function (selector) {
		$(selector).click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[id=' + this.hash.slice(1) +']');
				console.log(target.offset().top)
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	},
	bootstrap_inits : function () {
		$('[data-toggle="tooltip"]').tooltip(); 
		$('[data-toggle="popover"]').popover({
			html : true,
			content : function(){
				return $($(this).data('html-origin')).html();
			}
		});
	},

	iframeQuickView : function (selector) {
		$(selector).on('click', function(event) {
			event.preventDefault();

			var sourceNode = $(this).parents('[data-demo-source]'),
				 source = sourceNode.data('demo-source'),
				 modal = $('#quickViewIframes');

			if (typeof source !== undefined) {
				var iframe = $('<iframe/>', {
					frameborder : 0,
					class : 'iframe-preview',
					src : source
					// scrolling : 'no'
				});
				modal.find('.md-content').html(iframe);
				setTimeout(function () {
					modal.addClass('md-show'); 
				}, 500)
			}
		});

		// closers
		$('.md-overlay, #quickViewIframes .md-close').on('click', function(event) {
			event.preventDefault();
			$('#quickViewIframes').removeClass('md-show');
		});
	}
};

JT.menu = {
	init : function () {
		JT.menu.collapses(); 
		JT.menu.toggler(); 
		JT.menu.scrollbar(); 
		// JT.menu.fourK(); 
		JT.menu.searchMenu(); 
	},

	searchMenu : function () {
		$('#menu-search-output .scrollbar-inner').scrollbar();
		$('#menu-search-output .scrollbar-inner').css('max-height', 232);
		
		JT.SEARCH.init($('#menu-search'), $('#menu-search-output .scrollbar-inner .results-search'), $('#clear-search-menu'));
		// $('#menu-search').on('focus', function(event) {
			// console.log('hello')
			// var scrollInner = $('#menu .scrollbar-inner');
			// console.log($('#menu .search').offset().top)
			// scrollInner.scrollTop($('#menu .search').offset().top);
		// }); 
	},

	collapses : function () {

		$('#menu li.has-submenu [data-toggle="collapse"]')
			.on('click.collapse-menu-init', function(){
				$(this).removeClass('init')
			}); 
		$('#menu .collapse').on('show.bs.collapse', function () {
			$(this).parent('li').addClass('open')
			$('#menu .collapse').collapse('hide')
		});
		$('#menu .collapse').on('hide.bs.collapse', function () {
			$(this).parents('li.has-submenu').removeClass('open')
		});
	},

	toggler : function () {
		$('#menu-toggler, #menuTogglerSmall').click(function(event) {
			$('body').toggleClass('open-menu');
			$(this).find('.inset').removeClass('init');
		}); 
	},

	scrollbar :function () {

		$('#menu .inset.scrollbar-inner').scrollbar();
		$('#menu .inset.scrollbar-inner').css('max-height', window.innerHeight);

		$(window).smartresize(function(){
			$('#menu .inset.scrollbar-inner').css('max-height', window.innerHeight);
		});
	},

	fourK : function () {
		JT.menu.fourK_eval();
		$(window).smartresize(function(){ JT.menu.fourK_eval() });
	},

	fourK_eval : function () {
		if (window.innerWidth >= 1800) {
			$('#menu').css('left', $('#main-content').offset().left - 260);
		}else{
			$('#menu').css('left', 0);
		}
	}
};

JT.home = {
	init : function () {
		if (JT.thisPage == "home") {
			JT.home.firstSlider();
			JT.home.scrollItems();
		}
	},

	firstSlider : function () {
		var swiper = new Swiper('.swiper-container', {
			pagination: '.swiper-pagination',
			paginationClickable: true,
			preventClicks : false,
			preventClicksPropagation : false,
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev'
		});
		$(window).smartresize(function(){
			setTimeout(function () {
				swiper.update();
			}, 500)
		}); 
	},

	scrollItems : function () {
		$('.column1x3 .scrollbar-inner').scrollbar();
	}
};

JT.notfound = {
	init : function () {
		if (JT.thisPage == "notfound") {
			JT.notfound.canvas();
			JT.notfound.showPage();
	 	} 
	},

	canvas : function () {
		
		var sizeCanvas = function () {
			var h = window.innerHeight;
			$('#canvas, .canvas-content').height(h);
		}
		sizeCanvas();
		$(window).smartresize(function(){ sizeCanvas(); });
	},

	showPage : function () {
		$('#main-content').css('opacity', 1); 
	}
};

JT.SEARCH = {

	sourcesSearch : null,

	events : function (input, output, clear) {
		input.on('input', function(event) {
			var val = $(this).val();
			var _results = JT.SEARCH.searchJson(val);
			JT.SEARCH.output(output, _results);

			if (val != "") clear.removeClass('hidden');
			else clear.addClass('hidden');
		});

		clear.on('click', function(event) {
			event.preventDefault();
			input.val('');
			JT.SEARCH.output(output, Array());
			$(this).addClass('hidden');
		});
	},

	output : function (destiny, _results) {
	 	var html = '';
	 	$.each(_results, function(index, val) {
			html = html + '<a href="'+JT.base_url+val.workType+'/'+val.name+'">'+val.name+'</a>';
		});
		destiny
			.removeAttr('class')
			.addClass('results-search results-'+_results.length)
			.html(html);
	},

	searchJson : function (inputVal) {
		
		var results = Array();
		
		if(inputVal != '' && typeof JT.json != 'undefined'){
			// here get info
			$.each(JT.json.repos, function(name, object) {
				var pushed = false;
				
				$.each(object, function(name2, object2) {
					var name2 = name2.toLowerCase();
					if (typeof object2 == "string" ){
						var object2 = object2.toLowerCase();

						if(object2.indexOf(inputVal) > -1 && !pushed) {
							object.name = name;
							results.push(object);
							pushed = true;
						}
					}
				});
			});
		}

		return results;
	},

	init : function (input, output, clear) {
		JT.SEARCH.events(input, output, clear);
	}
};

JT.repo = {
	init : function () {
		if (JT.thisPage == "plugin" || JT.thisPage == "snippet") {
			JT.repo.readme();
			JT.repo.page_init();
		}
	},
	readme : function () {
		$('table').addClass('table'); 
	},
	page_init :function () {
		// $('#main-content').height($(document).height());
		// $(window).smartresize(function(){
		// 	$('#main-content').height($(document).height());
		// });
	}

};

JT.allScope = {
	init : function(){
		if (JT.thisPage != 'home') {
			JT.allScope.scrollXXSS();
		}
	},

	scrollXXSS : function () {
		$(window).scroll(function(event) {
			if ($(window).scrollTop() > 70) {
				$('.social-inset').addClass('hidden');
			}else{
				$('.social-inset').removeClass('hidden');
			}
		}); 
	}
};

$( document ).ready(JT.main.init);