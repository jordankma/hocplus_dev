@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ 'Khởi tạo khóa học' }}@stop

{{-- page level styles --}}
@section('header_styles')

@stop

{{-- Page content --}}
@section('content')
    <main class="main ml-main">

        <div class="container">
            <div class="row">

                <div class="col-12 col-md-4 col-lg-3 ml-left">
                    @include('HOCPLUS-TEACHERFRONTEND::modules.frontend._partial.profileteacher._ml-info')
                </div> <!-- / col-3 -->

                <div class="col-12 col-md-8 col-lg-9 ml-right">
                    <section class="ml-template">
                        <div class="headline">
                            <h2 class="title">Khởi tạo khóa học</h2>
                            <div class="steps">
                                <ul class="steps-nav">
                                    <li class="steps-nav__item active">
                                        <a href="quan-ly-khoi-tao-khoa-hoc.html">
                                            <span class="number">1</span>
                                            <span class="title">Bước 1: Thông tin chung</span>
                                        </a>
                                    </li>
                                    <li class="steps-nav__item">
                                        <a href="quan-ly-mo-ta-chi-tiet.html">
                                            <span class="number">2</span>
                                            <span class="title">Bước 2: Mô tả chi tiết</span>
                                        </a>
                                    </li>
                                    <li class="steps-nav__item">
                                        <a href="quan-ly-xem-lai-khoa-hoc.html">
                                            <span class="number">3</span>
                                            <span class="title">Bước 3: Xem lại khóa học</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="setting js-setting">
                            <div class="headline">
                                <h3 class="title">Lựa chọn template khóa học</h3>
                            </div>
                            <ul class="menu">
                                <li class="menu-active" data-choose="#template-available">Chọn template khóa học</li>
                                <li data-choose="#template-new">Tạo template mới</li>
                            </ul>
                            <div class="template-available template-active" id="template-available">
                                <div class="group">
                                    <div class="row">
                                        <figure class="col-6 col-md-3 item">
                                            <div class="inner">
                                                <div class="img">
                                                    <div class="wrapper">
                                                        <span><img src="images/c1.png" alt=""></span>
                                                    </div>
                                                </div>
                                                <div class="info">
                                                    <h3 class="title">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 - Môn Sinh</h3>
                                                </div>
                                            </div>
                                        </figure> <!-- / item -->
                                        <figure class="col-6 col-md-3 item">
                                            <div class="inner">
                                                <div class="img">
                                                    <div class="wrapper">
                                                        <span><img src="images/c1.png" alt=""></span>
                                                    </div>
                                                </div>
                                                <div class="info">
                                                    <h3 class="title">Khóa học bồi dưỡng học sinh giỏi lớp 2</h3>
                                                </div>
                                            </div>
                                        </figure> <!-- / item -->
                                        <figure class="col-6 col-md-3 item">
                                            <div class="inner">
                                                <div class="img">
                                                    <div class="wrapper">
                                                        <span><img src="images/c1.png" alt=""></span>
                                                    </div>
                                                </div>
                                                <div class="info">
                                                    <h3 class="title">Khóa học bồi dưỡng học sinh giỏi lớp 10, 11, 12 - Môn Sinh</h3>
                                                </div>
                                            </div>
                                        </figure> <!-- / item -->
                                        <figure class="col-6 col-md-3 item">
                                            <div class="inner">
                                                <div class="img">
                                                    <div class="wrapper">
                                                        <span><img src="images/c1.png" alt=""></span>
                                                    </div>
                                                </div>
                                                <div class="info">
                                                    <h3 class="title">Khóa học bồi dưỡng học sinh giỏi lớp 2</h3>
                                                </div>
                                            </div>
                                        </figure> <!-- / item -->
                                    </div>
                                </div>
                                <a href="quan-ly-mo-ta-chi-tiet.html" class="btn btn-next">Tiếp theo <i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <div class="template-new" id="template-new">
                                <div class="all">
                                    <div class="grid form-group">
                                        <div class="grid-left">
                                            <label for="exampleInputTemplateName">Tên khóa học *</label>
                                        </div>
                                        <div class="grid-right">
                                            <input class="form-control" type="text" id="exampleInputTemplateName" name="exampleInputTemplateName" placeholder="VD: Khóa học bồi dưỡng học sinh giỏi lớp 12 - Môn Sinh">
                                        </div>
                                    </div>
                                    <div class="grid form-group">
                                        <div class="grid-left">
                                            <label for="exampleInputTemplateCategories">Chuyên mục *</label>
                                        </div>
                                        <div class="grid-right">
                                            <div class="grid">
                                                <div class="grid-50">
                                                    <select class="form-control" id="exampleInputTemplateCategoriesSpecies" name="exampleInputTemplateCategoriesSpecies">
                                                        <option selected="true" disabled="disabled">Môn học</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                                <div class="grid-50">
                                                    <select class="form-control" id="exampleInputTemplateCategoriesClass" name="exampleInputTemplateCategoriesClass">
                                                        <option selected="true" disabled="disabled">Lớp học</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="grid form-group">
                                        <div class="grid-left">
                                            <label for="exampleInputTemplateSession">Số buổi học *</label>
                                        </div>
                                        <div class="grid-right">
                                            <input class="form-control" type="text" id="exampleInputTemplateSession" name="exampleInputTemplateSession" placeholder="Số buổi học trong khóa học">
                                        </div>
                                    </div>
                                    <div class="grid form-group">
                                        <div class="grid-left">
                                            <label for="exampleInputTemplateSessionNumber">Thời lượng buổi học *</label>
                                        </div>
                                        <div class="grid-right">
                                            <input class="form-control" type="text" id="exampleInputTemplateSessionNumber" name="exampleInputTemplateSessionNumber" placeholder="Tổng số phút trong mỗi buổi học">
                                        </div>
                                    </div>
                                    <div class="grid form-group">
                                        <div class="grid-left">
                                            <label for="exampleInputTemplateMedia">Ảnh hoặc Video đại diện</label>
                                        </div>
                                        <div class="grid-right">
                                            <div class="form-control-input-media">
                                                <div class="show-media">
                                                    <div class="img">
                                                        <img src="src/images/logo-all.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="btn-input">
                                                    <span><i class="fa fa-camera-retro"></i>Thay ảnh đại diện</span>
                                                    <input id="exampleInputTemplateMediaImage" name="exampleInputTemplateMediaImage" type="file" accept="image/*">
                                                </div>
                                            </div>
                                            <span class="form-text"><i>Kích thước tối thiểu: 750 * 400</i></span>
                                            <input class="form-control form-control-video" type="text" id="exampleInputTemplateMediaVideo" name="exampleInputTemplateMediaVideo" placeholder="Hoặc nhập URL video VD: https://www.youtube.com/watch?v=qcIfT7V0RT0">
                                        </div>
                                    </div>
                                    <div class="grid form-group">
                                        <div class="grid-left">
                                            <label for="exampleInputTemplateDescription">Mô tả ngắn gọn</label>
                                        </div>
                                        <div class="grid-right">
                                            <textarea class="form-control" rows="6" type="text" id="exampleInputTemplateDescription" name="exampleInputTemplateDescription" placeholder="Ví dụ: Mọi kiến thức căn bản về tiếng anh lớp 10 v.v... (Tối đa 100 ký tự)"></textarea>
                                        </div>
                                    </div>
                                    <div class="grid form-group">
                                        <div class="grid-left">
                                            <label for="exampleInputTemplatekKeyWord">Từ khóa</label>
                                        </div>
                                        <div class="grid-right">
                                            <input class="form-control" type="text" id="exampleInputTemplatekKeyWord" name="exampleInputTemplatekKeyWord" placeholder="VD: Môn anh, tiếng anh, học sinh giỏi">
                                        </div>
                                    </div>
                                    <div class="grid form-group">
                                        <div class="grid-left">
                                            <label for="exampleInputTemplateResult">Bạn sẽ được học *</label>
                                        </div>
                                        <div class="grid-right">
                                            <textarea class="form-control" rows="6" id="exampleInputTemplateResult" name="exampleInputTemplateResult"></textarea>
                                        </div>
                                    </div>
                                    <div class="grid form-group">
                                        <div class="grid-left">
                                            <label for="exampleInputTemplateTarget">Mục tiêu khóa học *</label>
                                        </div>
                                        <div class="grid-right">
                                            <textarea class="form-control" rows="6" id="exampleInputTemplateTarget" name="exampleInputTemplateTarget"></textarea>
                                        </div>
                                    </div>
                                    <div class="grid form-group">
                                        <div class="grid-left">
                                            <label for="exampleInputTemplateRequest">Yêu cầu khóa học *</label>
                                        </div>
                                        <div class="grid-right">
                                            <textarea class="form-control" rows="6" id="exampleInputTemplateRequest" name="exampleInputTemplateRequest"></textarea >
                                        </div>
                                    </div>
                                </div>
                                <div class="posts">
                                    <div class="posts-headline">
                                        <div class="title">Nội dung buổi học</div>
                                    </div>
                                    <div class="posts-inner">
                                        <div class="posts-list"></div>
                                    </div>
                                </div>
                                <a href="quan-ly-mo-ta-chi-tiet.html" class="btn btn-next">Tiếp theo <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </section>
                </div> <!-- / col-9 -->

            </div>

        </div> <!-- / container -->

    </main> <!-- / main -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
