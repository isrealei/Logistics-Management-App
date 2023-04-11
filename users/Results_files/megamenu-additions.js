var USPS = USPS || {};
USPS.Require = USPS.Require || {};
document.addEventListener('touchstart', {passive: true});
global_elements_jq(document).ready(function($){
	$('.international-addition img').attr('alt',' ');
		a=$('.international-addition a').html()+"<span class=\"visuallyhidden\">Use our online scheduler to make a passport appointment. Schedule Today.</span>";
	$('.international-addition a').html(a);

	$('.shop-addition img').attr('alt',' ');
		a=$('.shop-addition a').html()+"<span class=\"visuallyhidden\">Shop Forever Stamps. Shop now.</span>";
	$('.shop-addition a').html(a);

	$('.business-addition img').attr('alt',' ');
		a=$('.business-addition a').html()+"<span class=\"visuallyhidden\">Grow your business with Every Door Direct Mail. Try EDDM now.</span>";
	$('.business-addition a').html(a);

	$('.manage-addition img').attr('alt',' ');
		a=$('.manage-addition a').html()+"<span class=\"visuallyhidden\">See what\'s coming to your mailbox using Informed Delivery&reg;. Learn More.</span>";
	$('.manage-addition img a').html(a);

	$('.mailship-addition img').attr('alt',' ');
		a=$('.mailship-addition a').html()+"<span class=\"visuallyhidden\">Print and ship from home. Start Click-N-Ship.</span>";
	$('.mailship-addition a').html(a);
    $('.global-logo').css('vertical-align', 'baseline');
	
});