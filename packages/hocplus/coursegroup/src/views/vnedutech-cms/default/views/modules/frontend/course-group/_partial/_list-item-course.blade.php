@if(!empty($listCourse))
<section class="row section list-item-course">
    @foreach($listCourse as $course)
        @include('HOCPLUS-COURSEGROUP::modules.frontend.course._partial._item_course',[
            'course' => $course,
            'figure_class' => 'col-12 col-md-6 col-lg-4 c-item-course'
        ])   
    @endforeach
</section> <!-- / list item-course -->
<nav class="c-navigation">
    <div class="container">
        {{ $listCourse->appends($params)->links() }}
    </div>
</nav> <!-- / navigation -->
@else 
    <p>HIỆN CHƯA CÓ KHÓA HỌC</p>
@endif