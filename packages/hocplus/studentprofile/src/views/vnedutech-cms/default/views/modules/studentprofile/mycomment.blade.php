@extends('HOCPLUS-FRONTEND::layouts.frontend')

@section('title', 'Bình luận của tôi')

@section('content')
   <main class="main ms-main">

      <div class="container">
        <div class="row">
            
          @include('HOCPLUS-STUDENTPROFILE::modules.studentprofile.include.menu_left')

          <div class="col-12 col-md-8 col-lg-9 ms-right">
            <section class="ms-comments">
              <div class="headline">
                <div class="title">Bình luận khóa học</div>
              </div>
              <div class="group-item">
                @foreach ($comment as $item)
                <figure class="item">
                  <div class="wrapper">
                    <div class="avatar">
                      <span><img src="{{config('site.url_static').$item->getUser()->get()->first()->avatar}}" alt=""></span>
                    </div>                      
                    <div class="inner">
                      <div class="info">
                        <span class="name-user">{{$item->getUser()->get()->first()->name}}</span>
                        <span class="way">-</span>
                        @if ($item->getCourse()->get()->first())
                        <span class="name-course"><a href="/khoa-hoc/{{$item->getCourse()->get()->first()->course_id}}">                       
                             {{$item->getCourse()->get()->first()->name}}
                        </a></span>
                        @endif                        
                      </div>
                      <div class="content">
                        <?php 
                            echo $item->comment;
                        ?>
                      </div>
                      <div class="date">
                        <?php 
                            echo date("H:i d/m/Y",strtotime($item->created_at));
                        ?></div>
                      <div class="btn-group">
                          <a href="" class="btn-number"><i class="fa fa-comment"></i>0 Trả lời</a>
                          <a href="" class="btn btn-view">Xem</a>
                      </div>
                    </div>
                    
                  </div>
                </figure> <!-- / item -->
                @endforeach
              </div>
                <nav class="c-navigation">
                    <div class="container">
                    {{$comment->links()}}
                    </div>
                </nav> <!-- / navigation -->  
            </section>
          </div> <!-- / col-9 -->
        </div>
      </div> <!-- / container -->
    </main> <!-- / main -->

@endsection
