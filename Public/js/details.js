$(function(){

	// 商品详情页
	
	// 点击选项价钱
	function togClick(id1,id2)
	{
		var isCikBtn = $(id1).find('.color_tet');
		var isInput = $(id2);
		isCikBtn.on('click',function(){
			$(this).addClass('color_tetset')
			.parent().siblings().find('.color_tet').removeClass('color_tetset');

			var isV = $(this).attr('value');
			isInput.attr('value',isV)
		})
	}
	togClick('#colorid','#colorid_iput');
	togClick('#glid','#glid_iput');
	togClick('#xhid','#xhid_iput');
	togClick('#jxid','#jxid_iput');

	// 购买数量
	var jia = $('#jia');
	var jian = $('#jian');

	var numberVal= $('#number_val');
	jia.on('click',function(){
		var isVal = numberVal.val();
		isVal++;
		numberVal.val(isVal);
	})
	jian.on('click',function(){
		var isVal = numberVal.val();
		if(isVal > 0)
		{
			isVal--;
		}else
		{
			jian.attr('disable','')
		}
		numberVal.val(isVal);
	})
	// 商品详情切换效果
	var lists_text = $('#lists_text');
	var lists_texts = lists_text.find('li');
	var detaileds_listcen = $('#detaileds-listcen');
	var listcen1 = detaileds_listcen.find('.listcen1');

	lists_texts.click(function(){
		var isT = $(this).index();
		$(this).addClass('selected').siblings().removeClass('selected')
		listcen1.eq(isT).show().siblings().hide();
	})

	// 商品信息的进度条
	function fnSet(id1,id2,id3)
	{
		var oProgressBox = $(id1);
		var oProgressBar = $(id2);
		var oProgressText = $(id3);
		var allWidth = oProgressBox.width();
		var iNow = 0;
		var val = oProgressBox.parent().find('.hid_inpt').val();
		var timer = setInterval(function(){
		if( iNow == val)
		{
			clearInterval(timer)

		}else{
				iNow += 1;
				oProgressBox.parent().find('.jd').text( iNow + '%' )

				oProgressBar.css("clip","rect(0px,"+ iNow/100*allWidth +"px,10px,0)")
			}
		},30)
	};
	fnSet('#progressBox1','#progressBar1','#progressText1');
	fnSet('#progressBox2','#progressBar2','#progressText2');
	fnSet('#progressBox3','#progressBar3','#progressText3');

	// 文本框限制输入
	 var oDiv=document.getElementById('listcen6_topr');
	 var oP=oDiv.getElementsByTagName('P')[0];
	 var oT=oDiv.getElementsByTagName('textarea')[0];
	 var oA=oDiv.getElementsByTagName('input')[0];
	 // 判断是否是IE 
	 var ie=!-[1,]
	 var timer=null;
	 var bBon=true;
	 var iNum=0;
	 oT.onfocus=function()
	 {
	 	if(bBon)
	 	{
	 		oP.innerHTML='还可以输入<span>600</span>个字';
	 		bBon=false;
	 	};	
	 };
	 oT.onblur=function()
	 {
	 	if(oT.value=="")
	 	{
		 	oP.innerHTML='1/600';
		 	bBon=true;
	 	}
	 };
	 if(ie)
	 {
	 	oT.onpropertychange = toChange;
	 }else
	 {
	 	oT.oninput = toChange;
	 }
	 function toChange()
	 {
	 	var num=Math.ceil(getLength(oT.value)/2);
	 	var oSapn=oDiv.getElementsByTagName('span')[0];

	 	oT.value = oT.value.replace(/^ +| +$/g,'')
	 	if(num <= 600)
	 	{
	 		oSapn.innerHTML= 600 - num;
	 		oSapn.style.color='';
	 	}else
	 	{
	 		oSapn.innerHTML= num - 600;
	 		oSapn.style.color='red';
	 	}
	 	if(oT.value=='' ||  num>600)
	 	{
	 		oA.className='dis';
	 	}else
	 	{
	 		oA.className='';
	 	}
	 }	

	 function getLength(str)
	 {	
	 	// 判断双字节 也可以说判断的是中文
	 	return String(str).replace(/[^\x00-xff]/g,'aa').length;
	 }
	 oA.onclick=function()
	 {
	 	if( this.className=='dis')
	 	{
	 		clearInterval(timer)
	 		timer=setInterval(function(){
	 			if(iNum  == 5)
	 			{
	 				clearInterval(timer);
	 				iNum=0;
	 			}else
	 			{
		 			iNum++;
		 		}
		 			if(iNum % 2)
		 			{
		 				oT.style.borderColor='#e4393c';
		 			}else
		 			{
		 			 	oT.style.borderColor='';
		 			}

		 		}, 100)
	 		
	 	}else
	 	{
	 		alert('发布成功！')
	 	}
	 }

	 // 星星打分
	 var stars = $('#stars');
    //每次触发事件，清除该项父容器下所有子元素的样式所有样式
    function clearAll(obj){
        obj.parent().children('li').removeClass('on');
    }
    stars.find('li').click(function(){
        var num = $(this).index() + 1;
        clearAll($(this));
        //当前包括前面的元素都加上样式
        $(this).addClass('on').prevAll('li').addClass('on');
        //给隐藏域input赋值
        $(this).siblings('input').val(num);
    });
    stars.find('li').mouseover(function(){
        var num = $(this).index();
        clearAll($(this));
        //当前包括前面的元素都加上样式
        $(this).addClass('on').prevAll('li').addClass('on');
    });
    stars.find('li').mouseout(function(){
        clearAll($(this));
        //触发点击事件后input有值
        var score = $(this).siblings('input').val();
        for(i=0;i<score;i++){
            $(this).parent().find('li').eq(i).addClass('on');
        }
    });

    // 通过前台显示的val显示相应的星星数量
    var list_ul = $('#list_ul');
    var list_ullis = list_ul.children();
    var xsinpt = list_ullis.find('.xsinpt').val();
    var listUllisUl = list_ullis.find('ul');
    var UllisUlLi = listUllisUl.find('li');
    var htmlText = '';

    for( var i = 0 ; i<xsinpt; i++)
    {
    	htmlText += "<li></li>";
    }
	listUllisUl.html(htmlText)

	// 点击评论对应val 传入后台
	var bomul = $('#bomul');
	var bomulLis = bomul.find('li');
	var bomuIpts = bomul.find('input');
	bomulLis.click(function(){
		$(this).addClass('licolor').siblings().removeClass('licolor');
		bomuIpts.val($(this).find('em').text())
	})
	
})