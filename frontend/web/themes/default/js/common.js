//
(function($){
    $.fn.TinySwiper = function(){

        return this.each(function(){
            var defaults = {
                screen_tag:'ul',
                direction:'left',
                speed:'slow',
                navBar:'auto',
                easing:'swing',
                stay:5000
            };
            var slider = $(this);
            var config_data = slider.attr('config-data');

            if(config_data!=undefined){
                try{
                    config_data = $.parseJSON(config_data);

                    var config = $.extend(defaults , config_data);
                }catch(e){
                    var config = defaults;
                }
            }


            var slider_w = slider.width(),
                slider_h = slider.height(),
                screen = slider.find('> '+config.screen_tag),
                total = screen.children().length,
                screen_w = slider_w * (total+1),
                screen_h = slider_h * (total+1),
                current=1;

                var animate = {left: -1 * slider_w * current};
                var init_location = {left:0};
                var is_float = 'left';
            if(config.direction=='top'){
                screen_w = slider_w;
                animate = {top: -1 * slider_h * current};
                init_location = {top:0};
                is_float = 'none';
            }else{
                screen_h = slider_h;
            }
            if(config.navBar=='fixed'){
                slider.css({position: "relative", margin: "0 auto"});
            }else{
                slider.css({position: "relative", margin: "0 auto",overflow: "hidden"});
            }

            screen.css({position: 'absolute',display: 'block',"height":screen_h,"width":screen_w});
            screen.children().css({"background-position":"50% 0%","background-repeat":"no-repeat no-repeat","height":slider_h,"width":slider_w , "float": is_float,margin:0,padding:0});
            screen.children().find(">*").css({display: 'block', width: '100%', height: '100%'});
            screen.children().eq(0).clone().appendTo(screen);
            var tem = '<ul class="swiper-nav">';
            if(config.navBar!='fixed'){
                for (var i = 1; i <= total; i++) {
                    tem+='<li><a>'+i+'</a></li>';
                }
            }else{
                tem = '<ul class="swiper-nav fixed">'
                tem+='<li><a class="pre"><</a></li><li><a class="next">></a></li>';
            }

            slider.append(tem+'</ul>');

            slider.find(".swiper-nav > li").removeClass('current').eq(0).addClass('current');
            //$(".swiper-nav >li >  a",slider).each(function(i){
            slider.find(".swiper-nav >li ").each(function(i){
                if($(this).hasClass('pre')){
                    var current_num = slider.find(".swiper-nav > li.current").index();
                    $(this).on("click", function(){
                        if(current_num<1){
                            current_num = 1;
                        }
                        run(current_num - 1);
                    });
                }else if($(this).hasClass('next')){
                    var current_num = slider.find(".swiper-nav > li.current").index();
                    $(this).on("click", function(){
                        run(current_num + 1);
                    });
                }else{
                    $(this).on("click", function(){
                        run(i);
                    });
                }
                $(this).on("mouseenter",function(){clearInterval(si);});
                $(this).on("mouseleave",function(){
                    si = setInterval(function(){
                    run();}, config.stay);});
            });
            var animate = {left: -1 * slider_w * current};
            var dot_nav_item = slider.find(".swiper-nav > li");
            var run = function (index){
                if(index!=undefined) current=index;
                animate = {left: -1 * slider_w * current};
                if(config.direction=='top'){
                    animate = {top: -1 * slider_h * current};
                }
                screen.animate(animate,config.speed,config.easing,function(){
                    current++;
                    if(current>total){
                        current=1;
                        screen.css(init_location);
                    }
                    dot_nav_item.removeClass('current').eq(current-1).addClass('current');
                });
            }
            //run(1);
            var si = setInterval(function(){
               run();
            }, config.stay);

        });
    }
})(jQuery);

