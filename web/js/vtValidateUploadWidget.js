/**
 * Created with JetBrains PhpStorm.
 * User: vas_hoangl
 * Date: 12/18/12
 * Time: 11:39 AM
 * To change this template use File | Settings | File Templates.
 */
var is_max_size_upload = false;
$(function () {
  $("input:file").change(function () {
    $file = $(this);
    var input = this;
    if (!window.FileReader) {
      alert("Trình duyệt không hỗ trợ nhận dạng được dung lượng file.");
      return;
    }
    if (input.files && input.files[0] && $file.attr("max_size")) {
      file = input.files[0];
      var max_size = parseInt($file.attr("max_size"));
      var form = $file.parents('form:first');
      if (file.size > max_size) {
        is_max_size_upload = true;
        form.submit(function (e) {
          if (is_max_size_upload) {
            e.preventDefault(); //Prevent the normal submission action
            alert("File của bạn quá định dạng cho phép (" + (max_size / 1024 / 1024).toFixed(0) + "Mb).");
            return false;
          } else {
          }
        });
        alert("File của bạn quá định dạng cho phép (" + (max_size / 1024 / 1024).toFixed(0) + "Mb).");
        return;
      } else {
        is_max_size_upload = false;
      }
    }
  });
});
