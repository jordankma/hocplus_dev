@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Nạp tiền" }}@stop

{{-- page level styles --}}
@section('header_styles')
{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"> --}}
<style>
.online-pay{
    padding: 5px 10px 5px 38px;
}
.error{
    border-color: red !important;
}
input:focus{
    outline: none;
}
</style>
<script>
var urlVnpay = '{{route('vne.wallet.rechargeVnpay')}}';
var urlCard = '{{route('vne.wallet.card')}}';
var urlTransfer = '{{route('vne.wallet.transfer')}}';
</script>
@stop

{{-- Page content --}}
@section('content')   
<main class="main ms-main">
    <div class="container">
        <div class="row">
            @include('VNE-WALLET::modules.wallet.box_right')
            <div class="col-12 col-md-8 col-lg-9 ms-right">
                <div class="ms-recharge">
                    <h2 class="headline">Nạp tiền</h2>
                    <div class="value">
                        <input class="form-control" id="money_payment" type="number" placeholder="Số tiền muốn nạp">
                        <input class="form-control" id="method" value="{{$payMethods[0]['type']}}" type="hidden">
                    </div>
                    <section class="pay-pay js-pay">
                        <div class="pay-inner">
                            @foreach($payMethods as $i => $method)
                                @php
                                    $detail  = !empty($method['detail']) ?  json_decode($method['detail'], true) : [];
                                @endphp
                                @if($method['type'] == 'ebanking')
                                <div class="class {{ $i == 0 ? 'species-active' : ''}} " data-pay="#online-pay" data-type="{{$method['type']}}">
                                    <div class="status"></div>
                                    <div class="name">{{$method['name']}} </div>
                                    </div>
                                <div class="online-pay {{ $i == 0 ? 'pay-active' : ''}}" id="online-pay">
                                        {{isset($detail['content']) ? $detail['content'] : ''}}
                                    </div>
                                @elseif($method['type'] == 'transfer')
                                    <div class="class" data-pay="#bank" data-type="{{$method['type']}}">
                                        <div class="status"></div>
                                        <div class="name">{{$method['name']}}</div>
                                    </div>
                                    <div class="bank" id="bank">
                                        <div class="inner">
                                            <div class="headline">
                                                <div class="grid title"><span class="grid-1">Nội dung</span>Thanh toán đơn hàng #xxxxxxx</div>
                                                <div class="content">{{isset($detail['content']) ? $detail['content'] : '' }}</div>
                                            </div>
                                            <div class="grid title">
                                                <div class="grid-1"><b>Ngân hàng</b></div>
                                                <div class="grid-2"><b>Công ty cổ phần Dịch vụ Giáo dục Á Châu</b></div>
                                                <div class="grid-3"><b>Số tài khoản</b></div>
                                            </div>
                                            <ul class="list">
                                                @if(isset($detail['info']))
                                                    @if(!empty($detail['info']))
                                                        @foreach($detail['info'] as $i => $info)
                                                        <li class="grid item">
                                                            <div class="grid-1">
                                                                <div class="icon">
                                                                <img src="{{asset($info['img'])}}" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="grid-2">
                                                                <div class="name">{{$info['name']}}</div>
                                                            </div>
                                                            <div class="grid-3">
                                                                <div class="number">{{$info['account']}}</div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    @endif
                                                @endif                                                   
                                            </ul>
                                        </div>
                                    </div>
                                @elseif($method['type'] == 'card')
                                    <div class="class" data-pay="#bank-card" data-type="{{$method['type']}}">
                                        <div class="status"></div>
                                        <div class="name">{{$method['name']}}</div>
                                    </div>
                                    <div class="bank-card" id="bank-card">
                                        <div class="tabs">
                                            <div class="tabs-inner">
                                                <div class="tabs-item tabs-active" data-tab="#hocplus-card">
                                                    <div class="wrapper">
                                                        <div class="inner">
                                                            <img src="http://hocplus.vnedutech.vn/vendor/vnedutech-cms/default/hocplus/frontend/images/logo-pay.png" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form bank-card-active" id="hocplus-card">
                                            
                                                <div class="form-group">
                                                    <label for="cardCode">Mã thẻ cào Học Plus</label>
                                                    <input type="text" class="form-control" id="cardCode" placeholder="Nhập mã số thẻ cào">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cardSeri">Số Seri</label>
                                                    <input type="text" class="form-control" id="cardSeri" placeholder="Nhập Serial">
                                                </div>
                                                <div class="form-group">
                                                    <label for="captcha">Mã xác nhận</label>
                                                    <input type="text" class="form-control" id="captcha" placeholder="Nhập mã xác nhận">
                                                </div>
                                                <div class="form-group">
                                                    <label></label>
                                                    <span class="help-block" style="padding-right: 20px; color:red;">
                                                        <strong id="error_captcah"></strong>
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label></label>
                                                    <div class="form-control form-control-img">
                                                        <span id="img_captcha">{!! captcha_img() !!}</span>
                                                        <button type="button" class="btn btn-success btn-refresh"><i class="fas fa-sync-alt"></i></button>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div> <!-- / inner -->
                        <a href="javascript:void(0,0)" class="btn btn-recharge">Nạp tiền</a>
                    </section> <!-- / pay -->
                </div> <!-- / recharge -->
            </div> <!-- / col-9 -->
        </div>
    </div> <!-- / container -->
</main> <!-- / main -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ config('site.url_static') . '/vendor/' . $group_name . '/' . $skin . '/vendors/bootstrapvalidator/js/bootstrapValidator.min.js' }}" type="text/javascript"></script>
    <script>
    $('body').on('click', '.btn-recharge', function(){
        let method = $('#method').val();
        let money_payment = $("#money_payment").val();
        let url = urlVnpay;
        let card_seri = $("#cardSeri").val();
        let card_code = $("#cardCode").val();
        let captcha = $("#captcha").val();

        if(method === 'ebanking'){
            url = urlVnpay;
            if(isNaN(money_payment) || money_payment == '' || money_payment == 0){
                $("#money_payment").addClass('error');
                $('#money_payment').focus();
                return false;
            }
        }
        if(method === 'card'){
            url = urlCard;                       
            if(card_seri == '' || card_seri == null){
                $("#cardSeri").addClass('error');
                $('#cardSeri').focus();
                return false;
            }
            if(card_code == '' || card_code == null){
                $("#cardCode").addClass('error');
                $('#cardCode').focus();
                return false;
            }
            if(captcha == '' || captcha == null){
                $("#captcha").addClass('error');
                $('#captcha').focus();
                return false;
            }
        }
        
        if(method === 'transfer'){
            url = urlTransfer;
            if(isNaN(money_payment) || money_payment == '' || money_payment == 0){
                $("#money_payment").addClass('error');
                $('#money_payment').focus();
                return false;
            }
        }
       
        $.ajax({
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').prop('content')
            },
            type: 'POST',
            cache: false,
            data: {
                money_payment, card_seri, card_code, captcha
            },
            success: function (response) {
                console.log(response);
                if (response.status == true) {
                    if(method === 'ebanking'){
                        window.location.href = response.link;
                    }
                    if(method === 'card'){
                        window.location.href = response.link;
                    }
                    if(method === 'transfer'){
                        window.location.href = response.redirect;
                    }
                } else{
                    if(method === 'card'){
                        $("#img_captcha").html(response.captcha);
                        if(typeof(response.errors.captcha) != "undefined" && response.errors.captcha !== null ){
                            $("#error_captcah").text(response.errors.captcha[0]);
                        }
                        alert(response.msg);
                    }
                }
                
            }
        }, 'json');
    });

    $("#money_payment").keypress(function(){
        $("#money_payment").removeClass('error');
    });

    $("input").keypress(function(){
        $(this).removeClass('error');
    });

    $('body').on('click', '.class', function(){        
        $('#method').val($(this).attr('data-type'));
        let method = $('#method').val();
        if(method === 'card'){
            $("#money_payment").hide();
        } else {
            $("#money_payment").show();
        }
    });

    $(".btn-refresh").click(function(){
        $.ajax({
            type:'GET',
            url:'/wallet/refresh_captcha',
            success:function(data){
                $("#img_captcha").html(data.captcha);
            }
        });
    });

    
    </script>
@stop
