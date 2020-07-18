@extends('layouts.backend.app')

@section('title','tag')

@push('css')
  <link href="{{ asset('assets/Backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
  <div class="container-fluid">
    <form action="{{ route('admin.post.update',$post->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              Edit Post
                            </h2>

                        </div>
                        <div class="body">

                                <label for="email_address">Title</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="{{ $post->title }}" id="name" class="form-control" name="title" placeholder="Enter your tag name">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <input type="file" name="image">
                                </div>

                                <div class="form-group">
                                  <input type="checkbox" id='publish' class="filled-in" name="status" value="1" {{ $post->status == true ? 'checked' : '' }}>
                                  <label for="publish">publish</label>
                                </div>

                                <br>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            Add Catagories and Tags
                            </h2>

                        </div>
                        <div class="body">

                          <div class="form-group form-float">
                              <div class="form-line {{ $errors->has('categories') ? 'focused error' :'' }}">
                                  <label class="form-label">select catagory</label><br><br>
                                  <select name="categories[]" id='category' class="selectpicker" multiple>

                                    @foreach ($categories as $categories)
                                      <option

                                      @foreach ($post->catagories as $postcatagory)
                                        {{ $postcatagory->id == $categories->id ? 'selected' : ''}}
                                      @endforeach
                                       value="{{$categories->id }}">{{ $categories->name }}</option>
                                    @endforeach
                                  </select>
                              </div>
                          </div><br>
                          <div class="form-group form-float">
                                  <div class="form-line {{ $errors->has('tags')? 'focused error' :'' }}">
                                      <label class="form-label">select tag</label><br><br>
                                      <select name="tag[]" id='tags' class="selectpicker" multiple>
                                        @foreach ($tags as $tag)
                                          <option

                                          @foreach ($post->tags as $posttags)
                                            {{ $posttags->id == $tag->id ? 'selected' : ''}}
                                          @endforeach
                                           value="{{$tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                      </select>
                                  </div>
                          </div>
                                <br>
                                <a class="btn btn-danger m-t-15 waves-effect" href = "{{ route('admin.post.index') }}" >BACK</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>

                        </div>
                    </div>
                </div>
      </div>
      <div class="row clearfix">
        <!-- TinyMCE -->
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <div class="header">
                          <h2>
                              TINYMCE
                              <small>Taken from <a href="https://www.tinymce.com" target="_blank">www.tinymce.com</a></small>
                          </h2>
                      </div>
                      <div class="body">
                          <textarea id="tinymce" name="body">
                            {{ $post->body }}
                          </textarea>
                      </div>
                  </div>
              </div>
      </div>
        <!-- #END# TinyMCE -->
    </form>
  </div>
@endsection

@push('js')
  <!-- TinyMCE -->
  <script src="{{ asset('assets/Backend/plugins/tinymce/tinymce.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/Backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <script>
    $(function () {

  //TinyMCE
  tinymce.init({
      selector: "textarea#tinymce",
      theme: "modern",
      height: 300,
      plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools'
      ],
      toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar2: 'print preview media | forecolor backcolor emoticons',
      image_advtab: true
  });
  tinymce.suffix = ".min";
  tinyMCE.baseURL = '{{ asset('assets/Backend/plugins/tinymce') }}';
});
    </script>
@endpush
