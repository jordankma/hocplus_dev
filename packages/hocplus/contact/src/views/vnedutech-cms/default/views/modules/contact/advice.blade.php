	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
        </script>
	<script type="text/javascript">
        $(document).ready(function () {
			
		 $('#ajaxBtn').click(function(){
			var name = $('#name').val();
                        var phone = $('#phone').val();
                        var lop =  $('#class').val();
                        var mon = $('#subject').val();
                        var link = $('#link_facebook').val();
                        if (name == '') {
                            alert('Hãy nhập vào tên của bạn.');
                            return false;
                        }
                        if (phone == '') {
                            alert('Hãy nhập vào số điện thoại của bạn.');
                            return false;
                        }
                        
			$.ajax('/contact/submit', {
				type: 'POST',  // http method
				data: { 
                                    name: name, 
                                    phone: phone,
                                    link_facebook: link,
                                    class: lop,
                                    subject: mon
                                },  // data to submit
				success: function (data, status, xhr) {
					$('p').html('Cảm ơn bạn đã gửi thông tin, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!');
				},
				error: function (jqXhr, textStatus, errorMessage) {
                                        $('p').append('Error: ' + errorMessage);
				}
			});
		});
    });
    </script>

<div class="c-advisory js-advisory">
   <div class="exit"></div>
   <div class="inner">
     <form method="post" action="/contact/submit">
       <div class="title">Tư vấn online</div>
       <div class="form-group">
         <input class="form-control" name="name" id="name" placeholder="Họ và tên">
         <span class="star">*</span>
       </div>
       <div class="form-group">
         <input class="form-control" name="phone" id="phone" placeholder="Số điện thoại">
         <span class="star">*</span>
       </div>
       <div class="form-group">
         <select name="class" id="class" class="form-control">
           <option value="" selected="true">Lớp</option>
           @foreach ($classes as $item)
           <option value="{{$item->name}}">{{$item->name}}</option>
           @endforeach
         </select>
         <span class="star">*</span>
       </div>
       <div class="form-group">
         <select name="subject" id="subject" class="form-control">
           <option value="" selected="true">Môn học</option>
           @foreach ($subjects as $item)
           <option value="{{$item->name}}">{{$item->name}}</option>
           @endforeach
         </select>
         <span class="star">*</span>
       </div>
       <div class="form-group">
         <input class="form-control" type="text" name="link_facebook" id="link_facebook" placeholder="Link facebook">
       </div>
 	<p>
	</p>      
       <button class="btn" id="ajaxBtn" type="button">Đăng ký tư vấn</button>
     </form>
   </div>
 </div> <!-- / advisory -->
 