function initOperat(){
	$(".operat").each(function(){
	    var operat = $(this);
	    operat.find(".action").on("mouseenter DOMNodeInserted",function(){

	        operat.removeClass("hidden").addClass("show_munu");
	        var offset = operat.offset();
	        var height = operat.find(".action").height();
	        var action_width = operat.find(".action").outerWidth();
	        var menu_select_width = operat.find(".menu_select").outerWidth();

	        if(offset.top+operat.find(".menu_select").height()+height < $(window).height()){
	        	if(offset.left+menu_select_width< $(window).outerWidth()) operat.find(".menu_select").offset({left:offset.left,top:(Math.floor(offset.top)+1+height)});
	        	else operat.find(".menu_select").offset({left:(offset.left+action_width-menu_select_width),top:(Math.floor(offset.top)+1+height)});
	            operat.find(".action").removeClass("top").addClass("bottom");
	        }else{
	            if(offset.left+menu_select_width< $(window).outerWidth()) operat.find(".menu_select").offset({left:offset.left,top:Math.ceil(offset.top)-1-operat.find(".menu_select").height()});
	            else operat.find(".menu_select").offset({left:(offset.left+action_width-menu_select_width),top:Math.ceil(offset.top)-1-operat.find(".menu_select").height()});
	            operat.find(".action").removeClass("bottom").addClass("top");
	        }

	    });
	    operat.on("mouseleave",function(){
	        operat.removeClass("show_munu").addClass("hidden");
	    })
	})
}

function tabs_init(){
	$(".tab").each(function(j){
		var that = $(this);
		that.attr("index",0);
		$(">.tab-head >*",that).each(function(i){
			var index = i;

			if(i!=0)$(this).removeClass('current');
			else $(this).addClass('current');
			$(">.tab-body > *",that).css({display:'none'});
			$(">.tab-body > *:eq(0)",that).css({display:'block'});
			$(this).on("click",function(){
				$(">.tab-head >*",that).removeClass('current');
				$(this).addClass("current");
				$(">.tab-body > *",that).css({display:'none'});
				$(">.tab-body > *:eq("+index+")",that).css({display:'block'})
				that.attr("index",i);
				tab_page_nav();
			})
		});
	});
	var hash = window.location.hash;
	var re = /#tab(-(\d+))+$/i;
	if(re.test(hash)){
		var num = hash.match(/\d+/g);
		var len = num.length;
		for(var i=0;i<len;i++) tabs_select(i,num[i]);
		tab_page_nav();
	}
}

