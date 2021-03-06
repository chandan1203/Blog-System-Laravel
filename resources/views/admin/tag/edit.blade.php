@extends('layouts.backend.app')

@section('title','Tag')
@push('css')
	{{-- expr --}}
@endpush

@section('content')
	<div class="container-fluid">

            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit Tag </h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.tag.update',$tag->id) }}" method="post">
                            	@csrf
                                @method('PUT')
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="tag_name" class="form-control" name="tag_name" value="{{ $tag->name}}">
                                        <label class="form-label">Tag Name</label>
                                    </div>
                                </div>
                                <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.tag.index') }}">BACK</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection

@push('js')
	{{-- expr --}}
@endpush