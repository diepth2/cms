/**
 * Created with JetBrains PhpStorm.
 * User: vas_hoangl
 * Date: 9/29/12
 * Time: 3:00 PM
 * To change this template use File | Settings | File Templates.
 */

function htmlEncode(value) {
  return $('<div/>').text(value).html();
}

function htmlDecode(value) {
  return $('<div/>').html(value).text();
}

function generateGuid() {
  var result, i, j;
  result = '';
  for (j = 0; j < 32; j++) {
    if (j == 8 || j == 12 || j == 16 || j == 20)
      result = result + '-';
    i = Math.floor(Math.random() * 16).toString(16).toLowerCase();
    result = result + i;
  }
  return result;
}

(function ($) {
  $('.text_placeholder').each(function () {
    var $this = $(this);
    if (trimValue($this.val()) == '')
      $this.val($this.attr('text_placeholder'));
  })
  $('.text_placeholder')
    .on('focus', function () {
      var $this = $(this);
      if ($this.val() == $this.attr('text_placeholder')) {
        $this.val('');
      }
    })
    .on('blur', function () {
      var $this = $(this);
      if ($this.val() == '') {
        $this.val($this.attr('text_placeholder'));
      }
    });
})(jQuery);

function changeStyle(id) {
  if (document.getElementById('button-more' + id).style.width != '94px') {
    document.getElementById('button-more' + id).style.width = '94px';
    document.getElementById('button-more' + id).style.height = '36px';
  }
  else {
    document.getElementById('button-more' + id).style.width = '17px';
    document.getElementById('button-more' + id).style.height = '15px';
  }
}

function trimValue(str) {
  if (str && str != "") {
    var str = str.replace(/^\s\s*/, ''),
      ws = /\s/,
      i = str.length;
    while (ws.test(str.charAt(--i)));
    return str.slice(0, i + 1);
  }
  return "";
}
