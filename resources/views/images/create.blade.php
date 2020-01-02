@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('js/dropzone/dropzone.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Image
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'images.store']) !!}

                        @include('images.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/dropzone/dropzone.js') }}"></script>
    <script>
      // Disable auto discover for all elements:
      Dropzone.autoDiscover = false;
      var myDropzone = new Dropzone("div#myId", { 
        url: "{{ route('uploadImage') }}", 
        headers: { 'X-CSRF-TOKEN': '{!! csrf_token() !!}' },
        acceptedFiles: "image/*,application/pdf",
        maxFilesize: 4, // MB
        init: function() {
          this.on("thumbnail", function() {
                $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
            });
          this.on("success", function(file, response) {
              file.imageId = response.id;
              // file.name = response.title;
              // toastr.success(response.message);
          });
          this.on("addedfile", function(file) {
              // Create the remove button
              var removeButton = Dropzone.createElement("<a class='dz-remove' href='#' data-dz-remove=''>Xóa ảnh</a>");

              // Capture the Dropzone instance as closure.
              var _this = this;

              // Listen to the click event
              removeButton.addEventListener("click", function(e) {
                  // Make sure the button click doesn't submit the form:
                  e.preventDefault();
                  e.stopPropagation();

                  // Remove the file preview.
                  _this.removeFile(file);
                  // If you want to the delete the file on the server as well,
                  // you can do the AJAX request here.
                  $.ajax({
                      url: "{{ route('deleteImage') }}",
                      data: { imageId: file.imageId },
                      headers: { "X-CSRF-TOKEN": "{!! csrf_token() !!}" },
                      type: 'POST',
                      // success: function (data) {
                      //     toastr.success(data.message);
                      // },
                      // error: function (data) {
                      //     toastr.error(data.message);
                      // }
                  });
              });

              // Add the button to the file preview element.
              file.previewElement.appendChild(removeButton);
          });

          // var thisDropzone = this;
          // Call the action method to load the images from the server
         // $.getJSON("?id="+ thisDropzone.element.attributes.item_id.value).done(function(response) {
         //      var data = response.data;
         //      $.each(data, function (index, item) {
         //              // console.log(item);
         //              var mockFile = {
         //                  imageId: item.id
         //              };

         //              // Call the default addedfile event handler
         //              thisDropzone.emit("addedfile", mockFile);

         //              // And optionally show the thumbnail of the file
         //              var ext = item.url.split('.').pop();
         //              if (ext == "pdf") {
         //                  // thisDropzone.emit("thumbnail", mockFile, "http://" + window.location.hostname + ":" + window.location.port +"/uploads/appendixes/pdf.png");
         //                  thisDropzone.emit("thumbnail", mockFile, "https://" + window.location.hostname + "/uploads/appendixes/pdf.png");
         //              } 
         //              else {
         //              thisDropzone.emit("thumbnail", mockFile, "https://" + window.location.hostname + '/' +item.url);
         //              }

         //              // If you use the maxFiles option, make sure you adjust it to the
         //              // correct amount:
         //              //var existingFileCount = 1; // The number of files already uploaded
         //              //myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
         //      });
         //      $(".dz-progress").remove();
         //  });
      },
      });

    </script>
@endsection