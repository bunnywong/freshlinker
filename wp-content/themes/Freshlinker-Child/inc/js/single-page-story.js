// Zepto 1.1.6 (generated with Zepto Builder) - zepto event ie assets - zeptojs.com/license
var Zepto=function(){function t(t){return null==t?String(t):X[Y.call(t)]||"object"}function n(n){return"function"==t(n)}function e(t){return null!=t&&t==t.window}function r(t){return null!=t&&t.nodeType==t.DOCUMENT_NODE}function i(n){return"object"==t(n)}function o(t){return i(t)&&!e(t)&&Object.getPrototypeOf(t)==Object.prototype}function s(t){return"number"==typeof t.length}function u(t){return Z.call(t,function(t){return null!=t})}function a(t){return t.length>0?A.fn.concat.apply([],t):t}function c(t){return t.replace(/::/g,"/").replace(/([A-Z]+)([A-Z][a-z])/g,"$1_$2").replace(/([a-z\d])([A-Z])/g,"$1_$2").replace(/_/g,"-").toLowerCase()}function f(t){return t in D?D[t]:D[t]=new RegExp("(^|\\s)"+t+"(\\s|$)")}function l(t,n){return"number"!=typeof n||M[c(t)]?n:n+"px"}function h(t){var n,e;return j[t]||(n=L.createElement(t),L.body.appendChild(n),e=getComputedStyle(n,"").getPropertyValue("display"),n.parentNode.removeChild(n),"none"==e&&(e="block"),j[t]=e),j[t]}function p(t){return"children"in t?$.call(t.children):A.map(t.childNodes,function(t){return 1==t.nodeType?t:void 0})}function d(t,n){var e,r=t?t.length:0;for(e=0;r>e;e++)this[e]=t[e];this.length=r,this.selector=n||""}function m(t,n,e){for(N in n)e&&(o(n[N])||K(n[N]))?(o(n[N])&&!o(t[N])&&(t[N]={}),K(n[N])&&!K(t[N])&&(t[N]=[]),m(t[N],n[N],e)):n[N]!==x&&(t[N]=n[N])}function g(t,n){return null==n?A(t):A(t).filter(n)}function v(t,e,r,i){return n(e)?e.call(t,r,i):e}function y(t,n,e){null==e?t.removeAttribute(n):t.setAttribute(n,e)}function E(t,n){var e=t.className||"",r=e&&e.baseVal!==x;return n===x?r?e.baseVal:e:void(r?e.baseVal=n:t.className=n)}function b(t){try{return t?"true"==t||("false"==t?!1:"null"==t?null:+t+""==t?+t:/^[\[\{]/.test(t)?A.parseJSON(t):t):t}catch(n){return t}}function w(t,n){n(t);for(var e=0,r=t.childNodes.length;r>e;e++)w(t.childNodes[e],n)}var x,N,A,C,O,S,P=[],T=P.concat,Z=P.filter,$=P.slice,L=window.document,j={},D={},M={"column-count":1,columns:1,"font-weight":1,"line-height":1,opacity:1,"z-index":1,zoom:1},k=/^\s*<(\w+|!)[^>]*>/,z=/^<(\w+)\s*\/?>(?:<\/\1>|)$/,B=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,V=/^(?:body|html)$/i,_=/([A-Z])/g,I=["val","css","html","text","data","width","height","offset"],R=["after","prepend","before","append"],q=L.createElement("table"),F=L.createElement("tr"),H={tr:L.createElement("tbody"),tbody:q,thead:q,tfoot:q,td:F,th:F,"*":L.createElement("div")},J=/complete|loaded|interactive/,U=/^[\w-]*$/,X={},Y=X.toString,W={},G=L.createElement("div"),Q={tabindex:"tabIndex",readonly:"readOnly","for":"htmlFor","class":"className",maxlength:"maxLength",cellspacing:"cellSpacing",cellpadding:"cellPadding",rowspan:"rowSpan",colspan:"colSpan",usemap:"useMap",frameborder:"frameBorder",contenteditable:"contentEditable"},K=Array.isArray||function(t){return t instanceof Array};return W.matches=function(t,n){if(!n||!t||1!==t.nodeType)return!1;var e=t.webkitMatchesSelector||t.mozMatchesSelector||t.oMatchesSelector||t.matchesSelector;if(e)return e.call(t,n);var r,i=t.parentNode,o=!i;return o&&(i=G).appendChild(t),r=~W.qsa(i,n).indexOf(t),o&&G.removeChild(t),r},O=function(t){return t.replace(/-+(.)?/g,function(t,n){return n?n.toUpperCase():""})},S=function(t){return Z.call(t,function(n,e){return t.indexOf(n)==e})},W.fragment=function(t,n,e){var r,i,s;return z.test(t)&&(r=A(L.createElement(RegExp.$1))),r||(t.replace&&(t=t.replace(B,"<$1></$2>")),n===x&&(n=k.test(t)&&RegExp.$1),n in H||(n="*"),s=H[n],s.innerHTML=""+t,r=A.each($.call(s.childNodes),function(){s.removeChild(this)})),o(e)&&(i=A(r),A.each(e,function(t,n){I.indexOf(t)>-1?i[t](n):i.attr(t,n)})),r},W.Z=function(t,n){return new d(t,n)},W.isZ=function(t){return t instanceof W.Z},W.init=function(t,e){var r;if(!t)return W.Z();if("string"==typeof t)if(t=t.trim(),"<"==t[0]&&k.test(t))r=W.fragment(t,RegExp.$1,e),t=null;else{if(e!==x)return A(e).find(t);r=W.qsa(L,t)}else{if(n(t))return A(L).ready(t);if(W.isZ(t))return t;if(K(t))r=u(t);else if(i(t))r=[t],t=null;else if(k.test(t))r=W.fragment(t.trim(),RegExp.$1,e),t=null;else{if(e!==x)return A(e).find(t);r=W.qsa(L,t)}}return W.Z(r,t)},A=function(t,n){return W.init(t,n)},A.extend=function(t){var n,e=$.call(arguments,1);return"boolean"==typeof t&&(n=t,t=e.shift()),e.forEach(function(e){m(t,e,n)}),t},W.qsa=function(t,n){var e,r="#"==n[0],i=!r&&"."==n[0],o=r||i?n.slice(1):n,s=U.test(o);return t.getElementById&&s&&r?(e=t.getElementById(o))?[e]:[]:1!==t.nodeType&&9!==t.nodeType&&11!==t.nodeType?[]:$.call(s&&!r&&t.getElementsByClassName?i?t.getElementsByClassName(o):t.getElementsByTagName(n):t.querySelectorAll(n))},A.contains=L.documentElement.contains?function(t,n){return t!==n&&t.contains(n)}:function(t,n){for(;n&&(n=n.parentNode);)if(n===t)return!0;return!1},A.type=t,A.isFunction=n,A.isWindow=e,A.isArray=K,A.isPlainObject=o,A.isEmptyObject=function(t){var n;for(n in t)return!1;return!0},A.inArray=function(t,n,e){return P.indexOf.call(n,t,e)},A.camelCase=O,A.trim=function(t){return null==t?"":String.prototype.trim.call(t)},A.uuid=0,A.support={},A.expr={},A.noop=function(){},A.map=function(t,n){var e,r,i,o=[];if(s(t))for(r=0;r<t.length;r++)e=n(t[r],r),null!=e&&o.push(e);else for(i in t)e=n(t[i],i),null!=e&&o.push(e);return a(o)},A.each=function(t,n){var e,r;if(s(t)){for(e=0;e<t.length;e++)if(n.call(t[e],e,t[e])===!1)return t}else for(r in t)if(n.call(t[r],r,t[r])===!1)return t;return t},A.grep=function(t,n){return Z.call(t,n)},window.JSON&&(A.parseJSON=JSON.parse),A.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),function(t,n){X["[object "+n+"]"]=n.toLowerCase()}),A.fn={constructor:W.Z,length:0,forEach:P.forEach,reduce:P.reduce,push:P.push,sort:P.sort,splice:P.splice,indexOf:P.indexOf,concat:function(){var t,n,e=[];for(t=0;t<arguments.length;t++)n=arguments[t],e[t]=W.isZ(n)?n.toArray():n;return T.apply(W.isZ(this)?this.toArray():this,e)},map:function(t){return A(A.map(this,function(n,e){return t.call(n,e,n)}))},slice:function(){return A($.apply(this,arguments))},ready:function(t){return J.test(L.readyState)&&L.body?t(A):L.addEventListener("DOMContentLoaded",function(){t(A)},!1),this},get:function(t){return t===x?$.call(this):this[t>=0?t:t+this.length]},toArray:function(){return this.get()},size:function(){return this.length},remove:function(){return this.each(function(){null!=this.parentNode&&this.parentNode.removeChild(this)})},each:function(t){return P.every.call(this,function(n,e){return t.call(n,e,n)!==!1}),this},filter:function(t){return n(t)?this.not(this.not(t)):A(Z.call(this,function(n){return W.matches(n,t)}))},add:function(t,n){return A(S(this.concat(A(t,n))))},is:function(t){return this.length>0&&W.matches(this[0],t)},not:function(t){var e=[];if(n(t)&&t.call!==x)this.each(function(n){t.call(this,n)||e.push(this)});else{var r="string"==typeof t?this.filter(t):s(t)&&n(t.item)?$.call(t):A(t);this.forEach(function(t){r.indexOf(t)<0&&e.push(t)})}return A(e)},has:function(t){return this.filter(function(){return i(t)?A.contains(this,t):A(this).find(t).size()})},eq:function(t){return-1===t?this.slice(t):this.slice(t,+t+1)},first:function(){var t=this[0];return t&&!i(t)?t:A(t)},last:function(){var t=this[this.length-1];return t&&!i(t)?t:A(t)},find:function(t){var n,e=this;return n=t?"object"==typeof t?A(t).filter(function(){var t=this;return P.some.call(e,function(n){return A.contains(n,t)})}):1==this.length?A(W.qsa(this[0],t)):this.map(function(){return W.qsa(this,t)}):A()},closest:function(t,n){var e=this[0],i=!1;for("object"==typeof t&&(i=A(t));e&&!(i?i.indexOf(e)>=0:W.matches(e,t));)e=e!==n&&!r(e)&&e.parentNode;return A(e)},parents:function(t){for(var n=[],e=this;e.length>0;)e=A.map(e,function(t){return(t=t.parentNode)&&!r(t)&&n.indexOf(t)<0?(n.push(t),t):void 0});return g(n,t)},parent:function(t){return g(S(this.pluck("parentNode")),t)},children:function(t){return g(this.map(function(){return p(this)}),t)},contents:function(){return this.map(function(){return this.contentDocument||$.call(this.childNodes)})},siblings:function(t){return g(this.map(function(t,n){return Z.call(p(n.parentNode),function(t){return t!==n})}),t)},empty:function(){return this.each(function(){this.innerHTML=""})},pluck:function(t){return A.map(this,function(n){return n[t]})},show:function(){return this.each(function(){"none"==this.style.display&&(this.style.display=""),"none"==getComputedStyle(this,"").getPropertyValue("display")&&(this.style.display=h(this.nodeName))})},replaceWith:function(t){return this.before(t).remove()},wrap:function(t){var e=n(t);if(this[0]&&!e)var r=A(t).get(0),i=r.parentNode||this.length>1;return this.each(function(n){A(this).wrapAll(e?t.call(this,n):i?r.cloneNode(!0):r)})},wrapAll:function(t){if(this[0]){A(this[0]).before(t=A(t));for(var n;(n=t.children()).length;)t=n.first();A(t).append(this)}return this},wrapInner:function(t){var e=n(t);return this.each(function(n){var r=A(this),i=r.contents(),o=e?t.call(this,n):t;i.length?i.wrapAll(o):r.append(o)})},unwrap:function(){return this.parent().each(function(){A(this).replaceWith(A(this).children())}),this},clone:function(){return this.map(function(){return this.cloneNode(!0)})},hide:function(){return this.css("display","none")},toggle:function(t){return this.each(function(){var n=A(this);(t===x?"none"==n.css("display"):t)?n.show():n.hide()})},prev:function(t){return A(this.pluck("previousElementSibling")).filter(t||"*")},next:function(t){return A(this.pluck("nextElementSibling")).filter(t||"*")},html:function(t){return 0 in arguments?this.each(function(n){var e=this.innerHTML;A(this).empty().append(v(this,t,n,e))}):0 in this?this[0].innerHTML:null},text:function(t){return 0 in arguments?this.each(function(n){var e=v(this,t,n,this.textContent);this.textContent=null==e?"":""+e}):0 in this?this[0].textContent:null},attr:function(t,n){var e;return"string"!=typeof t||1 in arguments?this.each(function(e){if(1===this.nodeType)if(i(t))for(N in t)y(this,N,t[N]);else y(this,t,v(this,n,e,this.getAttribute(t)))}):this.length&&1===this[0].nodeType?!(e=this[0].getAttribute(t))&&t in this[0]?this[0][t]:e:x},removeAttr:function(t){return this.each(function(){1===this.nodeType&&t.split(" ").forEach(function(t){y(this,t)},this)})},prop:function(t,n){return t=Q[t]||t,1 in arguments?this.each(function(e){this[t]=v(this,n,e,this[t])}):this[0]&&this[0][t]},data:function(t,n){var e="data-"+t.replace(_,"-$1").toLowerCase(),r=1 in arguments?this.attr(e,n):this.attr(e);return null!==r?b(r):x},val:function(t){return 0 in arguments?this.each(function(n){this.value=v(this,t,n,this.value)}):this[0]&&(this[0].multiple?A(this[0]).find("option").filter(function(){return this.selected}).pluck("value"):this[0].value)},offset:function(t){if(t)return this.each(function(n){var e=A(this),r=v(this,t,n,e.offset()),i=e.offsetParent().offset(),o={top:r.top-i.top,left:r.left-i.left};"static"==e.css("position")&&(o.position="relative"),e.css(o)});if(!this.length)return null;if(!A.contains(L.documentElement,this[0]))return{top:0,left:0};var n=this[0].getBoundingClientRect();return{left:n.left+window.pageXOffset,top:n.top+window.pageYOffset,width:Math.round(n.width),height:Math.round(n.height)}},css:function(n,e){if(arguments.length<2){var r,i=this[0];if(!i)return;if(r=getComputedStyle(i,""),"string"==typeof n)return i.style[O(n)]||r.getPropertyValue(n);if(K(n)){var o={};return A.each(n,function(t,n){o[n]=i.style[O(n)]||r.getPropertyValue(n)}),o}}var s="";if("string"==t(n))e||0===e?s=c(n)+":"+l(n,e):this.each(function(){this.style.removeProperty(c(n))});else for(N in n)n[N]||0===n[N]?s+=c(N)+":"+l(N,n[N])+";":this.each(function(){this.style.removeProperty(c(N))});return this.each(function(){this.style.cssText+=";"+s})},index:function(t){return t?this.indexOf(A(t)[0]):this.parent().children().indexOf(this[0])},hasClass:function(t){return t?P.some.call(this,function(t){return this.test(E(t))},f(t)):!1},addClass:function(t){return t?this.each(function(n){if("className"in this){C=[];var e=E(this),r=v(this,t,n,e);r.split(/\s+/g).forEach(function(t){A(this).hasClass(t)||C.push(t)},this),C.length&&E(this,e+(e?" ":"")+C.join(" "))}}):this},removeClass:function(t){return this.each(function(n){if("className"in this){if(t===x)return E(this,"");C=E(this),v(this,t,n,C).split(/\s+/g).forEach(function(t){C=C.replace(f(t)," ")}),E(this,C.trim())}})},toggleClass:function(t,n){return t?this.each(function(e){var r=A(this),i=v(this,t,e,E(this));i.split(/\s+/g).forEach(function(t){(n===x?!r.hasClass(t):n)?r.addClass(t):r.removeClass(t)})}):this},scrollTop:function(t){if(this.length){var n="scrollTop"in this[0];return t===x?n?this[0].scrollTop:this[0].pageYOffset:this.each(n?function(){this.scrollTop=t}:function(){this.scrollTo(this.scrollX,t)})}},scrollLeft:function(t){if(this.length){var n="scrollLeft"in this[0];return t===x?n?this[0].scrollLeft:this[0].pageXOffset:this.each(n?function(){this.scrollLeft=t}:function(){this.scrollTo(t,this.scrollY)})}},position:function(){if(this.length){var t=this[0],n=this.offsetParent(),e=this.offset(),r=V.test(n[0].nodeName)?{top:0,left:0}:n.offset();return e.top-=parseFloat(A(t).css("margin-top"))||0,e.left-=parseFloat(A(t).css("margin-left"))||0,r.top+=parseFloat(A(n[0]).css("border-top-width"))||0,r.left+=parseFloat(A(n[0]).css("border-left-width"))||0,{top:e.top-r.top,left:e.left-r.left}}},offsetParent:function(){return this.map(function(){for(var t=this.offsetParent||L.body;t&&!V.test(t.nodeName)&&"static"==A(t).css("position");)t=t.offsetParent;return t})}},A.fn.detach=A.fn.remove,["width","height"].forEach(function(t){var n=t.replace(/./,function(t){return t[0].toUpperCase()});A.fn[t]=function(i){var o,s=this[0];return i===x?e(s)?s["inner"+n]:r(s)?s.documentElement["scroll"+n]:(o=this.offset())&&o[t]:this.each(function(n){s=A(this),s.css(t,v(this,i,n,s[t]()))})}}),R.forEach(function(n,e){var r=e%2;A.fn[n]=function(){var n,i,o=A.map(arguments,function(e){return n=t(e),"object"==n||"array"==n||null==e?e:W.fragment(e)}),s=this.length>1;return o.length<1?this:this.each(function(t,n){i=r?n:n.parentNode,n=0==e?n.nextSibling:1==e?n.firstChild:2==e?n:null;var u=A.contains(L.documentElement,i);o.forEach(function(t){if(s)t=t.cloneNode(!0);else if(!i)return A(t).remove();i.insertBefore(t,n),u&&w(t,function(t){null==t.nodeName||"SCRIPT"!==t.nodeName.toUpperCase()||t.type&&"text/javascript"!==t.type||t.src||window.eval.call(window,t.innerHTML)})})})},A.fn[r?n+"To":"insert"+(e?"Before":"After")]=function(t){return A(t)[n](this),this}}),W.Z.prototype=d.prototype=A.fn,W.uniq=S,W.deserializeValue=b,A.zepto=W,A}();window.Zepto=Zepto,void 0===window.$&&(window.$=Zepto),function(t){var n,e=[];t.fn.remove=function(){return this.each(function(){this.parentNode&&("IMG"===this.tagName&&(e.push(this),this.src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=",n&&clearTimeout(n),n=setTimeout(function(){e=[]},6e4)),this.parentNode.removeChild(this))})}}(Zepto),function(t){function n(t){return t._zid||(t._zid=h++)}function e(t,e,o,s){if(e=r(e),e.ns)var u=i(e.ns);return(g[n(t)]||[]).filter(function(t){return!(!t||e.e&&t.e!=e.e||e.ns&&!u.test(t.ns)||o&&n(t.fn)!==n(o)||s&&t.sel!=s)})}function r(t){var n=(""+t).split(".");return{e:n[0],ns:n.slice(1).sort().join(" ")}}function i(t){return new RegExp("(?:^| )"+t.replace(" "," .* ?")+"(?: |$)")}function o(t,n){return t.del&&!y&&t.e in E||!!n}function s(t){return b[t]||y&&E[t]||t}function u(e,i,u,a,f,h,p){var d=n(e),m=g[d]||(g[d]=[]);i.split(/\s/).forEach(function(n){if("ready"==n)return t(document).ready(u);var i=r(n);i.fn=u,i.sel=f,i.e in b&&(u=function(n){var e=n.relatedTarget;return!e||e!==this&&!t.contains(this,e)?i.fn.apply(this,arguments):void 0}),i.del=h;var d=h||u;i.proxy=function(t){if(t=c(t),!t.isImmediatePropagationStopped()){t.data=a;var n=d.apply(e,t._args==l?[t]:[t].concat(t._args));return n===!1&&(t.preventDefault(),t.stopPropagation()),n}},i.i=m.length,m.push(i),"addEventListener"in e&&e.addEventListener(s(i.e),i.proxy,o(i,p))})}function a(t,r,i,u,a){var c=n(t);(r||"").split(/\s/).forEach(function(n){e(t,n,i,u).forEach(function(n){delete g[c][n.i],"removeEventListener"in t&&t.removeEventListener(s(n.e),n.proxy,o(n,a))})})}function c(n,e){return(e||!n.isDefaultPrevented)&&(e||(e=n),t.each(A,function(t,r){var i=e[t];n[t]=function(){return this[r]=w,i&&i.apply(e,arguments)},n[r]=x}),(e.defaultPrevented!==l?e.defaultPrevented:"returnValue"in e?e.returnValue===!1:e.getPreventDefault&&e.getPreventDefault())&&(n.isDefaultPrevented=w)),n}function f(t){var n,e={originalEvent:t};for(n in t)N.test(n)||t[n]===l||(e[n]=t[n]);return c(e,t)}var l,h=1,p=Array.prototype.slice,d=t.isFunction,m=function(t){return"string"==typeof t},g={},v={},y="onfocusin"in window,E={focus:"focusin",blur:"focusout"},b={mouseenter:"mouseover",mouseleave:"mouseout"};v.click=v.mousedown=v.mouseup=v.mousemove="MouseEvents",t.event={add:u,remove:a},t.proxy=function(e,r){var i=2 in arguments&&p.call(arguments,2);if(d(e)){var o=function(){return e.apply(r,i?i.concat(p.call(arguments)):arguments)};return o._zid=n(e),o}if(m(r))return i?(i.unshift(e[r],e),t.proxy.apply(null,i)):t.proxy(e[r],e);throw new TypeError("expected function")},t.fn.bind=function(t,n,e){return this.on(t,n,e)},t.fn.unbind=function(t,n){return this.off(t,n)},t.fn.one=function(t,n,e,r){return this.on(t,n,e,r,1)};var w=function(){return!0},x=function(){return!1},N=/^([A-Z]|returnValue$|layer[XY]$)/,A={preventDefault:"isDefaultPrevented",stopImmediatePropagation:"isImmediatePropagationStopped",stopPropagation:"isPropagationStopped"};t.fn.delegate=function(t,n,e){return this.on(n,t,e)},t.fn.undelegate=function(t,n,e){return this.off(n,t,e)},t.fn.live=function(n,e){return t(document.body).delegate(this.selector,n,e),this},t.fn.die=function(n,e){return t(document.body).undelegate(this.selector,n,e),this},t.fn.on=function(n,e,r,i,o){var s,c,h=this;return n&&!m(n)?(t.each(n,function(t,n){h.on(t,e,r,n,o)}),h):(m(e)||d(i)||i===!1||(i=r,r=e,e=l),(i===l||r===!1)&&(i=r,r=l),i===!1&&(i=x),h.each(function(l,h){o&&(s=function(t){return a(h,t.type,i),i.apply(this,arguments)}),e&&(c=function(n){var r,o=t(n.target).closest(e,h).get(0);return o&&o!==h?(r=t.extend(f(n),{currentTarget:o,liveFired:h}),(s||i).apply(o,[r].concat(p.call(arguments,1)))):void 0}),u(h,n,i,r,e,c||s)}))},t.fn.off=function(n,e,r){var i=this;return n&&!m(n)?(t.each(n,function(t,n){i.off(t,e,n)}),i):(m(e)||d(r)||r===!1||(r=e,e=l),r===!1&&(r=x),i.each(function(){a(this,n,r,e)}))},t.fn.trigger=function(n,e){return n=m(n)||t.isPlainObject(n)?t.Event(n):c(n),n._args=e,this.each(function(){n.type in E&&"function"==typeof this[n.type]?this[n.type]():"dispatchEvent"in this?this.dispatchEvent(n):t(this).triggerHandler(n,e)})},t.fn.triggerHandler=function(n,r){var i,o;return this.each(function(s,u){i=f(m(n)?t.Event(n):n),i._args=r,i.target=u,t.each(e(u,n.type||n),function(t,n){return o=n.proxy(i),i.isImmediatePropagationStopped()?!1:void 0})}),o},"focusin focusout focus blur load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select keydown keypress keyup error".split(" ").forEach(function(n){t.fn[n]=function(t){return 0 in arguments?this.bind(n,t):this.trigger(n)}}),t.Event=function(t,n){m(t)||(n=t,t=n.type);var e=document.createEvent(v[t]||"Events"),r=!0;if(n)for(var i in n)"bubbles"==i?r=!!n[i]:e[i]=n[i];return e.initEvent(t,r,!0),c(e)}}(Zepto),function(){try{getComputedStyle(void 0)}catch(t){var n=getComputedStyle;window.getComputedStyle=function(t){try{return n(t)}catch(e){return null}}}}();

/*! smoothScroll v0.2.2 | MIT License | github.com/alicelieutier/smoothScroll */
!function(a,b){"use strict";"function"==typeof define&&define.amd?define(b):"object"==typeof exports&&"object"==typeof module?module.exports=b():a.smoothScroll=b()}(this,function(){"use strict";if("object"==typeof window&&void 0!==document.querySelectorAll&&void 0!==window.pageYOffset&&void 0!==history.pushState){for(var g,a=function(a){return"HTML"===a.nodeName?-window.pageYOffset:a.getBoundingClientRect().top+window.pageYOffset},b=function(a){return.5>a?4*a*a*a:(a-1)*(2*a-2)*(2*a-2)+1},c=function(a,c,d,e){return d>e?c:a+(c-a)*b(d/e)},d=function(b,d,e,f){d=d||1250,f=f||window;var g=window.pageYOffset;if("number"==typeof b)var h=parseInt(b);else var h=a(b);var i=Date.now(),j=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||function(a){window.setTimeout(a,15)},k=function(){var a=Date.now()-i;f!==window?f.scrollTop=c(g,h,a,d):window.scroll(0,c(g,h,a,d)),a>d?"function"==typeof e&&e(b):j(k)};k()},e=function(a){a.preventDefault(),d(document.getElementById(this.hash.substring(1)),1250)},f=document.querySelectorAll('#js-nav a[href^="#"]'),h=f.length;g=f[--h];)g.addEventListener("click",e,!1);return d}});

/*! Font Face Observer v1.5.4 | BSD License | github.com/bramstein/fontfaceobserver */
!function(){"use strict";function b(b){a.push(b),1===a.length&&e()}function c(){for(;a.length;)a[0](),a.shift()}function f(a){this.a=g,this.b=void 0,this.f=[];var b=this;try{a(function(a){j(b,a)},function(a){k(b,a)})}catch(c){k(b,c)}}function h(a){return new f(function(b,c){c(a)})}function i(a){return new f(function(b){b(a)})}function j(a,b){if(a.a===g){if(b===a)throw new TypeError("Promise settled with itself.");var c=!1;try{var d=b&&b.then;if(null!==b&&"object"==typeof b&&"function"==typeof d)return void d.call(b,function(b){c||j(a,b),c=!0},function(b){c||k(a,b),c=!0})}catch(e){return void(c||k(a,e))}a.a=0,a.b=b,l(a)}}function k(a,b){if(a.a===g){if(b===a)throw new TypeError("Promise settled with itself.");a.a=1,a.b=b,l(a)}}function l(a){b(function(){if(a.a!==g)for(;a.f.length;){var b=a.f.shift(),c=b[0],d=b[1],e=b[2],b=b[3];try{0===a.a?e("function"==typeof c?c.call(void 0,a.b):a.b):1===a.a&&("function"==typeof d?e(d.call(void 0,a.b)):b(a.b))}catch(f){b(f)}}})}function m(a){return new f(function(b,c){function d(c){return function(d){f[c]=d,e+=1,e===a.length&&b(f)}}var e=0,f=[];0===a.length&&b(f);for(var g=0;g<a.length;g+=1)i(a[g]).c(d(g),c)})}function n(a){return new f(function(b,c){for(var d=0;d<a.length;d+=1)i(a[d]).c(b,c)})}var a=[];if(window.MutationObserver){var d=document.createElement("div");new MutationObserver(c).observe(d,{attributes:!0});var e=function(){d.setAttribute("x",0)}}else e=function(){setTimeout(c)};var g=2;f.prototype.g=function(a){return this.c(void 0,a)},f.prototype.c=function(a,b){var c=this;return new f(function(d,e){c.f.push([a,b,d,e]),l(c)})},window.Promise||(window.Promise=f,window.Promise.resolve=i,window.Promise.reject=h,window.Promise.race=n,window.Promise.all=m,window.Promise.prototype.then=f.prototype.c,window.Promise.prototype["catch"]=f.prototype.g)}(),function(){"use strict";function a(a){document.body?a():document.addEventListener("DOMContentLoaded",a)}function b(a){this.a=document.createElement("div"),this.a.setAttribute("aria-hidden","true"),this.a.appendChild(document.createTextNode(a)),this.b=document.createElement("span"),this.c=document.createElement("span"),this.h=document.createElement("span"),this.g=document.createElement("span"),this.f=-1,this.b.style.cssText="display:inline-block;position:absolute;height:100%;width:100%;overflow:scroll;font-size:16px;",this.c.style.cssText="display:inline-block;position:absolute;height:100%;width:100%;overflow:scroll;font-size:16px;",this.g.style.cssText="display:inline-block;position:absolute;height:100%;width:100%;overflow:scroll;font-size:16px;",this.h.style.cssText="display:inline-block;width:200%;height:200%;font-size:16px;",this.b.appendChild(this.h),this.c.appendChild(this.g),this.a.appendChild(this.b),this.a.appendChild(this.c)}function c(a,b,c){a.a.style.cssText="min-width:20px;min-height:20px;display:inline-block;overflow:hidden;position:absolute;width:auto;margin:0;padding:0;top:-999px;left:-999px;white-space:nowrap;font-size:100px;font-family:"+b+";"+c}function d(a){var b=a.a.offsetWidth,c=b+100;return a.g.style.width=c+"px",a.c.scrollLeft=c,a.b.scrollLeft=a.b.scrollWidth+100,a.f!==b?(a.f=b,!0):!1}function e(a,b){a.b.addEventListener("scroll",function(){d(a)&&null!==a.a.parentNode&&b(a.f)},!1),a.c.addEventListener("scroll",function(){d(a)&&null!==a.a.parentNode&&b(a.f)},!1),d(a)}function f(a,b){var c=b||{};this.family=a,this.style=c.style||"normal",this.variant=c.variant||"normal",this.weight=c.weight||"normal",this.stretch=c.stretch||"normal",this.featureSettings=c.featureSettings||"normal"}var g=null;f.prototype.a=function(d,f){var h=d||"BESbswy",i=f||3e3,j="font-style:"+this.style+";font-variant:"+this.variant+";font-weight:"+this.weight+";font-stretch:"+this.stretch+";font-feature-settings:"+this.featureSettings+";-moz-font-feature-settings:"+this.featureSettings+";-webkit-font-feature-settings:"+this.featureSettings+";",k=document.createElement("div"),l=new b(h),m=new b(h),n=new b(h),o=-1,p=-1,q=-1,r=-1,s=-1,t=-1,u=this;return new Promise(function(b,d){function f(){null!==k.parentNode&&k.parentNode.removeChild(k)}function h(){if((-1!==o&&-1!==p||-1!==o&&-1!==q||-1!==p&&-1!==q)&&(o===p||o===q||p===q)){if(null===g){var a=/AppleWebKit\/([0-9]+)(?:\.([0-9]+))/.exec(window.navigator.userAgent);g=!!a&&(536>parseInt(a[1],10)||536===parseInt(a[1],10)&&11>=parseInt(a[2],10))}g?o===r&&p===r&&q===r||o===s&&p===s&&q===s||o===t&&p===t&&q===t||(f(),b(u)):(f(),b(u))}}a(function(){function a(){if(Date.now()-b>=i)f(),d(u);else{var c=document.hidden;(!0===c||void 0===c)&&(o=l.a.offsetWidth,p=m.a.offsetWidth,q=n.a.offsetWidth,h()),setTimeout(a,50)}}var b=Date.now();c(l,"sans-serif",j),c(m,"serif",j),c(n,"monospace",j),k.appendChild(l.a),k.appendChild(m.a),k.appendChild(n.a),document.body.appendChild(k),r=l.a.offsetWidth,s=m.a.offsetWidth,t=n.a.offsetWidth,a(),e(l,function(a){o=a,h()}),c(l,'"'+u.family+'",sans-serif',j),e(m,function(a){p=a,h()}),c(m,'"'+u.family+'",serif',j),e(n,function(a){q=a,h()}),c(n,'"'+u.family+'",monospace',j)})})},window.FontFaceObserver=f,window.FontFaceObserver.prototype.check=f.prototype.a}();

/*! scrollReveal.js v2.3.2 | MIT License | scrollrevealjs.org */
!function(e,t){"function"==typeof define&&define.amd?define(t):"object"==typeof exports?module.exports=t(require,exports,module):e.scrollReveal=t()}(this,function(){return window.scrollReveal=function(e){"use strict";function t(i){return this instanceof t?(r=this,r.elems={},r.serial=1,r.blocked=!1,r.config=o(r.defaults,i),r.isMobile()&&!r.config.mobile||!r.isSupported()?void r.destroy():(r.config.viewport===e.document.documentElement?(e.addEventListener("scroll",a,!1),e.addEventListener("resize",a,!1)):r.config.viewport.addEventListener("scroll",a,!1),void r.init(!0))):new t(i)}var i,o,a,r;return t.prototype={defaults:{enter:"bottom",move:"8px",over:"0.6s",wait:"0s",easing:"ease",scale:{direction:"up",power:"5%"},rotate:{x:0,y:0,z:0},opacity:0,mobile:!1,reset:!1,viewport:e.document.documentElement,delay:"once",vFactor:.6,complete:function(){}},init:function(e){var t,i,o;o=Array.prototype.slice.call(r.config.viewport.querySelectorAll("[data-sr]")),o.forEach(function(e){t=r.serial++,i=r.elems[t]={domEl:e},i.config=r.configFactory(i),i.styles=r.styleFactory(i),i.seen=!1,e.removeAttribute("data-sr"),e.setAttribute("style",i.styles.inline+i.styles.initial)}),r.scrolled=r.scrollY(),r.animate(e)},animate:function(e){function t(e){var t=r.elems[e];setTimeout(function(){t.domEl.setAttribute("style",t.styles.inline),t.config.complete(t.domEl),delete r.elems[e]},t.styles.duration)}var i,o,a;for(i in r.elems)r.elems.hasOwnProperty(i)&&(o=r.elems[i],a=r.isElemInViewport(o),a?("always"===r.config.delay||"onload"===r.config.delay&&e||"once"===r.config.delay&&!o.seen?o.domEl.setAttribute("style",o.styles.inline+o.styles.target+o.styles.transition):o.domEl.setAttribute("style",o.styles.inline+o.styles.target+o.styles.reset),o.seen=!0,o.config.reset||o.animating||(o.animating=!0,t(i))):!a&&o.config.reset&&o.domEl.setAttribute("style",o.styles.inline+o.styles.initial+o.styles.reset));r.blocked=!1},configFactory:function(e){var t={},i={},a=e.domEl.getAttribute("data-sr").split(/[, ]+/);return a.forEach(function(e,i){switch(e){case"enter":t.enter=a[i+1];break;case"wait":t.wait=a[i+1];break;case"move":t.move=a[i+1];break;case"ease":t.move=a[i+1],t.ease="ease";break;case"ease-in":if("up"==a[i+1]||"down"==a[i+1]){t.scale.direction=a[i+1],t.scale.power=a[i+2],t.easing="ease-in";break}t.move=a[i+1],t.easing="ease-in";break;case"ease-in-out":if("up"==a[i+1]||"down"==a[i+1]){t.scale.direction=a[i+1],t.scale.power=a[i+2],t.easing="ease-in-out";break}t.move=a[i+1],t.easing="ease-in-out";break;case"ease-out":if("up"==a[i+1]||"down"==a[i+1]){t.scale.direction=a[i+1],t.scale.power=a[i+2],t.easing="ease-out";break}t.move=a[i+1],t.easing="ease-out";break;case"hustle":if("up"==a[i+1]||"down"==a[i+1]){t.scale.direction=a[i+1],t.scale.power=a[i+2],t.easing="cubic-bezier( 0.6, 0.2, 0.1, 1 )";break}t.move=a[i+1],t.easing="cubic-bezier( 0.6, 0.2, 0.1, 1 )";break;case"over":t.over=a[i+1];break;case"flip":case"pitch":t.rotate=t.rotate||{},t.rotate.x=a[i+1];break;case"spin":case"yaw":t.rotate=t.rotate||{},t.rotate.y=a[i+1];break;case"roll":t.rotate=t.rotate||{},t.rotate.z=a[i+1];break;case"reset":t.reset="no"==a[i-1]?!1:!0;break;case"scale":if(t.scale={},"up"==a[i+1]||"down"==a[i+1]){t.scale.direction=a[i+1],t.scale.power=a[i+2];break}t.scale.power=a[i+1];break;case"vFactor":case"vF":t.vFactor=a[i+1];break;case"opacity":t.opacity=a[i+1];break;default:return}}),i=o(i,r.config),i=o(i,t),"top"===i.enter||"bottom"===i.enter?i.axis="Y":("left"===i.enter||"right"===i.enter)&&(i.axis="X"),("top"===i.enter||"left"===i.enter)&&(i.move="-"+i.move),i},styleFactory:function(e){function t(){0!==parseInt(s.move)&&(o+=" translate"+s.axis+"("+s.move+")",r+=" translate"+s.axis+"(0)"),0!==parseInt(s.scale.power)&&("up"===s.scale.direction?s.scale.value=1-.01*parseFloat(s.scale.power):"down"===s.scale.direction&&(s.scale.value=1+.01*parseFloat(s.scale.power)),o+=" scale("+s.scale.value+")",r+=" scale(1)"),s.rotate.x&&(o+=" rotateX("+s.rotate.x+")",r+=" rotateX(0)"),s.rotate.y&&(o+=" rotateY("+s.rotate.y+")",r+=" rotateY(0)"),s.rotate.z&&(o+=" rotateZ("+s.rotate.z+")",r+=" rotateZ(0)"),o+="; opacity: "+s.opacity+"; ",r+="; opacity: 1; "}var i,o,a,r,n,s=e.config,c=1e3*(parseFloat(s.over)+parseFloat(s.wait));return i=e.domEl.getAttribute("style")?e.domEl.getAttribute("style")+"; visibility: visible; ":"visibility: visible; ",n="-webkit-transition: -webkit-transform "+s.over+" "+s.easing+" "+s.wait+", opacity "+s.over+" "+s.easing+" "+s.wait+"; transition: transform "+s.over+" "+s.easing+" "+s.wait+", opacity "+s.over+" "+s.easing+" "+s.wait+"; -webkit-perspective: 1000;-webkit-backface-visibility: hidden;",a="-webkit-transition: -webkit-transform "+s.over+" "+s.easing+" 0s, opacity "+s.over+" "+s.easing+" 0s; transition: transform "+s.over+" "+s.easing+" 0s, opacity "+s.over+" "+s.easing+" 0s; -webkit-perspective: 1000; -webkit-backface-visibility: hidden; ",o="transform:",r="transform:",t(),o+="-webkit-transform:",r+="-webkit-transform:",t(),{transition:n,initial:o,target:r,reset:a,inline:i,duration:c}},getViewportH:function(){var t=r.config.viewport.clientHeight,i=e.innerHeight;return r.config.viewport===e.document.documentElement&&i>t?i:t},scrollY:function(){return r.config.viewport===e.document.documentElement?e.pageYOffset:r.config.viewport.scrollTop+r.config.viewport.offsetTop},getOffset:function(e){var t=0,i=0;do isNaN(e.offsetTop)||(t+=e.offsetTop),isNaN(e.offsetLeft)||(i+=e.offsetLeft);while(e=e.offsetParent);return{top:t,left:i}},isElemInViewport:function(t){function i(){var e=n+a*c,t=s-a*c,i=r.scrolled+r.getViewportH(),o=r.scrolled;return i>e&&t>o}function o(){var i=t.domEl,o=i.currentStyle||e.getComputedStyle(i,null);return"fixed"===o.position}var a=t.domEl.offsetHeight,n=r.getOffset(t.domEl).top,s=n+a,c=t.config.vFactor||0;return i()||o()},isMobile:function(){var t=navigator.userAgent||navigator.vendor||e.opera;return/(ipad|playbook|silk|android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(t)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(t.substr(0,4))?!0:!1},isSupported:function(){for(var e=document.createElement("sensor"),t="Webkit,Moz,O,".split(","),i=("transition "+t.join("transition,")).split(","),o=0;o<i.length;o++)if(""===!e.style[i[o]])return!1;return!0},destroy:function(){var e=r.config.viewport,t=Array.prototype.slice.call(e.querySelectorAll("[data-sr]"));t.forEach(function(e){e.removeAttribute("data-sr")})}},a=function(){r.blocked||(r.blocked=!0,r.scrolled=r.scrollY(),i(function(){r.animate()}))},o=function(e,t){for(var i in t)t.hasOwnProperty(i)&&(e[i]=t[i]);return e},i=function(){return e.requestAnimationFrame||e.webkitRequestAnimationFrame||e.mozRequestAnimationFrame||function(t){e.setTimeout(t,1e3/60)}}(),t}(window),scrollReveal});


/* browser feature detection */
var browserHas = [];
// pushState
browserHas.pushstate = (history.pushState) ? true : false;

/* detect touch event */
document.documentElement.classList.add(("ontouchstart" in window) ? "is-touch" : "no-touch");

/* detect Mac OS */
navigator.platform.toUpperCase().indexOf("MAC") >= 0 && document.documentElement.classList.add("is-mac");

/* document ready */
Zepto(function($){

  /* prevent/allow body scrolling */
  var scroll_position = 0,
    classname_noscroll = "js-noscroll",
    el_window = $(window),
    el_body = $("body");
  function prevent_body_scroll() {
    scroll_position = el_window.scrollTop();
    el_body.addClass(classname_noscroll);
  }
  function allow_body_scroll() {
    el_body.removeClass(classname_noscroll);
    el_window.scrollTop(scroll_position);
  }

  /* lightbox */
  var is_lightbox_opened = false,
    classname_lightbox_opened = "lightbox-active",
    classname_scroll_icon_visible = "visible",
    page_title = document.title,
    timeout_lightbox_opened,
    timeout_scroll_icon,
    timeout_lightbox_closed,
    el_main =                $("#js-main"),
    el_lightbox =            $("#js-lightbox"),
    el_lightbox_close =      $("#js-lightbox-close"),
    el_project_header =      $("#js-project-header"),
    el_project_title =       $("#js-project-title"),
    el_project_type =        $("#js-project-type"),
    el_project_description = $("#js-project-description"),
    el_project_details =     $("#js-project-details"),
    el_scroll_icon =         $("#js-scroll-icon"),
    el_project_images =      $("#js-project-images"),
    el_project_link =        $("#js-project-link"),
    el_project_link_button = $("#js-project-link-button");

  // open lightbox
  function lightbox_open(project_id) {

    clearTimeout(timeout_lightbox_closed);

    is_lightbox_opened = true;

    var project_data = $(".js-project-id." + project_id).data("project");

    lightbox_first_fill(project_id, project_data);

    el_lightbox_close.show();
    el_lightbox.show();
    el_main.addClass(classname_lightbox_opened);

    setTimeout(function(){
      el_lightbox_close.addClass(classname_lightbox_opened);
      el_lightbox.addClass(classname_lightbox_opened);
    }, 20);

    timeout_lightbox_opened = setTimeout(function(){
      prevent_body_scroll();
      lightbox_second_fill(project_id, project_data);
      $(document).on({
        "keyup":   function(e){ if (e.keyCode == 27) location.hash = "/"; },
        "mouseup": function(e){ if (!$(e.target).closest(el_lightbox).length) location.hash = "/"; }
      });
    }, 270);

    timeout_scroll_icon = setTimeout(function(){
      is_lightbox_opened && !el_lightbox.scrollTop() &&
        el_scroll_icon.addClass(classname_scroll_icon_visible) &&
        el_lightbox.one("scroll", function(){
          el_scroll_icon.removeClass(classname_scroll_icon_visible);
        });
    }, 1000);
  }

  // fill lightbox header with project information
  function lightbox_first_fill(project_id, project_data) {
    el_project_header.attr("class", project_id);
    el_project_title.html(project_data.name);
    el_project_type.html(project_data.type);
    el_project_description.html(project_data.description);
    el_project_details.html(project_data.details);
  }

  // fill lightbox with showcase images and external link
  function lightbox_second_fill(project_id, project_data) {

    document.title = project_data.name + " | " + page_title;

    var showcase_html = "",
      showcase_data = project_data.showcase;

    for (var i=0; i<showcase_data.length; i++) {
      var ext = showcase_data[i].ext,
        path = "img/work/" + project_id + "/" + (i+1);
      showcase_html += '<img alt="" class="showcase-' + showcase_data[i].size + '" src="' + path;
      showcase_html += (showcase_data[i].size == "half") ?
        '-800.' + ext + '" srcset="' + path + '-800.' + ext + ' 800w, ' + path + '-1600.' + ext + ' 1600w" sizes="(min-width: 50em) 50em, 100vw">' :
        '-1600.' + ext + '" srcset="' + path + '-800.' + ext + ' 800w, ' + path + '-1600.' + ext + ' 1600w, ' + path + '-3200.' + ext + ' 3200w" sizes="(min-width: 50em) 100em, 100vw">';
    }

    is_lightbox_opened && el_project_images.html(showcase_html);
    showcase_html = null;

    if (project_data.link) {
      el_project_link_button.html(project_data.link.text).attr("href", project_data.link.url);
      el_project_link.show();
    }

  }

  // close lightbox
  function lightbox_close() {

    clearTimeout(timeout_lightbox_opened);
    clearTimeout(timeout_scroll_icon);

    is_lightbox_opened = false;

    allow_body_scroll();
    $(document).off("keyup mouseup");
    browserHas.pushstate && history.replaceState(null, null, "./");

    el_lightbox_close.removeClass(classname_lightbox_opened);
    el_lightbox.removeClass(classname_lightbox_opened);
    el_main.removeClass(classname_lightbox_opened);

    timeout_lightbox_closed = setTimeout(function(){
      document.title = page_title;
      el_lightbox.scrollTop(0).hide();
      el_lightbox_close.hide();
      el_project_link.hide();
      el_scroll_icon.removeClass(classname_scroll_icon_visible);
      el_project_images.empty();
    }, 250);
  }

  /* open/close lightbox on hashchange */
  $(window).on("hashchange", function(){
    var currentHash = location.hash.substring(2),
      project_id = currentHash.substring(currentHash.lastIndexOf("/") + 1, currentHash.length);

    (currentHash && $(".js-project-id." + project_id).length) ? lightbox_open(project_id) : is_lightbox_opened && lightbox_close();
  }).trigger("hashchange");


  // Link up Title
  $('h2.main-sub-title').on('click', function() {
    $('#js-nav ul > li:last-child a').trigger('click');
  });

  // Set language (dirty script: Porpose for Chinese in English Page)
  if ($('#js-nav > ul > li:nth-child(1) > a').text().match(/[a-z]/i)) {
    var currentLang = 'en';
  }
  else {
    // Not english.
    var currentLang = 'zh-hant';
  }
  // Translate for tranditation Chinese
  if (currentLang === 'zh-hant') {
    // Overwrite lang selector
    $('.js-lang').attr('href', '/lead-eng').text('English');
    // Translate sub title
    $('h1 span').text('5 日高強度職場訓練計劃');

    // Translate last menu
    $('h2.main-sub-title').text('春季計劃火熱報名中 !');

    // Ninja Form
    $('.ninja-forms-all-fields-wrap').addClass('zh');
    $(".js-connect h1").text('報名');
    $selector = $(".js-connect .ninja-forms-all-fields-wrap > .field-wrap");
      $selector.eq(0).children('label').text('名字');
      $selector.eq(1).children('label').text('電話');
      $selector.eq(2).children('label').text('電郵');
      $selector.eq(3).children('div').children('input').val('寄出');

    if ($.trim($(".js-connect #ninja_forms_form_1_response_msg").text()) == 'Your form has been successfully submitted.') {
      $(".js-connect #ninja_forms_form_1_response_msg").text('(你的註冊表格已經成功寄出)');
    }
  }
  else {
    $('.js-lang').attr('href', '/lead').text('正體中文');
    // For style use
    $('.ninja-forms-all-fields-wrap').addClass('en');
  }

  // Scroll to contact form
  $(".js-connect #ninja_forms_field_5").click(function() {
    localStorage.setItem('first_submition','1');
  });
  if (localStorage.getItem('first_submition') === '1') {
    setTimeout(function() {
      $("body").scrollTop($(document).height())
    }, 1000);
    localStorage.clear();
  }

  /* init scrollReveal.js if window is scrolled to top and font is loaded */
  if (!is_lightbox_opened && $(window).scrollTop() < 160 && scrollReveal.prototype.isSupported() && !scrollReveal.prototype.isMobile()) {
    var clavo_i = new FontFaceObserver("Clavo", {
      style: "italic",
      weight: "normal"
    });
    var clavo_bi = new FontFaceObserver("Clavo", {
      style: "italic",
      weight: "bold"
    });
    Promise.all([
      clavo_i.check(),
      clavo_bi.check()
    ]).then(function(){
      window.sr = new scrollReveal({
        move:    0,
        over:    ".75s",
        vFactor: 0
      });
    });
  }
  else {
    $("[data-sr]").css("visibility", "visible");
  }
});
