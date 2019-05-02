@extends('HOCPLUS-NEWS::modules.news.master')

@section('title', 'Tin tức')

@section('content')
    <main class="main">

      <nav class="c-breadcrumb">
        <div class="container">
          <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active">Tin tức</li>
          </ol>
        </div>
      </nav> <!-- / breadcrumb -->

      <section class="c-featured-news">
        <div class="container">
          <div class="row">
            @if ($hotnews)
            <figure class="col-12 col-lg-6 item c-item-news">
              <div class="inner">
                <div class="img">
                  <a href="news/detail/{{$hotnews->news_id}}-{{$hotnews->title_alias}}"><img src="{{$hotnews->image}}" alt=""></a>
                </div>
                <div class="info">
                  <h2 class="title"><a href="news/detail/{{$hotnews->news_id}}-{{$hotnews->title_alias}}">{{$hotnews->title}}</a></h2>
                  <div class="description">{{$hotnews->desc}}</div>
                </div>
              </div>
            </figure> <!-- / item -->
            @endif
            <div class="col-12 col-lg-6 group-item">
              <div class="row">
                @if ($features)
                    @foreach ($features as $item) 
                    <figure class="col-6 item c-item-news">
                      <div class="inner">
                        <div class="img">
                          <a href="news/detail/{{$item->news_id}}-{{$item->title_alias}}"><img src="{{$item->image}}" alt=""></a>
                        </div>
                        <div class="info">
                            <h3 class="title"><a href="news/detail/{{$item->news_id}}-{{$item->title_alias}}../">{{$item->title}}</a></h3>
                        </div>
                      </div>
                    </figure> <!-- / item -->
                    @endforeach
                @endif
              </div>
            </div>
          </div>

        </div>
      </section> <!-- / featured news -->

      <div class="container container-main">
        <div class="row row-main">

          <div class="col-12 col-lg-9 main-left">

            <div class="group-item">
              @foreach ($news as $item)
              <figure class="item c-item-news-01">
                <div class="inner">
                  <div class="img">
                    <a href="/news/detail/{{$item->news_id}}-{{$item->title_alias}}"><img src="{{$item->image}}" alt=""></a>
                  </div>
                  <div class="info">
                    <h3 class="title"><a href="/news/detail/{{$item->news_id}}-{{$item->title_alias}}">{{$item->title}}</a></h3>
                    <div class="description">{{$item->desc}}</div>
                    <a href="/news/detail/{{$item->news_id}}-{{$item->title_alias}}" class="btn">Chi tiết <i class="fa fa-angle-double-right"></i></a>
                  </div>
                </div>
              </figure> <!-- / item -->
              @endforeach
            </div>
            <nav class="c-navigation">
                <div class="container">
                {{$news->links()}}
                </div>
            </nav>
          </div> <!-- / main left -->

          <div class="col-12 col-lg-3 main-right">

            <div class="c-new-letter">
              <h3 class="title">Đăng ký nhận tin</h3>
              <div class="text">Đã có hơn 10.000+ học sinh đăng ký</div>
              <form class="form" method="post" action="/newsletter" id="newsletter">
                <div class="form-group">
                  <input type="text" class="form-control" id="InputName" name="name" placeholder="Tên của bạn">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="InputEmail" name="email" placeholder="Địa chỉ email">
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Nhận tin theo tháng</label>
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck2">
                  <label class="form-check-label" for="exampleCheck2">Nhận tin theo tuần</label>
                </div>
                <button type="button" class="btn btn-red" id="register">Đăng ký</button>
              </form>
            </div> <!-- / new letter -->

            <div class="c-follow">
              <h3 class="title">Theo dõi chúng tôi</h3>
              <div class="group-item">
                <div class="item">
                  <span class="icon mail"><i class="fa fa-envelope"></i></span>
                  <span class="text">Theo dõi</span>
                  <span class="number">146,225</span>
                </div>
                <div class="item">
                  <span class="icon facebook"><i class="fa fa-facebook"></i></span>
                  <span class="text">Fans</span>
                  <span class="number">19,7259</span>
                </div>
                <div class="item">
                  <span class="icon twitter"><i class="fa fa-twitter"></i></span>
                  <span class="text">Followers</span>
                  <span class="number">145,668</span>
                </div>
              </div>
            </div> <!-- / follow -->

            <div class="c-news-block">
              <h3 class="title">Tin xem nhiều</h3>
              <div class="group-item">
                @foreach ($topnews as $item) 
                <figure class="item">
                  <div class="inner">
                    <div class="img">
                      <a href="/news/detail/{{$item->news_id}}-{{$item->title_alias}}"><img src="{{$item->image}}" alt=""></a>
                    </div>
                    <div class="info">
                      <h4 class="title"><a href="/news/detail/{{$item->news_id}}-{{$item->title_alias}}">{{$item->title}}</a></h4>
                    </div>
                  </div>
                </figure> <!-- / item -->
                @endforeach
              </div>
            </div> <!-- / news block -->


          </div> <!-- / main right -->

        </div> <!-- / row -->
      </div> <!-- / container -->



    </main>
@endsection
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#register').click(function(){
           var name = $('#InputName').val();       
           if (name == '') {
               alert('Nhập vào tên'); 
               return false;
           }
           var email = $('#InputEmail').val();
           if (email == '') {
               alert('Nhập vào email'); 
               return false;

           }
           if (IsEmail(email) == false) {
               alert('Email không đúng');
               return false;
           }
           $('#newsletter').submit();
        });
        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(email)) {
              return false;
            }   
            else    
            {
              return true;
            }
        }
    });
</script>