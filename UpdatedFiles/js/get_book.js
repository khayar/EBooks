
///////////////////////////////////////////////////////
//////The following function is for popup div//////////
var POPUP = {
    getH:function(){
        if (window.innerHeight && window.scrollMaxY) {
            yScroll = window.innerHeight + window.scrollMaxY;
        } else if (document.body.scrollHeight > document.body.offsetHeight){
            yScroll = document.body.scrollHeight;
        } else {yScroll = document.body.offsetHeight;}
        return yScroll;       
    },
    pw:function(el){
        if(!document.getElementById(el)){return false;}
        if(!document.createElement){return false;}
        POPUP.cpw(el);
        if(POPUP.hasSlt()){POPUP.cifr();}
    },
    cpw:function(el){
        el= document.getElementById(el);       
        el.className = "popupdiv";
        el.style.marginLeft = "-" + el.clientWidth/2 + "px";
        pwb = document.createElement('div');
        pwb.setAttribute('id','popupbg');
        ph =el.clientHeight;
        sh = (window.innerHeight) ? window.innerHeight : (document.documentElement && document.documentElement.clientHeight) ? document.documentElement.clientHeight : document.body.offsetHeight;
        bh = POPUP.getH();
        if(ph>bh){
            el.style.marginTop = "-180px";
            pwb.style.height = ph+180+"px";
        }else{
            if(ph>sh){
                pwb.style.height = bh>ph?bh+'px':ph+'px';
                el.style.marginTop = '-180px';
            }else{       
                el.style.marginTop = "-" + ph/2 + 'px';
                pwb.style.height = sh>bh?sh+'px':bh+'px';
            }   
        }
        return document.body.appendChild(pwb);
    },
    cifr:function(){
        if(!document.createElement("iframe")){return false;};
        ifr = document.createElement("iframe");
        ifr.setAttribute("id","divshim");
        ifr.setAttribute("src","javascript:void(0);");
        ifr.setAttribute("scrolling","no");
        ifr.setAttribute("frameborder","0");
        ifr.setAttribute("allowtransparency","true");
        POPUP.insertAfter(ifr,pwb);
        ifr.className = "popupifra";
        ifr.style.height = pwb.style.height;
        ifr.style.width = pwb.style.width;       
    },
    insertAfter:function(nEl,tEl) {
      var p = tEl.parentNode;if (p.lastChild == tEl) {p.appendChild(nEl);
      } else {p.insertBefore(nEl,tEl.nextSibling); }
    },
    hasSlt:function(){
        var a = document.getElementsByTagName('*');
        var hasSlt = false;
        for(var i=a.length-1;i>=0;i--){
            if(a[i].nodeName == 'SELECT'){hasSlt = true;break;}
        }
        return hasSlt;
    },
    attr:function(el,name,value){
        if(!name || name.constructor != String){return '';}
        name = {'for':'htmlFor','class':'className'}[name] || name;
        if(typeof value != 'undefined'){
            el[name] = value;
            if(el.setAttribute){el.setAttribute(name,value);}
            return el[name] || el.getAttribute(name) || '';
        }
    },
    cw:function(el){
    pwb.className = "hidden";
    document.getElementById(el).className = "hidden";   
    if(POPUP.hasSlt()){ifr.className="hidden"}
    }
}

function addLoadEvent(func){var oldonload = window.onload;if(typeof window.onload != 'function'){window.onload = func;}else{window.onload = function(){oldonload();func();}}}

addLoadEvent(POPUP.getH);




///////////////////////////////////////////////////////////////////////////////
//The following functions is for gathering data from XML files by using AJAX///
window["MzBrowser"]={};(function()
{
	if(MzBrowser.platform) return;
	var ua = window.navigator.userAgent;
	MzBrowser.platform = window.navigator.platform;
	
	MzBrowser.firefox = ua.indexOf("Firefox")>0;
	MzBrowser.opera = typeof(window.opera)=="object";
	MzBrowser.ie = !MzBrowser.opera && ua.indexOf("MSIE")>0;
	MzBrowser.mozilla = window.navigator.product == "Gecko";
	MzBrowser.netscape= window.navigator.vendor=="Netscape";
	MzBrowser.safari= ua.indexOf("Safari")>-1;
	
	if(MzBrowser.firefox) var re = /Firefox(\s|\/)(\d+(\.\d+)?)/;
	else if(MzBrowser.ie) var re = /MSIE( )(\d+(\.\d+)?)/;
	else if(MzBrowser.opera) var re = /Opera(\s|\/)(\d+(\.\d+)?)/;
	else if(MzBrowser.netscape) var re = /Netscape(\s|\/)(\d+(\.\d+)?)/;
	else if(MzBrowser.safari) var re = /Version(\/)(\d+(\.\d+)?)/;
	else if(MzBrowser.mozilla) var re = /rv(\:)(\d+(\.\d+)?)/;
	
	if("undefined"!=typeof(re)&&re.test(ua))
	MzBrowser.version = parseFloat(RegExp.$2);
})();

var per_page = 3;
var asyncRequest;
var result;
var page_length;
var book_img_root = "images/books/";

