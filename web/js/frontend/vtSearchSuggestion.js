/**
 * Created with JetBrains PhpStorm.
 * User: vas_hoangl
 * Date: 9/29/12
 * Time: 9:29 AM
 * To change this template use File | Settings | File Templates.
 */
var searchValue = "";
var lastTimeQuery = null;
var lastQuery = "";
var timer = null;
var xTriggered = 0;
var txtSearch = $('#global-keywords');
var divSuggestion = $('#suggestions');
var singer_match = null;
var currentRequest = '';
var isFinishRequest = false;
var redirectTicker;

function redirectSearchUrl(){
  if (isFinishRequest) {
    clearTimeout(redirectTicker);
    redirectUrl = window.location.href;
    if (singer_match != null && singer_match.is_match) {
      redirectUrl = singerDetaiLink.replace('singerDetaiLink', singer_match.singer_match);
    } else {
      var query=Base64.encode(txtSearch.val());
      query=query.replace('/','|');
      redirectUrl = searchCommonLink.replace('searchCommonLink',query);
    }
    window.location.href = redirectUrl;
  } else {
    redirectTicker = setTimeout('redirectSearchUrl()', 200);
  }
}

(function ($) {
  // Bat su kien click vao button search
  $('#searchIcon').click(function () {
    var text = trim(txtSearch.val());
    if (text == '') {
      alert(reqSearch);
      txtSearch.focus();
      return false;
    }
    else if (text == keywordMessage) {
//      alert("Vui lòng nhập vào ô tìm kiếm");
      txtSearch.focus();
      return false;
    }
    if (text.length == 1) {
      var query=Base64.encode(txtSearch.val());
      redirectUrl = searchCommonLink.replace('searchCommonLink',query);
      window.location.href = redirectUrl;
    }
    redirectSearchUrl();
    return false;
  });

// HUONGND16 - Bắt sự kiện nút tìm nhạc chờ!
// 25/07/2013

    $('#searchIcon').click(function () {
        var text = trim(txtSearch.val());
        if (text == '') {
            alert(reqSearch);
            txtSearch.focus();
            return false;
        }
        else if (text == keywordMessage) {
//      alert("Vui lòng nhập vào ô tìm kiếm");
        txtSearch.focus();
            return false;
        }
        if (text.length == 1) {
            var query=Base64.encode(txtSearch.val());
            redirectUrl = searchCommonLink.replace('searchCommonLink',query);
            window.location.href = redirectUrl;
        }
        var query=Base64.encode(txtSearch.val());
        query=query.replace('/','|');
        redirectUrl = searchCommonLink.replace('searchCommonLink',query);
        window.location.href = redirectUrl;
        return false;
    });

  txtSearch.keyup(function (event) {
    searchValue = $(this).val();
    var timerCallback = function () {
      suggesstionFunc();
    };
    clearTimeout(timer);
    timer = setTimeout(timerCallback, 200);
  });

  txtSearch.focusin(function () {
    if (divSuggestion.html() != "") {
      setTimeout("divSuggestion.fadeIn(50);", 100);
    }
  });

  txtSearch.blur(function (event) {
    setTimeout("divSuggestion.fadeOut(50);", 300);
  });

  txtSearch.keypress(function (e) {
    if (divSuggestion.css('display') != 'block')
      return;
    var allItem = divSuggestion.find('a.rows-item');
    var activeItem = divSuggestion.find('a.rows-item.active');
    var totalItem = allItem.size();
    var firstItem = allItem.eq(0);
    var lastItem = allItem.eq(totalItem - 1);
    var idx = allItem.index(activeItem);

    if (!totalItem) {
      return;
    }
    switch (e.keyCode) {
      case 38:
        if (idx == -1) {
          lastItem.addClass('active');
        } else {
          var prevItem = allItem.eq(idx - 1);
          activeItem.removeClass('active');
          prevItem.addClass('active');
        }
        break;

      case 40:
        if (idx == -1) {
          firstItem.addClass('active');
        } else if (idx == (totalItem - 1)) {
          // Item cuoi cung
          activeItem.removeClass('active');
          firstItem.addClass('active');
        } else {
          var nextItem = allItem.eq(idx + 1);

          activeItem.removeClass('active');
          nextItem.addClass('active');
        }
        break;
    }
  });

  $("#global-keywords").keypress(function (e) {
    if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
      var itemSugg = $('#suggestions a.rows-item.active');
      if (itemSugg.size() == 0)
        $('.btn-search').click();
      else
        $(location).attr('href', itemSugg.attr('href'));
      return false;
    }
    return true;
  });
})(jQuery);

