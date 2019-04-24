@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Nạp tiền" }}@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
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
<main class="main">

    <nav class="c-breadcrumb">
        <div class="container">
        <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Mua khóa học</a></li>
            <li class="breadcrumb-item"><a href="#">Thông tin thanh toán</a></li>
            <li class="breadcrumb-item"><a href="#">Xem lại đơn hàngn</a></li>
            <li class="breadcrumb-item active">Hoàn thành đơn hàng</li>
        </ol>
        </div>
    </nav> <!-- / breadcrumb -->

    <section class="pay-notification">
        <div class="container">
        <div class="wrapper">
            <div class="inner">
            <h2 class="title">Nạp tiền thành công</h2>
            <img src="{{asset('image/thanh-cong.png')}}" alt="">
            @if($method == 'transfer')
                <p>
                    Cảm ơn quý khách đã nạp tiền vào ví tại Học Plus. Số tiền nạp {{number_format($money_payment, 0, ',', '.')}}đ sẽ được cộng vào ví sau khi chúng tôi nhận được tiền, mã đơn hàng của
                    quý khách là:
                </p>
            @else
                <p>
                    Cảm ơn quý khách đã nạp tiền vào ví tại Học Plus. Số tiền nạp {{number_format($money_payment, 0, ',', '.')}}đ đã được cộng vào ví, mã đơn hàng của
                    quý khách là:
                </p>
            @endif
            
            <div style="font-size: 30px;font-weight: 700;color: #d2232f;">{{$order_code}}</div>
            <p>                
                Xin cảm ơn quý khách đã cho chúng tôi cơ hội đươc phục vụ. Mọi thắc mắc vui lòng liên hệ: <b style="font-size: 20px;font-weight: 700;color: #d2232f;">1900 636
                444</b>
            </p>
            </div>
        </div>
        <a class="btn" href="chi-tiet-khoa-hoc.html">Xem khóa học</a>
        </div>
    </section> <!-- / notification -->

</main>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
@stop
