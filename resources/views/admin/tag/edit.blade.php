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
                              Edit Tag
                            </h2>

                        </div>
                        <div class="body">
                            <form action="{{ route('admin.tag.update',$tag->id) }}" method="post">
                              @csrf
                              @method('PUT')
                                <label for="email_address">tag name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" value="{{$tag->name}}" class="form-control" name="name" placeholder="Enter your tag name">
                                    </div>
                                </div>

                                <br>
                                <a class="btn btn-danger m-t-15 waves-effect" href = "{{ route('admin.tag.index') }}" >BACK</a>
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
