(function($) {
  'use strict';
  $(function() {
    $('.file-uploads-browse').on('click', function() {
      var file = $(this).parent().parent().parent().find('.file-uploads-default');
      file.trigger('click');
    });
    $('.file-uploads-default').on('change', function() {
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
  });
})(jQuery);