function getBooks(catalog) {

	try {
		if(MzBrowser.firefox) {
			//alert("firefox");
			 asyncRequest = document.implementation.createDocument("","",null);
			 asyncRequest.async=false;
			 asyncRequest.load("booklist.xml");
			 result = asyncRequest;
			 //asyncRequest.open( 'GET', 'booklist.xml', true );
			 //asyncRequest.send(null);
			 //var parser = new DOMParser();
			 //result = parser.parseFromString(asyncRequest.responseText, "text/xml");
			 show(catalog); 
		} else if(MzBrowser.ie) {
			//alert("ie");
			 asyncRequest = new ActiveXObject("Microsoft.XMLHTTP");
			 asyncRequest.open( 'GET', 'booklist.xml', true ); 
			asyncRequest.onreadystatechange = function() {
				if(asyncRequest.readyState == 4 && asyncRequest.status == 200 && asyncRequest.responseXML) {
					result = asyncRequest.responseXML;
					show(catalog); 
				}
			}
			asyncRequest.send(null);
		} else {
			asyncRequest = new XMLHttpRequest();
			 asyncRequest.open( 'GET', 'booklist.xml', true ); 
			asyncRequest.onreadystatechange = function() {
				if(asyncRequest.readyState == 4 && asyncRequest.status == 200 && asyncRequest.responseXML) {
					result = asyncRequest.responseXML;
					show(catalog); 
				}
			}
			asyncRequest.send(null);
		}

	} // end try
	catch (e) {
		alert("Error -> " + e.message);
	} // end catch
}

function show(catalog) {
	showBooks(catalog, 0, per_page - 1);
}


function showBooks(catalog, start, end) {
	var a = start;
	var b = end;
	var tags = '<table width="560">';
	var tables = "";
	var title,author,year,price,isbn,publisher,image,description;
		
	// get the catalogs from the responseXML
	var catalogs = result.getElementsByTagName("catalog");
	var books;
	for(var i = 0; i < catalogs.length; i++) {
		if(catalogs.item(i).getAttribute("name") == catalog) {
			books = catalogs.item(i).getElementsByTagName("book");
			break;
		}
	}
	
	var previous,next;
	
	if(start == 0)
		previous = '\<';
	else
		previous = '<a href="#" onclick="showBooks(\'' + catalog + '\',' + (start - per_page) + ',' + (end - per_page) + ')">\<</a>';
		
	if(end >= books.length - 1)
		next = '\>';
	else
		next = '<a href="#" onclick="showBooks(\'' + catalog + '\',' + (start + per_page) + ',' + (end + per_page) + ')">\></a>';
	
	//alert(books.length);
	if(end >= books.length - 1)
	    end = books.length - 1;


	for(var j = start; j < end + 1; j++) {
		title = books.item(j).getElementsByTagName("title").item(0).firstChild.nodeValue;
		author = books.item(j).getElementsByTagName("author").item(0).firstChild.nodeValue;
		year = books.item(j).getElementsByTagName("year").item(0).firstChild.nodeValue;
		price = books.item(j).getElementsByTagName("price").item(0).firstChild.nodeValue;
		isbn = books.item(j).getElementsByTagName("isbn").item(0).firstChild.nodeValue;
		publisher = books.item(j).getElementsByTagName("publisher").item(0).firstChild.nodeValue;
		image = books.item(j).getElementsByTagName("image").item(0).firstChild.nodeValue;
		description = books.item(j).getElementsByTagName("description").item(0).firstChild.nodeValue;

		tables += '<div id="' + j + '" style="BORDER-RIGHT: 3px double #000000; BORDER-TOP: 3px double #000000; BACKGROUND: #ffffff; BORDER-LEFT: 3px double #000000; BORDER-BOTTOM: 3px double #000000" class="hidden"><table width="800" bgcolor="#FFFFFF" border="0"><tr><td colspan="2" align="right"><a href="#" onclick="POPUP.cw(\'' + j + '\')"><span style="font-size:18px">Close</span></a><br /><hr /></td></tr><tr><td aligh="center"><img src="' + book_img_root + image + '" alt="" /></td><td aligh="center"><span class="description">' + description + '</span></td></tr><tr><td colspan="2"><hr /></td></tr></table></div>';

		tags += '<tr>' +
			'<td><div align="left"><img width="79" height="120" style="float:left;padding-right:10px" src="' + book_img_root + image + '" alt="" /><a href="#" onclick="POPUP.pw(\'' + j + '\');"><span class="title"><strong>' + title + '</strong></span></a><br /><span class="author">By ' + author + '</span><br /><br />Publisher: <span class="publisher">' + publisher + '</span><br />Year: <span class="year">' + year + '</span><br />Price: <span class="price_list"><strong>' + price + '</strong></span><br /><a href="#" onclick="add_to_cart(\'' + isbn + '\')"><img src="images/cart.gif" alt="" /></a></div></td></tr>' +
            '<tr><td><hr /><br /></td></tr>';
		
	}

	
	var page = "";
	var current_page;
	//get page's length
	var mod = books.length % per_page;
	//alert(mod);
	if(books.length < per_page)
		page_length = Math.ceil(books.length / per_page);
	else
		page_length = Math.floor(books.length / per_page);
	if(mod != 0 && mod < books.length)
		page_length += 1;
	var page_list = new Array(page_length);

	for(var l = 0; l < page_length; l++) {
		var s,n;
		s = per_page * l;
		n = s + per_page - 1;
		if(n < 0)
			n = 0;

		page_list[l] = s + "," + n;
		if(s == a && n == b)
			current_page = l;
		//alert(s + "," + n);
	}
	
	
	
	for(var k = 0; k < page_length; k++) {
		if(k==current_page)
			page += '<strong>' + (k+1) + '</strong>';
		else
			page += ' <a href="#" onclick="showBooks(\'' + catalog + '\',' + page_list[k] + ')">' + (k+1) + '</a> ';
	}
	//alert(page_length);

	tags += '<tr><td align="center">' + previous + page + next + '</td></tr></table>';
	document.getElementById("content").innerHTML = tags + tables;
}


function add_to_cart(i) {
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  	xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				alert("This item was added to your cart successfully!");
				document.getElementById("cart_item").innerHTML=xmlhttp.responseText;
			}
	  }
	xmlhttp.open("GET","add_to_cart.php?isbn="+i,true);
	xmlhttp.send();	
}