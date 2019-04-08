<div class="c-advisory js-advisory">
   <div class="exit"></div>
   <div class="inner">
     <form method="post" action="/contact/submit">
       <div class="title">Tư vấn online</div>
       <div class="form-group">
         <input class="form-control" name="name" placeholder="Họ và tên">
         <span class="star">*</span>
       </div>
       <div class="form-group">
         <input class="form-control" name="phone" placeholder="Số điện thoại">
         <span class="star">*</span>
       </div>
       <div class="form-group">
         <select name="class" class="form-control">
           <option value="" selected="true">Lớp</option>
           @foreach ($classes as $item)
           <option value="{{$item->name}}">{{$item->name}}</option>
           @endforeach
         </select>
         <span class="star">*</span>
       </div>
       <div class="form-group">
         <select name="subject" class="form-control">
           <option value="" selected="true">Môn học</option>
           @foreach ($subjects as $item)
           <option value="{{$item->name}}">{{$item->name}}</option>
           @endforeach
         </select>
         <span class="star">*</span>
       </div>
       <div class="form-group">
         <input class="form-control" type="text" name="link_facebook" placeholder="Link facebook">
       </div>
       <button class="btn" type="submit">Đăng ký tư vấn</button>
     </form>
   </div>
 </div> <!-- / advisory -->