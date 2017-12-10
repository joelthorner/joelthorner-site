/*!
 * Next Level Cards (Bootstrap 4 alpha 2)
 *	https://joelthorner.com
 *
 * Joel Thorner - @joelthorner
 */

NextLevelCards = {
	cardToggleable 	: '[data-toggle=nlcard-toggle]',
	cardCloser 			: '[data-toggle=nlcard-closer]',
	cardHoverable 		: '[data-hover=nlcard-hover]',

	init : function(){
		NextLevelCards.events();
	},
	events : function(){
		
		$('.nlcard').each(function(index, el) {
			var _this = $(this);
			
			// toggle
			_this.find(NextLevelCards.cardToggleable).click(function(event) {
				_this.toggleClass('open');
			});

			_this.find(NextLevelCards.cardCloser).click(function(event) {
				_this.removeClass('open');
			});

			// hover
			if (_this.is(NextLevelCards.cardHoverable))
				_this.hover(function() {
					_this.addClass('open');
				}, function() {
					_this.removeClass('open');
				});

		});
	},

	action : function(nlcard, mode){
		nlcard.click(function(event) {
			if (mode === "toggle") nlcard.toggleClass('open');
			if (mode === "close") nlcard.removeClass('open');
			if (mode === "open") nlcard.addClass('open');
		});
	}

}

$(document).ready(function() {
	// init all nlcard data's attrs (automatic for toggle cards and hover cards)
	NextLevelCards.init();

	// method for manual "toggle | close | open" card 
	// NextLevelCards.action( $('#nlcard-1'), 'toggle' );

	// I recommend using data-hover="nlcard-hover" in .nlcard for hover performance
});