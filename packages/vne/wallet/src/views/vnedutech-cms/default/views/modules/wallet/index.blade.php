@extends('HOCPLUS-FRONTEND::layouts.frontend')

{{-- Page title --}}
@section('title'){{ "Quản lý ví" }}@stop

{{-- page level styles --}}
@section('header_styles')
{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"> --}}
@stop

{{-- Page content --}}
@section('content')   
<main class="main ms-main">

<div class="container">
      <div class="row">
        @include('VNE-WALLET::modules.wallet.box_right')

        <div class="col-12 col-md-8 col-lg-9 ms-right">
          <div class="ms-statistics">
            <section class="row money">
              <div class="col-12 col-lg-4 item">
                <div class="item-inner">
                  <div class="item-icon" style="background: #ea3e4e;">
                    <img src="images/icon/general-2.png" alt="">
                  </div>
                  <div class="item-info">
                  <div class="number" style="color: #ea3e4e;">{{number_format($deposit->deposit, 0, ',', '.')}}<span>đ</span></div>
                    <div class="name">Ví tiền hiện có</div>
                  </div>
                </div>
              </div> <!-- / item -->
              <div class="col-12 col-lg-4 item">
                <div class="item-inner">
                  <div class="item-icon" style="background: #45b949;">
                    <img src="images/icon/general-3.png" alt="">
                  </div>
                  <div class="item-info">
                    <div class="number" style="color: #45b949">{{number_format($deposit->deposit_rechange, 0, ',', '.')}}<span>đ</span></div>
                    <div class="name">Số tiền đã nạp</div>
                  </div>
                </div>
              </div> <!-- / item -->
            </section> <!-- / money -->

            <div class="history">
              <div class="headline">
                <h3 class="title">Lịch sử giao dịch</h3>
                <a href="quan-ly-hoc-sinh-nap-tien.html" class="btn">Nạp tiền</a>
              </div>
              <form class="form-search">
                <div class="form-group">
                  <select class="form-control">
                    <option selected="true" disabled="disabled">Môn học</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" id="exampleInputPassword1" placeholder="Từ ngày">
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" id="exampleInputPassword1" placeholder="Đến ngày">
                </div>
                <div class="form-group">
                  <select class="form-control">
                    <option selected="true" disabled="disabled">Tình trạng</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
                <div class="form-group search">
                  <input class="form-control" type="search" placeholder="Từ khóa">
                  <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                </div>
              </form>
              <div class="list">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Ngày</th>
                        <th scope="col">Khóa học</th>                                                                          
                        <th scope="col">Hình thức thanh toán</th>
                        <th scope="col">Kiểu</th>
                        <th scope="col">Số tiền</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions->items() as $key => $val)
                            <tr>
                            <th scope="row">{{$key = $key + 1 }}</th>
                                <td>
                                <div class="date">{{date("d-m-Y H:i:s", strtotime($val->created_at))}}</div>
                                </td>
                                <td>
                                    
                                    @if(!empty($val->course_id))
                                        <div class="title">
                                        <a href="{{URL::to('khoa-hoc', $val->course_id)}}">{{$val->isCourse->name}}</a>
                                        </div>
                                    @endif                                    
                                </td>
                                <td>
                                    @if($val->method == 'cod')
                                        <div class="class">Cod</div>
                                    @elseif($val->method == 'card')
                                        <div class="class">Thẻ cào</div>    
                                    @elseif($val->method == 'transfer')
                                        <div class="class">Chuyển khoản</div>    
                                    @elseif($val->method == 'ebanking')
                                        <div class="class">Internet banking</div>
                                    @else
                                        <div class="class">Ví</div>    
                                    @endif                                    
                                </td>
                                <td>
                                    @if($val->type == 'in')
                                        <div class="class">Nạp tiền</div>
                                    @else
                                        <div class="class">Mua khóa học</div>                                           
                                    @endif                                    
                                </td>
                                <td>
                                    <div class="price">{{number_format($val->money_payment, 0, ',', '.')}}<span>đ</span></div>
                                </td>
                            </tr>
                        @endforeach
                                            
                    </tbody>
                  </table>
                </div>

                <nav class="c-navigation">
                  <div class="container">
                    {{ $transactions->links('VNE-WALLET::modules.wallet.pagination') }}
                  </div>
                </nav> <!-- / navigation -->
              </div>
            </div> <!-- / history -->

          </div> <!-- / statistics -->
        </div> <!-- / col-9 -->
      </div>
    </div> <!-- / container -->
  </main> <!-- / main -->
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    
@stop
