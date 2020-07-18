@extends('layouts.backend.app')

@section('title','catagory')

@push('css')
  <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
  <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/Backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }} " rel="stylesheet">
@endpush

@section('content')
        <div class="container-fluid">
            <div class="block-header">
              <a class="btn btn-primary waves-effect"  href="{{ route('admin.post.create')}}"><i class="material-icons">add</i>
                <span> Add Post</span>
              </a>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              All Post
                              <span class="badge bg-blue">{{$posts->count() }}</span>
                            </h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Author</th>
                                            <th>title</th>
                                            <th>Image</th>
                                            <th><i class="material-icons">visibility</i></th>
                                            <th>status</th>
                                            <th>is_aproved</th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th>ID</th>
                                          <th>Author</th>
                                          <th>title</th>
                                          <th>Image</th>
                                          <th><i class="material-icons">visibility</i></th>
                                          <th>status</th>
                                          <th>is_aproved</th>

                                          <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                      @foreach ($posts as $key => $post)

                                        <tr>
                                          <td>{{ $key + 1}}</td>
                                          <td>{{ $post->user->name }}</td>
                                          <td>{{ str_limit($post->title,10)  }}</td>
                                          <td><img style="height:80px; width:80px" src="{{url('storage/post').'/'.$post->image}}" alt=""></td>
                                          <td>{{ $post->view_count }}</td>
                                          <td>  @if ($post->status==true)
                                              <span class="badge bg-blue">published</span>
                                            @else
                                              <span class="bg-red">panding</span>
                                            @endif</td>

                                          <td>
                                            @if ($post->is_aproved==true)
                                              <span class="badge bg-blue">aproved</span>
                                             @else
                                              <span class="bg-red">panding</span>
                                            @endif
                                          </td>

                                          {{-- <td><img style="height:80px; width:80px" src="{{url('storage/post').'/'.$post->image}}" alt=""></td> --}}



                                          <td>
                                            @if ($post->is_aproved==false)
                                              <button type="button" class="btn btn-success wave-effects" onclick="aprovePost({{ $post->id }})">
                                              <i class="material-icons">done</i>
                                              </button>

                                              <form id="aproval-form" style="display: none;" action="{{ route('admin.post.approve', $post->id) }}" method="POST">
                                                @csrf
                                                @method('put');
                                              </form>

                                            @else
                                              <button type="button" class="btn btn-success disabled">
                                                <i class="material-icons">done</i>
                                              </button>
                                            @endif

                                            <a  href="{{ route('admin.post.show',$post->id)}}" class="btn btn-info waves-effect">
                                              <i class="material-icons">visibility</i>
                                            </a>
                                            <a  href="{{ route('admin.post.edit',$post->id)}}" class="btn btn-info waves-effect">
                                            <i class="material-icons">edit</i>
                                            </a>
                                          <button class="btn btn-danger waves-effect" type="button" onclick="deletePost({{ $post->id }})">
                                              <i class="material-icons">delete</i>
                                          </button>
                                            <form id="delete-form-{{ $post->id }}" style="display: none;" action="{{ route('admin.post.destroy', $post->id) }}" method="post">
                                              @csrf
                                              @method('DELETE');
                                          </form>
                                        </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
@endsection

@push('js')

    <!-- Jquery DataTable Plugin Js -->
  <script src="{{ asset('assets/Backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
  <script src="{{ asset('assets/Backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

  <!-- Custom Js -->
  <script src="{{asset('assets/Backend/js/pages/tables/jquery-datatable.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <script type="text/javascript">

  function deletePost(id) {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
      }).then((result) => {
      if (result.value) {
          event.preventDefault();
          document.getElementById('delete-form-'+id).submit();
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          'Your imaginary file is safe :)',
          'error'
        )
      }
    })
  }
  function aprovePost (id) {
     const swalWithBootstrapButtons = Swal.mixin({
       customClass: {
         confirmButton: 'btn btn-success',
         cancelButton: 'btn btn-danger'
       },
       buttonsStyling: false
       })
       swalWithBootstrapButtons.fire({
       title: 'Are you sure to approve?',
       text: "You won't be able to Aprove this",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonText: 'Yes, It is approved!',
       cancelButtonText: 'No, cancel!',
       reverseButtons: true
       }).then((result) => {
       if (result.value) {
           event.preventDefault();
           document.getElementById('aproval-form').submit();
       } else if (
         /* Read more about handling dismissals below */
         result.dismiss === Swal.DismissReason.cancel
       ) {
         swalWithBootstrapButtons.fire(
           'Aprove Cancelled',
           'Your Aprove is safe :)',
           'error'
         )
       }
     })
   }

</script>



@endpush
