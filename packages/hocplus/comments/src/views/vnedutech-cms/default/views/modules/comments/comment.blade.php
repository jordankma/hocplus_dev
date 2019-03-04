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
      @if (isset($type))     
      <input type="hidden" name="course_id" value="{{$id}}">
      @else
      <input type="hidden" name="news_id" value="{{$news->news_id}}">
      @endif
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