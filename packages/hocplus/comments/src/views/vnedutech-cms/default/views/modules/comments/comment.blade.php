<div class="form-commit">
  <div class="title">Bình luận</div>
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
    <div class="col-12 form-group">
      <textarea class="form-control" rows="8" name="comment" id="comment" placeholder="Bình luận"></textarea>
    </div>
      @if (isset($type))     
      <input type="hidden" name="course_id" id="course_id" value="{{$id}}">
      @else
      <input type="hidden" name="news_id" id="news_id" value="{{$news->news_id}}">
      @endif
    <div class="col-12 submit">
      <div class="inner">
        <button type="button" class="btn btn-red" class="submit">Đăng</button>
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
              <div class="avatar">
                <div class="img">
                  <img src="{{config('site.url_static').$item->getUser()->avatar}}" alt="">
                </div>
              </div>
            <div class="info">
              <div class="top">
                <div class="name-date">
                  <span class="name"><b>{{$item->getUser()->name}}</b></span> - <span class="date">{{date("H:i d/m/Y",strtotime($item->updated_at))}}</span>
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
            <div class="avatar">
              <div class="img">
                <img src="{{config('site.url_static').$comments[0]->getUser()->avatar}}" alt="">
              </div>
            </div>              
            <div class="info">
              <div class="top">
                <div class="name-date">
                  <span class="name"><b>{{$comments[0]->getUser()->name}}</b></span> - <span class="date">{{date("H:i d/m/Y",strtotime($comments[0]->updated_at))}}</span>
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
                  <span class="name"><b>{{$item->getUser()->name}}</b></span> - <span class="date">{{date("H:i d/m/Y",strtotime($item->updated_at))}}</span>
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
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var comment;
        var course_id;
        $('.submit').click(function(){
            //alert('test');
            comment = $('#comment').val(); 
            course_id = $('#course_id').val();
            if (comment == '') {
                alert('Bạn hãy nhập vào bình luận');
            }
            else {
                $.ajax('/comments', {
                        type: 'POST',  // http method
                        data: { 
                            comment: comment, 
                            news_id: <?php if (isset($news_id)) echo $news_id;?>,
                            user_id: <?php if (isset($user_id)) echo $user_id;?>,
                            course_id: course_id,
                        },  // data to submit
                        success: function (data, status, xhr) {
                            if (data == 0) {
                                alert('Yêu cầu bạn phải đăng nhập');
                            }
                            if (data == 1) {
                                alert('Bình luận đã được gửi thành công và đang chờ duyệt');
                            }
                        },
                        error: function (jqXhr, textStatus, errorMessage) {
                                //$('p').append('Error: ' + errorMessage);
                        }
                });  
            }
        });
    });
</script>