@extends('layouts.backend.app')

@section('title','show')

@push('css')

@endpush

@section('content')
  <div class="container-fluid">
    <a href="{{route('author.post.index')}}"><button class="btn btn-danger wave-effects">BACK</button></a>
      @if ($post->is_aproved==false)
        <button type="button" class="btn btn-success pull-right">
          <i class="material-icons">done</i>
          <span>Aprove</span>
        </button>
      @else
        <button type="button" class="btn btn-success pull-right disabled">
          <i class="material-icons">done</i>
          <span>Aproved</span>
        </button>
      @endif
      <br><br>
      <div class="row clearfix">
          <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header"><h2>{{ $post->title }}</h2>
                          <small>posted by: <strong><a href="#">{{ $post->user->name }}</a></strong>
                            on {{ $post->created_at->toFormattedDateString() }}
                          </small>
                        </div>
                    <div class="body">
                      {!! $post->body !!}
                    </div>
                  </div>
                </div>
          <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                <div class="header bg-cyan">
                    <h2>Catagories</h2>

              </div>
              <div class="body">
                @foreach ($post->catagories as $catagories)
                  <span class="label bg-cyan">{{ $catagories->name }}</span>
                @endforeach
              </div>
            </div>
            <div class="card">
              <div class="header bg-cyan">
                  <h2>Tags</h2>

            </div>
            <div class="body">
              @foreach ($post->tags as $tags)
                <span class="label bg-cyan">{{ $tags->name }}</span>
              @endforeach
            </div>
            </div>
            <div class="card">
              <div class="header bg-cyan">
                  <h2>Feture Image</h2>
              </div>
            <div class="body">
            <img class="img-responsive thumbnail" src="{{ url('Storage/post/'.$post->image) }}" alt="">
            </div>
            </div>
        </div>
      </div>
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
