@extends('HOCPLUS-FRONTEND::layouts.frontend')

@section('title', 'Khóa học yêu thích')

@section('content')

		<main class="main ms-main">
			<div class="container">
				<div class="row">
					@include('HOCPLUS-STUDENTPROFILE::modules.studentprofile.include.menu_left')

					<div class="col-12 col-md-8 col-lg-9 ms-right">
						<div class="ms-wishlist">
							<h2 class="headline">Wishlist</h2>
							<div class="row group-item">
                                                            @foreach ($course as $item)
								<figure class="col-12 col-md-6 col-lg-4 c-item-course">
									<div class="inner">
										<div class="img">
											<a href="/khoa-hoc/{{$item->course_id}}">
                                                                                            @if ($item->avartar!='' && file_exists(substr($item->avartar, 1)))
												<img src="{{config('site.url_static') . $item->avartar}}" alt="">
                                                                                            @else
                                                                                            <img src='/vendor/vnedutech-cms/default/hocplus/frontend/images/course.jpg'>
                                                                                            @endif
											</a>
										</div>
										<h3 class="name"><a href="/khoa-hoc/{{$item->course_id}}">{{$item->name}}</a></h3>
										<div class="info">
											<div class="subjects-class">
												<div class="subjects">{{$subjectList[$item->course_id]->subject_name}}</div>
												<div class="class">{{$subjectList[$item->course_id]->class_name}}</span></div>
											</div>
										</div>
									</div>
								</figure>
                                                            @endforeach	
							</div>
						</div> <!-- / wishlist -->
					</div> <!-- / col-9 -->
				</div>
			</div> <!-- / container -->
		</main> <!-- / main -->

@endsection