function tab_page_nav(){
	var hash = '#tab';
	$(".tab").each(function(){
		hash += '-'+$(this).attr("index");
	});
	$(".page-nav a").each(function(){
		if($(this).attr('href')!='javascript:;' && $(this).attr('href')!='#'){
			var href = $(this).attr("href");
			href = href.replace(/#(.+)$/i,'')+hash;
			$(this).attr("href",href);
		}else{
			var onclick = $(this).attr("onclick");
			if(onclick!=undefined){
				onclick = onclick.replace(/(\+*\"#(.+)\")?;$/i,'+')+'\"'+hash+'\";';
				$(this).attr("onclick",onclick);
			}
		}
	})
}

//tabs插件选择
function tabs_select(num,index){
		var that = $(".tab:eq("+num+")");
		that.attr("index",index);
		$(">.tab-head >*",that).each(function(i){
			if(i!=index)$(this).removeClass('current');
			else $(this).addClass('current');
			$(">.tab-body > *",that).css({display:'none'});
			$(">.tab-body > *:eq("+index+")",that).css({display:'block'});
		});
}


//此插件必需结合Tiny系统的框架定义的Paging JQuery插件
(function($){
	//默认参数

	$.fn.Paging = function(options){
		var defaults = {url:null, params:{}, content:'',callback:function(){}};
		var o = {};
		var self = null;
		self = $(this);
		//对最原始模板的处理
		var id = self.attr("id");
		var content = $("#"+id).data("page-content-template");
		if(content){
			defaults.content = content;
		}else{
			defaults.content = self.find(".page-content").html();
			$("#"+id).data("page-content-template",defaults.content);
		}
		o = $.extend(defaults,options);
		getPage(1);

		//内部私有取得第几页
	function getPage(page){
		o.params = $.extend(o.params,{page:page});
		var data = $.data(self, "page_"+page);
		if(data){
			handle(data);
			if(typeof(o.callback)=="function") o.callback(self);
		}else{
			$.post(o.url,o.params,function(data){
				$.data(self, "page_"+page, data);
				handle(data);
				if(typeof(o.callback)=="function") o.callback(self);
			},"json");
		}

	}
	//处理数据
	function handle(data){
		if(data['status']=='success'){
				self.find(".page-content").html(rander(data['data']));
				self.find(".page-nav").html(data['html']);
				self.find(".page-nav a").each(function(){
					$(this).on("click",function(){
						var index = parseInt($(this).attr("page-index"));
						getPage(index);
					})
				});
				if(data['data']!='')self.removeClass('js-template');
			}
	}
	//数据渲染
	function rander (data){
		var str = '';
		if(typeof data=="object"){
			var num = 1;
			for(var i in data){
				data[i]['odd-even'] = "odd";
				if(num++%2==0)data[i]['odd-even'] = "even";
				str += o.content.replace(/{\s*([^}]+)\s*}/ig,function(s0,s1){
					var tem = s1.split("|");
					if(tem.length==2){
						return data[i][tem[0]] || tem[1];
					}
					else if(tem.length>2){
						if(data[i][tem[0]]) return tem[1];
						else return tem[2];
					}
					return data[i][s1]  || '';
				});
			}
		}
		return str;
	}
	}

})(jQuery);
// 无限级连动插件
(function($){
	$.fn.Linkage = function(options){

		var o = $.extend({url:'',selects:['#province','#city','#county'],initRunCallBack:false,selected:['0','0','0']}, options || {});
		var url = o.url;
		var arrNodeChild = new Array();
		var arrSelect = o.selected;
		var options = new Array();
		$.each(arrSelect,function(i){
			options[i] = '';
		});
		var len = o.selects.length;
		for(var i=0;i<len;i++) arrNodeChild[i] = new Array();
		//请求格式化后的JSON数据
		$.get(o.url,function(data){
			$.each(data, function(i, n){
				var c_id = i.substr(2);
				var selected = (c_id == arrSelect[0]) ? 'selected="selected"' : '';
				options[0] += '<option value="' + c_id + '" ' + selected + '>' + n.t + '</option>';

				n.id = c_id;
				if(n.c !== null){
					arrNodeChild[0][i] = n.c;
					parse(n,0);
				}
			});

			$.each(o.selects,function(i,em){
				$(em).append(options[i]);
			});
			if(o.initRunCallBack)callback();
		},"json");
		//解析每一层元素
		function parse(data,num){
			if(data.c !==undefined && data.c !== null) {
				$.each(data.c, function(i, n) {
					var c_id = i.substr(2);
					if(data.id == arrSelect[num]) {
						var selected = (c_id == arrSelect[num+1]) ? 'selected="selected"' : '';
						options[num+1] += '<option value="' + c_id + '" ' + selected + '>' + n.t + '</option>';
					}
					n.id = c_id;
					arrNodeChild[num+1][i] = n.c;
					if(n.c !== null) parse(n,num+1);
				});
			}
		}
		//回调处理
		function callback()
		{
			if(typeof(o.callback) == 'function'){
				var selected =new Array(); value =new Array(); text = new Array();
				$.each(o.selects,function(i,em){
					value[i] = $(em).val();
					text[i] = $('option:selected',$(em)).text();
				});
				selected[0] = value;
				selected[1] = text;
				o.callback(selected);
			}
		}
		//逐级绑定连动事件
		var len = o.selects.length;
		$.each(o.selects,function(i,em){
			$(em).change(function(){
				var val = 'o_'+$(this).val();
				if(arrNodeChild[i][val] !== null && i<len-1) {

					for(var j=i+1 ; j<len ;j++){
						var option = $(o.selects[j]).children().first();
						if(option.val()==0)$(o.selects[j]).empty().append(option);
						else $(o.selects[j]).empty().append("<option value='0'>请选择</option>");
					}
					if(val != 0){
						var select = '';
						if(arrNodeChild[i][val]!==undefined){
							$.each(arrNodeChild[i][val], function(k, n) {
		                	var c_id = k.substr(2);

		                    select += '<option value="' + c_id + '">' + n.t + '</option>';
		                });
		                $(o.selects[i+1]).append(select);
						}

					}
				}
				callback();
			});
		});
	};
})(jQuery);
//提交前咨询
function confirm_action(url,msg){
	if(msg==undefined) msg = '你确认删除操作吗？删除后无法恢复！';
	art.dialog.confirm(msg, function(){
		window.location.href = url;
	});
}
//刷新
function tools_reload(){
	location.reload();
}
//倒计时
(function($){
    $.fn.countdown = function(options){
    	var self = this;
    	var defaults = {id:'countdown',end_time:"2020-12-31 23:59:59",format:'{d}天 {h}小时{m}分{s}.{mi}秒',callback:function(){}};
		var o = $.extend(defaults, options);

		function runTime(){
			var endtime=new Date(o.end_time);
			var nowtime = new Date();
			var time = (endtime.getTime()-nowtime.getTime());
			var leftsecond=parseInt(time/1000);
			if(leftsecond<0){leftsecond=0;time=0;}
			__d=parseInt(leftsecond/3600/24);
			__h=parseInt((leftsecond/3600)%24);
			__m=parseInt((leftsecond/60)%60);
			__s=parseInt(leftsecond%60);
			__mi=parseInt(time/100%10);
			__d = __d<10?'0'+__d:__d;
			__h = __h<10?'0'+__h:__h;
			__m = __m<10?'0'+__m:__m;
			__s = __s<10?'0'+__s:__s;
			var date = {d:__d,h:__h,m:__m,s:__s,mi:__mi};
			var str = o.format.replace(/{\s*([^}]+)\s*}/ig,function(s0,s1){return date[s1];});

			self.html(str);
			if(leftsecond>0)setTimeout(runTime,100);
			else{o.callback();}
		}
		runTime();
	}
})(jQuery);

//卡片插件
(function($){
    $.fn.cardArea = function(options){
        var self = this;
        var defaults = {time:300};
        var o = $.extend(defaults, options);
        var dotag = true;
        var num = 1;
        $(".card-item",self).each(function(){
            $(this).on("mouseenter",function(){
                num = $(this).attr("data-index");
                    if(dotag ){
                        dotag = false;
                        setTimeout(function(){
                            $(" .active",self).removeClass('active');
                            $(".card-item",self).eq(num).addClass("active");
                            dotag = true;
                        }, o.time);

                    }

            })
        });
    }
})(jQuery);

function getFileName()
{
    var url = this.location.href;
    var pos = url.lastIndexOf("/");
    if(pos == -1)
        pos = url.lastIndexOf("\\");
    var filename = url.substr(pos+1);
    return filename;
}

function fnLoad()
{
    with(window.document.body)
    {
    	try{
	        addBehavior ("#default#userData");    // 使得body元素可以支持userdate
	        load("scrollState" + getFileName());    // 获取以前保存在userdate中的状态
	        if (sFirstEnter=="0")
	        {
	            scrollLeft = getAttribute("scrollLeft");    // 滚动条左位置
	            scrollTop = getAttribute("scrollTop");
	        }
	    }catch(e){

	    }
    }
}
function fnUnload()
{
    with(window.document.body)
    {
    	try{
    		setAttribute("scrollLeft",scrollLeft);
	        setAttribute("scrollTop",scrollTop);
	        save("scrollState" + getFileName());
    	}catch(e){

    	}
    }
}

window.onload = fnLoad;
window.onunload = fnUnload;

$(document).ready(function(){
　　tabs_init();
	initOperat();
	setTimeout(function(){
		$("#message-bar").fadeOut();
	},2000);
});

/*
    Enlarge for jQuery v1.1
    Abel Yao, 2013
    http://www.abelcode.com/
*/

(function($)
{
    // 默认参数
    var defaults = 
    {
        // 鼠标遮罩层样式
        shadecolor: "#FFD24D",
        shadeborder: "#FF8000",
        shadeopacity: 0.5,
        cursor: "move",
        
        // 大图外层样式
        layerwidth: 400,
        layerheight: 300,
        layerborder: "#DDD",
        fade: true,
        
        // 大图尺寸
        largewidth: 1280,
        largeheight: 960
    }
    
    // 插件入口
    var enlarge = function(option)
    {
        // 合并参数
        option = $.extend({}, defaults, option);
        
        // 循环处理
        $(this).each(function() 
        {
            var self = $(this).css("position", "relative");
        // 创建鼠标遮罩层
            var shade = $("<div>").css(
            {
                "position": "absolute",
                "left": "0px",
                "top": "0px",
                "background-color": option.shadecolor,
                "border": "1px solid " + option.shadeborder,

                "opacity": option.shadeopacity,
                "cursor": option.cursor
            });
            shade.hide().appendTo(self);

            // 创建大图和放大图层
            var large = $("<img>").css(
            {
                "position": "absolute",
                "display": "block",
                "width": option.largewidth,
                "height": option.largeheight
            });
            var layer = $("<div>").css(
            {
                "position": "absolute",
                "left": self.width() + 5,
                "top": 0,
                "background-color": "#111",
                "overflow": "hidden",
                "width": option.layerwidth,
                "height": option.layerheight,
                "border": "1px solid " + option.layerborder
            });
            large.appendTo(layer);
            layer.hide().appendTo(self);
            reLoad();

            self.on("mouseenter",reLoad);
            
            // 计算大小图之间的比例
            function reLoad(){
                var img = self.find("img:eq(0)");
                if(img.attr("source") == large.attr("src")) return;
                large.attr("src", img.attr("source"));
                imgReady(img.attr("source"), function () {
                option.largewidth = this.width;
                option.largeheight = this.height;
                var ratio =
                {
                    x: img.width() / option.largewidth,
                    y: img.height() / option.largeheight
                }
            
                // 定义一些尺寸
                var size = 
                {
                    // 计算鼠标遮罩层的大小
                    shade:
                    {
                        width: option.layerwidth * ratio.x - 2,
                        height: option.layerheight * ratio.y - 2
                    }
                }
                shade.css({
                    "width": size.shade.width,
                    "height": size.shade.height
                });
           
               large.css(
                {
                    "width": option.largewidth,
                    "height": option.largeheight
                });
                
                // 不可移动的半径范围
                var half = 
                {
                    x: size.shade.width / 2,
                    y: size.shade.height / 2
                }
            
                // 有效范围
                var area = 
                {
                    width: self.innerWidth() - shade.outerWidth(),
                    height: self.innerHeight() - shade.outerHeight()
                }
            
                // 对象坐标
                var offset = self.offset();
                
                // 显示效果
                var show = function()
                {
                    //large.attr("src", img.attr("source"));
                    offset = self.offset();
                    shade.show();
                    layer.show();
                }
            
                // 隐藏效果
                var hide = function()
                {
                    shade.hide();
                    layer.hide();
                }
                
                // 绑定鼠标事件
                self.mousemove(function(e)
                {
                    // 鼠标位置
                    var x = e.pageX - offset.left;
                    var y = e.pageY - offset.top;

                    // 判断是否在有效范围内
                    x = x - half.x;
                    y = y - half.y;
                    
                    if(x < 0) x = 0;
                    if(y < 0) y = 0;
                    if(x > area.width) x = area.width;
                    if(y > area.height) y = area.height;
                    
                    // 遮罩层跟随鼠标
                    shade.css(
                    {
                        left: x,
                        top: y
                    });
                    
                    // 大图移动到相应位置
                    large.css(
                    {
                        left: (0 - x / ratio.x),
                        top: (0 - y / ratio.y)
                    });

                })
                .mouseenter(show)
                .mouseleave(hide);
                });
            }

        });
    }
    
    // 扩展插件
    $.fn.extend(
    {
        enlarge: enlarge
    });
})(jQuery)

// 更新：
// 05.27: 1、保证回调执行顺序：error > ready > load；2、回调函数this指向img本身
// 04-02: 1、增加图片完全加载后的回调 2、提高性能

/**
 * 图片头数据加载就绪事件 - 更快获取图片尺寸
 * @version	2011.05.27
 * @author	TangBin
 * @see		http://www.planeart.cn/?p=1121
 * @param	{String}	图片路径
 * @param	{Function}	尺寸就绪
 * @param	{Function}	加载完毕 (可选)
 * @param	{Function}	加载错误 (可选)
 * @example imgReady('http://www.google.com.hk/intl/zh-CN/images/logo_cn.png', function () {
        alert('size ready: width=' + this.width + '; height=' + this.height);
    });
 */
var imgReady = (function () {
    var list = [], intervalId = null,

    // 用来执行队列
    tick = function () {
        var i = 0;
        for (; i < list.length; i++) {
            list[i].end ? list.splice(i--, 1) : list[i]();
        };
        !list.length && stop();
    },

    // 停止所有定时器队列
    stop = function () {
        clearInterval(intervalId);
        intervalId = null;
    };

    return function (url, ready, load, error) {
        var onready, width, height, newWidth, newHeight,
            img = new Image();
        
        img.src = url;

        // 如果图片被缓存，则直接返回缓存数据
        if (img.complete) {
            ready.call(img);
            load && load.call(img);
            return;
        };
        
        width = img.width;
        height = img.height;
        
        // 加载错误后的事件
        img.onerror = function () {
            error && error.call(img);
            onready.end = true;
            img = img.onload = img.onerror = null;
        };
        
        // 图片尺寸就绪
        onready = function () {
            newWidth = img.width;
            newHeight = img.height;
            if (newWidth !== width || newHeight !== height ||
                // 如果图片已经在其他地方加载可使用面积检测
                newWidth * newHeight > 1024
            ) {
                ready.call(img);
                onready.end = true;
            };
        };
        onready();
        
        // 完全加载完毕的事件
        img.onload = function () {
            // onload在定时器时间差范围内可能比onready快
            // 这里进行检查并保证onready优先执行
            !onready.end && onready();
        
            load && load.call(img);
            
            // IE gif动画会循环执行onload，置空onload即可
            img = img.onload = img.onerror = null;
        };

        // 加入队列中定期执行
        if (!onready.end) {
            list.push(onready);
            // 无论何时只允许出现一个定时器，减少浏览器性能损耗
            if (intervalId === null) intervalId = setInterval(tick, 40);
        };
    };
})();
/**
 * jQuery plugin for posting form including file inputs.
 * 
 * Copyright (c) 2010 - 2011 Ewen Elder
 *
 * Licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * @author: Ewen Elder <ewen at jainaewen dot com> <glomainn at yahoo dot co dot uk>
 * @version: 1.1.1 (2011-07-29)
**/
(function ($)
{
	$.fn.iframePostForm = function (options)
	{
		var response,
			returnReponse,
			element,
			status = true,
			iframe;
		
		options = $.extend({}, $.fn.iframePostForm.defaults, options);
		
		
		// Add the iframe.
		if (!$('#' + options.iframeID).length)
		{
			$('body').append('<iframe id="' + options.iframeID + '" name="' + options.iframeID + '" style="display:none" />');
		}
		
		
		return $(this).each(function ()
		{
			element = $(this);
			
			
			// Target the iframe.
			element.attr('target', options.iframeID);
			
			
			// Submit listener.
			element.submit(function ()
			{
				// If status is false then abort.
				status = options.post.apply(this);
				
				if (status === false)
				{
					return status;
				}
				
				
				iframe = $('#' + options.iframeID).load(function ()
				{
					response = iframe.contents().find('body');
					
					
					if (options.json)
					{
						returnReponse = $.parseJSON(response.html());
					}
					
					else
					{
						returnReponse = response.html();
					}
					
					
					options.complete.apply(this, [returnReponse]);
					
					iframe.unbind('load');
					
					
					setTimeout(function ()
					{
						response.html('');
					}, 1);
				});
			});
		});
	};
	
	
	$.fn.iframePostForm.defaults =
	{
		iframeID : 'iframe-post-form',       // Iframe ID.
		json : false,                        // Parse server response as a json object.
		post : function () {},               // Form onsubmit.
		complete : function (response) {}    // After response from the server has been received.
	};
})(jQuery);