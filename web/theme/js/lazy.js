$.fn.fadeInWithDelay=function(){var a=0;return this.each(function(){$(this).delay(a).animate({opacity:1},250);a+=200})};var LazyLoad={invalidate:function(){$(".lazy").each(function(){var a=$(this).find("img"),b=a.attr("data-src");b&&a.attr("src",b).load(function(){$(".lazy").fadeIn().removeClass("lazy")})})}};

