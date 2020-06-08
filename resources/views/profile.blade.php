@extends('layouts.frontend.app')

@section('title','Profile')

@push('css')
	<link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">

    <style>
    </style>

@endpush

@section('content')
	<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>{{ $user->name }}</b></h1>
	</div><!-- slider -->

<section class="blog-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="row">
				
				@if($posts->count() > 0)		
                @foreach ($posts as $post)
                    <div class="col-lg-6 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image)}}" alt="{{ $post->title}}"></div>

                            <a class="avatar" href="{{ route('profile.details',$post->user->username) }}"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image)}}" alt="Profile Image"></a>

                            <div class="blog-info">

                                <h4 class="title"><a href="{{ route('post.details',$post->slug) }}"><b>{{ $post->title}}</b></a></h4>

                                <ul class="post-footer">
                                    <li>
                                       @guest()
                                           <a href="#" onclick="toastr.info('Add or Remove favorite list! You need to login first','Info',{
                                            closeButton:true,
                                            progressBar:true,
                                           })" 
                                           ><i class="ion-heart">{{ $post->favourite_to_users->count()}}</i></a>
                                        @else
                                        <a href="#" onclick="document.getElementById('add-list-{{$post->id}}').submit()" class="{{ !Auth::user()->favourite_posts()->where('post_id',$post->id)->count()== 0 ? 'favorite_post' : ''}}" 
                                           ><i class="ion-heart">{{ $post->favourite_to_users->count()}}</i></a>
                                           <form id="add-list-{{$post->id}}" method="post" action="{{ route('add.favorite',$post->id) }}" style="display: none">
                                               @csrf
                                           </form>


                                        @endguest 
                                        
                                        
                                    </li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count}}</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endforeach
                @else
				<div class="col-lg-12 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-1">


                            <div class="blog-info">

                                <h4 class="title">
                                    <strong>Sorry, No post Found</strong>
                                </h4>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endif

					</div><!-- row -->
                     {{ $posts->links()}}

				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 ">

					<div class="single-post info-area ">

						<div class="about-area">
							<h4 class="title"><b>ABOUT AUTHOR</b></h4>
							<p>Name: {{ $user->name }}</p><br>
							<p>About: {{ $user->about }}</p><br>
							<strong>Author Since: {{ $user->created_at->toDateString()}} </strong><br><br>
							<strong>Total Posts: {{ $posts->count()}}</strong><br>
						</div>

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
</section><!-- section -->

@endsection
@push('js')

@endpush
