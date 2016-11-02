$(function(){

	//回到顶部
	$('#btn_scro').click(function(){
		$("html,body").animate({scrollTop: 0}, 500);
	})

	$('#btn_mouse').mouseover(function(){
		$(this).find('.imgs').show();
	})
	$('#btn_mouse').mouseout(function(){
		$(this).find('.imgs').hide();
	});

	var Nav = $('#nav');
	var Nav_li = Nav.find('li');

	Nav_li.on('mouseover',function(){
		$(this).find('dt').find('img').eq(1).show();
		$(this).find('dt').find('img').eq(0).hide();


	})
	Nav_li.on('mouseout',function(){
		$(this).find('dt').find('img').eq(0).show();
		$(this).find('dt').find('img').eq(1).hide();
	})

	// 首页的二级导航菜单
	var classified = $('#hg-classified');
	var items_span = classified.find('.items_span');
	items_span.on('click',function(){
		$(this).parent().parent().find('.items').stop(true,false).slideToggle('slow').parent().find('em').toggleClass('rotate')
		$(this).parent().parent().siblings().find('.items').stop(true,false).slideUp('slideUp').parent().find('em').removeClass('rotate');
	})

	//  二级菜单的显示隐藏
	var click_me = $('#click_me');
	var list_commodity = $('#list_commodity');
	click_me.on('click',function(){
	list_commodity.stop(true,false).slideToggle('slow');
	$(this).find('i').toggleClass('btom')
	})

})