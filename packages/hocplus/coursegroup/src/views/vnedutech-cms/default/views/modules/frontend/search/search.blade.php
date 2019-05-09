@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Danh sách khóa học" }}@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- Page content --}}
@section('content')
<main class="main">

    <nav class="c-breadcrumb">
      <div class="container">
        <ol class="breadcrumb-list">
          <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
          <li class="breadcrumb-item active">Kết quả tìm kiếm</li>
        </ol>
      </div>
    </nav> <!-- / breadcrumb -->

    <div class="container container-main">
      <div class="row row-main">
        <div class="col-12 col-lg-9 main-left">
          <div class="c-search">
              <div class="result">
                <h2 class="title">{{ count($list_courses) }} Kết quả tìm kiếm cho từ khóa <span class="key-word">“{{ $keyword }}”</span></h2>
                <div class="row list-item-course">
                  @if(!empty($list_courses))
                  @foreach($list_courses as $course)
                  @include('HOCPLUS-COURSEGROUP::modules.frontend.course._partial._item_course',[
                       'course' => $course,
                       'figure_class' => 'col-12 col-md-6 col-lg-4 c-item-course'
                   ])
                  @endforeach
                  @endif
                </div> <!-- / list item-course -->
                <nav class="c-navigation">
                  <div class="container">
                    {{ $list_courses->links() }}
                  </div>
                </nav> <!-- / navigation -->
              </div>
              <div class="new">
                  <h2 class="title">Tin tức</h2>
    
                  <div class="group-item">
                    @if(!empty($list_news))
                    @foreach($list_news as $news)
                    <figure class="item c-item-news-01">
                      <div class="inner">
                        <div class="img">
                          <a href="{{ route('hocplus.news.detail', $news->news_id . '-' . $news->title_alias ) }}"><img src="{{ ($news->image != '' || file_exists(substr($news->image, 1))) ? config('site.url_static') . $news->image : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/course.jpg' }}" alt=""></a>
                        </div>
                        <div class="info">
                          <h3 class="title"><a href="{{ route('hocplus.news.detail', $news->news_id . '-' . $news->title_alias ) }}">{{ $news->title }}</a></h3>
                          <div class="description">{{ $news->desc }}</div>
                          <a href="{{ route('hocplus.news.detail', $news->news_id . '-' . $news->title_alias ) }}" class="btn">Chi tiết <i class="fa fa-angle-double-right"></i></a>
                        </div>
                      </div>
                    </figure> <!-- / item -->
                    @endforeach
                    @endif
                </div> <!-- / new -->
                  <nav class="c-navigation">
                      <div class="container">
                        {{ $list_news->links() }}
                    </div>
                  </nav> <!-- / navigation -->
              </div>
            </div>
        </div> <!-- / main left -->

        <div class="col-12 col-lg-3 main-right">

          <div class="c-course-hot">
            <h3 class="headline">Các khóa học nổi bật</h3>
            <div class="group-item">
              <figure class="item">
                <div class="inner">
                  <div class="img">
                    <a href=""><img src="images/c1.png" alt="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a>
                  </div>
                  <div class="info">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><i class="fa fa-tag"></i> 1.000.000<span>đ</span></div>
                  </div>
                </div>
              </figure> <!-- / item -->
              <figure class="item">
                <div class="inner">
                  <div class="img">
                    <a href=""><img src="images/c1.png" alt="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a>
                  </div>
                  <div class="info">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><i class="fa fa-tag"></i> 1.000.000<span>đ</span></div>
                  </div>
                </div>
              </figure> <!-- / item -->
              <figure class="item">
                <div class="inner">
                  <div class="img">
                    <a href=""><img src="images/c1.png" alt="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a>
                  </div>
                  <div class="info">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><i class="fa fa-tag"></i> 1.000.000<span>đ</span></div>
                  </div>
                </div>
              </figure> <!-- / item -->
              <figure class="item">
                <div class="inner">
                  <div class="img">
                    <a href=""><img src="images/c1.png" alt="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a>
                  </div>
                  <div class="info">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><i class="fa fa-tag"></i> 1.000.000<span>đ</span></div>
                  </div>
                </div>
              </figure> <!-- / item -->
              <figure class="item">
                <div class="inner">
                  <div class="img">
                    <a href=""><img src="images/c1.png" alt="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a>
                  </div>
                  <div class="info">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><i class="fa fa-tag"></i> 1.000.000<span>đ</span></div>
                  </div>
                </div>
              </figure> <!-- / item -->
              <figure class="item">
                <div class="inner">
                  <div class="img">
                    <a href=""><img src="images/c1.png" alt="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a>
                  </div>
                  <div class="info">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><i class="fa fa-tag"></i> 1.000.000<span>đ</span></div>
                  </div>
                </div>
              </figure> <!-- / item -->
              <figure class="item">
                <div class="inner">
                  <div class="img">
                    <a href=""><img src="images/c1.png" alt="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a>
                  </div>
                  <div class="info">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><i class="fa fa-tag"></i> 1.000.000<span>đ</span></div>
                  </div>
                </div>
              </figure> <!-- / item -->
              <figure class="item">
                <div class="inner">
                  <div class="img">
                    <a href=""><img src="images/c1.png" alt="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a>
                  </div>
                  <div class="info">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><i class="fa fa-tag"></i> 1.000.000<span>đ</span></div>
                  </div>
                </div>
              </figure> <!-- / item -->
              <figure class="item">
                <div class="inner">
                  <div class="img">
                    <a href=""><img src="images/c1.png" alt="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a>
                  </div>
                  <div class="info">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><i class="fa fa-tag"></i> 1.000.000<span>đ</span></div>
                  </div>
                </div>
              </figure> <!-- / item -->
              <figure class="item">
                <div class="inner">
                  <div class="img">
                    <a href=""><img src="images/c1.png" alt="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a>
                  </div>
                  <div class="info">
                    <h4 class="title"><a href="">Khóa học bồi dưỡng học sinh giỏi lớp 2</a></h4>
                    <div class="price"><i class="fa fa-tag"></i> 1.000.000<span>đ</span></div>
                  </div>
                </div>
              </figure> <!-- / item -->
            </div>
          </div> <!-- / course hot -->

        </div> <!-- / main right -->
        
      </div> <!-- / row -->
    </div> <!-- / container -->
    </div>
  </main>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
@stop
