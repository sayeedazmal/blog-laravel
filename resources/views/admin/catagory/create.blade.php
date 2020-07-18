@extends('layouts.backend.app')

@section('title','tag')

@push('css')

@endpush

@section('content')
  <div class="container-fluid">
      <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              Add new Catagory
                            </h2>

                        </div>
                        <div class="body">
                            <form action="{{ route('admin.catagory.store') }}" method="post" enctype="multipart/form-data">
                              @csrf
                                <label for="email_address">Catagory Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Enter your category name">
                                    </div>
                                </div>
                                <div class="form-group">
                                  <input type="file" name="image">
                                </div>

                                <br>
                                <a class="btn btn-danger m-t-15 waves-effect" href = "{{ route('admin.catagory.index') }}" >BACK</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
  </div>
@endsection

@push('js')

@endpush