function suggesstionFunc() {
  singer_match = null;
  if (searchValue.length < 2) {
    divSuggestion.fadeOut(100);
  } else {
    if (lastQuery == "") {
      lastQuery = searchValue;
    } else if (lastQuery == searchValue) {
      //divSuggestion.fadeIn(400);
      return;
    } else {
      lastQuery = searchValue;
    }
    //lấy dữ liệu từ ajax
    currentRequest = generateGuid();
    isFinishRequest = false;
    var link = "/ajax/ajaxSearchHome?currentRq=" + currentRequest + "&q=" + Base64.encode(searchValue);
    $.ajax({
      type:"POST",
      url:link,
      data:{},
      cache:false,
      success:function (data) {
        /**
         * Kiểu mặc định trả về là dạng String, bạn dùng hàm parseJSON để phân tích dữ liệu trả về
         * có 2 cách parse JSON là : JSON.parse() và $.parseJSON();
         * 1. var getData = JSON.parse(string);
         * 2. var getData = $.parseJSON(string);
         **/
        var getData = $.parseJSON(data);
        var services = getData.services;
        var articles = getData.articles;
        var currentRq = getData.currentRq;
        if (currentRq == currentRequest) {
          isFinishRequest = true;
        }
        singer_match = getData.singer_match;
        var hasResult = false;
        var resHtml = '';
        resHtml += '<h1><a href="javascript:void(0);">"' + messageResult + htmlEncode(searchValue) + '"</a></h1>';
        // bind services
        if (services.length > 0) {
          hasResult = true;
          resHtml += '<div class="suggest-singer">'
            +'<h4>' + productService + '</h4>'
            + '<ul class="list">';
          for (var i in services) {
            resHtml += '<li style="overflow:hidden;"><a class="rows-item" href="' + services[i].url + '">' +
              '<span class="images"><img width="36" height="36" src="' +
                services[i].image_path + '"></span><span class="name">' + stringMaxLength(services[i].title,35) +
              '</span></a></li>';
          }
          resHtml += '</ul></div>';
        }
        // bind articles
        if (articles.length > 0) {
          hasResult = true;
          resHtml += '<div class="suggest-album">'
            +'<h4>Tin tức</h4>'
            + '<ul class="list">';
          for (var i in articles) {
            resHtml += '<li style="overflow:hidden;"><a class="rows-item" href="' + articles[i].url + '">' +
              '<span class="images"><img width="36" height="36" src="' +
                articles[i].image_path + '"></span><span class="name">' + stringMaxLength(articles[i].title, 35) +
              '</span></a></li>';
          }
          resHtml += '</ul></div>';
        }

        if (hasResult)
          divSuggestion.html(resHtml);
        else
          divSuggestion.html('<h1><a href="javascript:void(0);">"' + notFound + htmlEncode(searchValue) + '"</a></h1>');
      },

      error:function (request, status, err) {

      },
      complete:function () {
        divSuggestion.fadeIn(200);
      }
    });
  }
}

function stringMaxLength(str, max_length) {
    var str_val = "";
    if (str.length > max_length) {
        str_val = str.substr(0, max_length) + "...";
    }
    else {
        str_val = str;
    }
    return str_val;
}
