@if(!empty($list_teacher))
<section class="section c-about-lecturers">
    <div class="container">
      <div class="headline">
        <h2 class="title">Câu chuyện thành công của giáo viên</h2>
      </div>
      <div class="group js-about-lecturers">
        @foreach($list_teacher as $key => $value)
        <figure class="item">
          <div class="row inner">
            <div class="col-12 col-md-6 col-lg-5 img">
              <div class="img-inner">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
                <div class="img-wrapper">
                <a href="{{ route('home.teacher.detail',$value->teacher_id . '-' . $value->alias) }}">
                  <img src="{{ ($value->avatar_index != '' || file_exists(substr($value->avatar_index, 1)))  ? config('site.url_static') . $value->avatar_index : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/user.png' }}" alt="">
                </a>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7 info">
              <h3 class="name">{{ $value->name }}</h3>
              <div class="position">{{ $value->workplace }}</div>
              <div class="description">
                  {!! $value->intro !!}
              </div>
              <a href="{{ route('home.teacher.detail',$value->teacher_id . '-' . $value->alias) }}" class="btn">Xem thông tin giảng viên</a>
            </div>
          </div>
        </figure> <!-- / item -->
        @endforeach
      </div>
    </div>
  </section> <!-- / about lecturers -->
  <a id="c-register-lecturers"></a>
@endif