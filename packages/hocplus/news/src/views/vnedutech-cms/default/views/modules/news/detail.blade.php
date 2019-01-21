@extends('HOCPLUS-NEWS::modules.news.master')

@section('title')
  @if ($news)
    {{$news->title}}
  @endif
@endsection

@section('content')
    <main class="main">

      <nav class="c-breadcrumb">
        <div class="container">
          <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/news">Tin tức</a></li>
            @if ($news)
                <li class="breadcrumb-item active">{{$news->title}}</li>
            @endif
          </ol>
        </div>
      </nav> <!-- / breadcrumb -->

      <div class="container container-main">
        <div class="row row-main">

          <div class="col-12 col-lg-9 main-left">
            @if ($news)
            <div class="c-detail news">
              <div class="headline">
                <h1 class="title">{{$news->title}}</h1>
              </div> <!-- / headline -->
              <div class="info">
                <div class="copyright-date">
                  <span class="copyright">{{$news->create_by}} - </span>
                  <span class="date">{{date("d/m/Y",strtotime($news->updated_at))}}</span>
                </div>
                <div class="view-commit">
                  <span class="view"><i class="fa fa-eye"></i> {{$news->views}}</span>
                  <span class="commit"><i class="fa fa-comment"></i> {{count($comments)}}</span>
                </div>
              </div> <!-- / info -->
              <div class="media">
                <img src="{{$news->image}}" width="100%" alt="">
              </div> <!-- / media -->
              <div class="content">
                <?php echo $news->content; ?>
              </div> <!-- / content -->
              
              <!-- Go to www.addthis.com/dashboard to customize your tools -->
              <div class="addthis_inline_share_toolbox_8swg"></div>
              <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c0e409afa177bdd"></script>
              <!-- / end -->
              @if ($news)
              <?php $tags = json_decode($news->news_tag); ?>
              <div class="tags">
                @if ($tags)
                    @foreach ($tags as $tag)
                        <a href="/news/tags/{{$tag->name}}" class="tag-item">{{$tag->name}}</a>
                    @endforeach
                @endif
              </div> <!-- / tag -->
              @endif
              <div class="form-commit">
                <div class="title">Bình luận</div>
                <p>Địa chỉ Email của bạn sẽ không được công khai.</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif                
                <form class="row form" method="post" action="/comments">
                  <div class="col-12 col-md-6 form-group">
                    <input type="text" name="name" class="form-control" placeholder="Họ tên">
                  </div>
                  <div class="col-12 col-md-6 form-group">
                    <input type="text" name="email" class="form-control" placeholder="Địa chỉ email">
                  </div>
                  <div class="col-12 form-group">
                    <textarea class="form-control" rows="8" name="comment" placeholder="Bình luận"></textarea>
                  </div>
                    <input type="hidden" name="news_id" value="{{$news->news_id}}">
                  <div class="col-12 submit">
                    <div class="inner">
                      <button type="submit" class="btn btn-red">Đăng</button>
                    </div>
                  </div>
                </form>
              </div> <!-- / form commit -->
              @if (count($comments)>0)
              <div class="user-commit">
                <ol class="list">
                  <li class="item">
                    @if (count($comments)==1)
                        @foreach ($comments as $item)
                        <div class="item-inner">
                          <div class="info">
                            <div class="top">
                              <div class="name-date">
                                <span class="name"><b>{{$item->getUser()}}</b></span> - <span class="date">{{date("H:i d/m/Y",strtotime($item->updated_at))}}</span>
                              </div>
                            </div>
                            <div class="content">
                              {{$item->comment}}
                            </div>
                            <span class="prefer"><i class="fa fa-thumbs"></i> <span>2 Thích</span></span>
                            <span class="comments"><i class="fa fa-comments"></i> <span>1 Trả lời</span></span>
                          </div>
                        </div>
                        @endforeach
                    @else 
                        <div class="item-inner">
                          <div class="info">
                            <div class="top">
                              <div class="name-date">
                                <span class="name"><b>{{$comments[0]->getUser()}}</b></span> - <span class="date">{{date("H:i d/m/Y",strtotime($comments[0]->updated_at))}}</span>
                              </div>
                            </div>
                            <div class="content">
                              {{$comments[0]->comment}}
                            </div>
                            <span class="prefer"><i class="fa fa-thumbs"></i> <span>2 Thích</span></span>
                            <span class="comments"><i class="fa fa-comments"></i> <span>1 Trả lời</span></span>
                          </div>
                        </div>                    
                    <ol class="list">
                    @foreach ($comments as $key => $item)
                    @if ($key == 0)
                        @continue
                    @endif
                      <li class="item">
                        <div class="item-inner">
                          <div class="info">
                            <div class="top">
                              <div class="name-date">
                                <span class="name"><b>{{$item->getUser()}}</b></span> - <span class="date">{{date("H:i d/m/Y",strtotime($item->updated_at))}}</span>
                              </div>
                            </div>
                            <div class="content">
                                {{$item->comment}}
                            </div>
                            <span class="prefer"><i class="fa fa-thumbs"></i> <span>2 Thích</span></span>
                          </div>
                        </div>
                      </li>                   
                    @endforeach
                    </ol>
                    @endif
                  </li>
                </ol>
              </div> <!-- / user commit -->
              @endif
            </div>
            @endif
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