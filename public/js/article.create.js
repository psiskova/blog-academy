$(document).ready(function() {
    $('#area').remove();
  $('#summernote').summernote({
  height: 300,                 // set editor height

  minHeight: 300,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor

  focus: true,                 // set focus to editable area after initializing summernote
});
});