
Dropzone.options.dropzone ={
  url: "{{ route('dropzone.store') }}",
  headers: {'X-CSRF-TOKEN': '{!! csrf_token() !!}'},
  renameFile: function(file) {
    var dt = new Date();
    var time = dt.getTime();
    return time+file.name;
  },
  acceptedFiles: "image/*,application/pdf",
  addRemoveLinks: true,
  timeout: 50000,
  removedfile: function(file)
  {
    var name = file.upload.filename;
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': '{!! csrf_token() !!}'
      },
      type: 'POST',
      url: '{{ route("dropzone.delete") }}',
      data: {filename: name},
      success: function (data){
        console.log("Xóa ảnh thành công!!");
      },
      error: function(e) {
        console.log(e);
      }});
    var fileRef;
    return (fileRef = file.previewElement) != null ?
    fileRef.parentNode.removeChild(file.previewElement) : void 0;
  },
  init: function () {

    var myDropzone = this;

    $.get('{{ route('show.dropzone') }}?id=' + myDropzone.element.attributes.item_id.value).done(function(data) {

      $.each(data.images, function (key, value) {

        var file = {
          name: value.fileable_id
        };
        myDropzone.options.addedfile.call(myDropzone, file);
        myDropzone.options.thumbnail.call(myDropzone, file,"http://" + window.location.hostname +'/images/'+value.url);
        myDropzone.emit("complete", file);

      });
    });

  },
  success: function(file, response)
  {
    console.log(response);
  },
  error: function(file, response)
  {
    return false;
  },

};
