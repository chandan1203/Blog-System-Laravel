@extends('layouts.backend.app')

@section('title','Dashboard')

@push('css')
    {{-- expr --}}
@endpush

@section('content')
    <div class="container-fluid">
                <div class="block-header">
                    <h2>DASHBOARD</h2>
                </div>

                <!-- Widgets -->
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-pink hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">playlist_add_check</i>
                            </div>
                            <div class="content">
                                <div class="text">TOTAL POSTS</div>
                                <div class="number count-to" data-from="0" data-to="{{ $posts->count()}}" data-speed="15" data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-cyan hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">favorite</i>
                            </div>
                            <div class="content">
                                <div class="text">TOTAL FAVORITE</div>
                                <div class="number count-to" data-from="0" data-to="{{ Auth::user()->favourite_posts->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-light-green hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">forum</i>
                            </div>
                            <div class="content">
                                <div class="text">PENDING POSTS</div>
                                <div class="number count-to" data-from="0" data-to="{{ $total_pending_post }}" data-speed="1000" data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-orange hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">person_add</i>
                            </div>
                            <div class="content">
                                <div class="text">TOTAL VIEW</div>
                                <div class="number count-to" data-from="0" data-to="{{ $total_view }}" data-speed="1000" data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Widgets -->
                <!-- CPU Usage -->
 
                <!-- #END# CPU Usage -->


                <div class="row clearfix">
                    <!-- Task Info -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>TOP 5 POPULAR POST</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover dashboard-task-infos">
                                        <thead>
                                            <tr>
                                                <th>Rank List</th>
                                                <th>Title</th>
                                                <th>Views</th>
                                                <th>Favorite</th>
                                                <th>Comments</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($popular_post as $key=>$post )
                                            <tr>
                                                
                                                    <td>{{ $key +1 }}</td>
                                                    <td>{{ str_limit($post->title,'30') }}</td>
                                                    <td>{{ $post->view_count }}</td>
                                                    <td>{{ $post->favourite_to_users_count }}</td>
                                                    <td>{{ $post->comments_count }}</td>
                                                    <td>
                                                        @if ($post->is_approved == true)

                                                        <span class="label bg-green "><strong>Published</strong></span>
                                                            @else

                                                        <span class="label bg-red "><strong>Pending</strong></span>
                                                        @endif
                                                    </td>
                                                 </tr>
                                                @endforeach
                                                
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Task Info -->
                </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/backend/plugins/jquery-countto/jquery.countTo.js')}}"></script>

   

   <script src="{{ asset('assets/backend/js/pages/index.js')}}"></script>
@endpush
