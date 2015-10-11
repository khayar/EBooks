///////////////////////////////////////////////////////////////////////////////
//The following functions is for gathering data from XML files by using AJAX///
window["MzBrowser"] = {};
(function ()
{
    if (MzBrowser.platform)
        return;
    var ua = window.navigator.userAgent;
    MzBrowser.platform = window.navigator.platform;

    MzBrowser.firefox = ua.indexOf("Firefox") > 0;
    MzBrowser.opera = typeof (window.opera) == "object";
    MzBrowser.ie = !MzBrowser.opera && ua.indexOf("MSIE") > 0;
    MzBrowser.mozilla = window.navigator.product == "Gecko";
    MzBrowser.netscape = window.navigator.vendor == "Netscape";
    MzBrowser.safari = ua.indexOf("Safari") > -1;

    if (MzBrowser.firefox)
        var re = /Firefox(\s|\/)(\d+(\.\d+)?)/;
    else if (MzBrowser.ie)
        var re = /MSIE( )(\d+(\.\d+)?)/;
    else if (MzBrowser.opera)
        var re = /Opera(\s|\/)(\d+(\.\d+)?)/;
    else if (MzBrowser.netscape)
        var re = /Netscape(\s|\/)(\d+(\.\d+)?)/;
    else if (MzBrowser.safari)
        var re = /Version(\/)(\d+(\.\d+)?)/;
    else if (MzBrowser.mozilla)
        var re = /rv(\:)(\d+(\.\d+)?)/;

    if ("undefined" != typeof (re) && re.test(ua))
        MzBrowser.version = parseFloat(RegExp.$2);
})();


var asyncRequest;
var result;
var book_img_root = "images/books/";

function getBooks() {

    try {
        if (MzBrowser.firefox) {
            //alert("firefox");
            asyncRequest = document.implementation.createDocument("", "", null);
            asyncRequest.async = false;
            asyncRequest.load("booklist.xml");
            result = asyncRequest;
            //asyncRequest.open( 'GET', 'booklist.xml', true );
            //asyncRequest.send(null);
            //var parser = new DOMParser();
            //result = parser.parseFromString(asyncRequest.responseText, "text/xml");
            showBooks();
        } else if (MzBrowser.ie) {
            //alert("ie");
            asyncRequest = new ActiveXObject("Microsoft.XMLHTTP");
            asyncRequest.open('GET', 'booklist.xml', true);
            asyncRequest.onreadystatechange = function () {
                if (asyncRequest.readyState == 4 && asyncRequest.status == 200 && asyncRequest.responseXML) {
                    result = asyncRequest.responseXML;
                    showBooks();
                }
            }
            asyncRequest.send(null);
        } else {
            asyncRequest = new XMLHttpRequest();
            asyncRequest.open('GET', 'booklist.xml', true);
            asyncRequest.onreadystatechange = function () {
                if (asyncRequest.readyState == 4 && asyncRequest.status == 200 && asyncRequest.responseXML) {
                    result = asyncRequest.responseXML;
                    showBooks();
                }
            }
            asyncRequest.send(null);
        }

    } // end try
    catch (e) {
        alert("Error -> " + e.message);
    } // end catch
}

function showBooks() {
    var isbn_a = document.getElementById("isbn_a").innerHTML;
    if (isbn_a.length == 0)
    {
        document.getElementById("content").innerHTML = "<p>Shopping cart is empty</p>";
        return;
    }
    var all_isbn = isbn_a.split(",");

    var isbn_dic = new Dictionary();

    for (var i = 0; i < all_isbn.length; i++)
    {
        var isbn = all_isbn[i];
        if (!isbn_dic.ContainsKey(isbn))
        {
            isbn_dic.Add(isbn, 1);
        }
        else
        {
            var c = isbn_dic.Item(isbn);
            isbn_dic.Remove(isbn);
            c++;
            isbn_dic.Add(isbn, c);
        }
    }


    var tags = '<form name="payment" method="post" action="redirect.php?price=22>\n\
        <table class="cart_table">\n\
        <tr class="cart_title">\n\
        <td>Image &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n\
        <td>Book name  &nbsp;</td>\n\
        <td>Unit price  &nbsp;</td>\n\
        <td>Qty  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n\
        <td>Total  &nbsp;</td>\n\
        <td></td>\n\
       </tr>';
    var title, price, isbn, image, total = 0;

    // get the catalogs from the responseXML
    var catalogs = result.getElementsByTagName("catalog");
    var books;
    for (var i = 0; i < catalogs.length; i++)
    {
        books = catalogs.item(i).getElementsByTagName("book");
        for (var j = 0; j < books.length; j++)
        {
            isbn = books.item(j).getElementsByTagName("isbn").item(0).firstChild.nodeValue;
            var isbns = isbn_dic.Keys();
            for (var k = 0; k < isbns.length; k++)
            {
                if (isbn == isbns[k])
                {
                    title = books.item(j).getElementsByTagName("title").item(0).firstChild.nodeValue;
                    price = books.item(j).getElementsByTagName("price").item(0).firstChild.nodeValue;
                    image = books.item(j).getElementsByTagName("image").item(0).firstChild.nodeValue;
                    var price_d = price.replace('$', '');
                    var subtotal = price_d * isbn_dic.Item(isbns[k]);
                    tags += '<tr><br /></tr><tr>\n\
<td><img src="' + book_img_root + image + '" alt="" width="79" height="120" /></td>\n\
<td>' + title + '</td>\n\
<td>' + price + '</td>\n\
<td><input id="qty" type="text" size="3" maxlength="3" value="' + isbn_dic.Item(isbns[k]) + '" /></td>\n\
<td>$' + subtotal + '</td>\n\
<td><a href="#">Remove</a></td>\n\
</tr>';
                    total += subtotal;
                    isbn_dic.Remove(isbns[k]);
                    break;
                }
            }
        }
    }

    tags += '<tr><td colspan="5"><span>TOTAL:</span></td><td><div id="total">$' + total + '</div></td></tr>' +
            '<tr><td colspan="6"><hr /><br /><a href="Order.php"><img src="images/Check out Now_0.gif" width="129" height="36"/></a></td></tr></table></form>';
    document.getElementById("content").innerHTML = tags;

}
