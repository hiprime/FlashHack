!function(t){"use strict";t.fn.sectionScroll=function(s){var i,e=this,o=t(window),n=1,l=t.extend({bulletsClass:"section-bullets",sectionsClass:"scrollable-section",scrollDuration:1e3,titles:!0,topOffset:0,easing:"",id:"",position:"left"},s),a=l.id+"-navi",c="",r=t("#"+l.id).find("."+l.sectionsClass);t("."+l.sectionsClass);"left"==l.position||"right"==l.position?c="ctl-bullets-container":"bottom"==l.position&&(c="ctl-footer-bullets-container");var f=t('<div id="'+a+'" class="'+c+'"><ul class="'+l.bulletsClass+'"></ul></div>').prependTo(e).find("ul"),d="";r.each(function(){var s=t(this),i=s.data("section-title")||"",e="";s.attr("id","scrollto-section-"+a+n),e=s.data("cls");var o=l.titles?"<span>"+i+"</span>":"";d+='<li class="year-'+i+" "+e+' "><a title="'+i+'" href="#scrollto-section-'+a+n+'">'+o+"</a></li>",n++});var u=t(d).appendTo(f),p=u.map(function(){var s=t(t(this).find("a").attr("href"));if(s[0])return s});return u.on("click",function(s){var i=t(this).find("a").attr("href"),o="#"===i?0:t(i).offset().top;t("html, body").stop().animate({scrollTop:o-l.topOffset},l.scrollDuration,l.easing,function(){e.trigger("scrolled-to-section").stop()}),s.preventDefault()}),o.on("scroll",function(){var s=o.scrollTop()+o.height()/2.5,n=p.map(function(){if(t(this).offset().top<s)return this}),l=(n=n.length>0?n[n.length-1]:[])[0]?n[0].id:"";i!==l&&(r.removeClass("active-section"),t(n).addClass("active-section"),u.removeClass("active").find('a[href="#'+l+'"]').parent().addClass("active"),i=l,t.fn.sectionScroll.activeSection=n,e.trigger("section-reached"))}),t(function(){o.scroll()}),e}}(jQuery);