<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div>
  <div>
    <div style="margin:0;padding:0;background-color: #fff">
      <table border="0" cellpadding="0" cellspacing="0" style="min-width:348px;height: 100%;width: 100%">
        <tbody>
        <tr style="height: 32px"></tr>
        <tr align="center">
          <td>
            <table border="0" cellpadding="0" cellspacing="0" style="padding-bottom:20px;max-width:600px;min-width:220px">
              <tbody>
              <tr>
                <td>
                  <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                      <td></td>
                      <td>
                        <table border="0" cellpadding="0" cellspacing="0" style="direction:ltr;padding-bottom:7px" width="100%">
                          <tbody>
                          <tr>
                            <td align="center">
                              <img height="32" src="{{asset('frontend/img/logo/Eids.png')}}" style="height:32px">
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <td height="5" width="6"
                          style="background:url('{{asset('email/conner/conner-dot-tl.png')}}') top left no-repeat"
                      ></td>
                      <td height="5"
                          style="background:url('{{asset('email/conner/conner-dot-t.png')}}') top center repeat-x"
                      ></td>
                      <td height="5" width="6"
                          style="background:url('{{asset('email/conner/conner-dot-tr.png')}}') top right no-repeat"
                      ></td>
                    </tr>
                    <tr>
                      <td style="background:url('{{asset('email/conner/conner-dot-l.png')}}') center left repeat-y"
                          width="6"></td>
                      <td>
                        <div
                            style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;padding:40px 20px 38px 20px;border-bottom:thin solid #f0f0f0;color:rgba(0,0,0,0.87);font-size:24px;text-align:center;word-break:break-word">
                          <div>Kích hoạt đăng kí tài khoản của bạn</div>
                        </div>
                        <div
                            style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:1.6;padding:24px 20px 32px 20px;">
                          <div style="padding: 0 30px">
                            <div style="margin-bottom: 5px;">Xin chào <b>{{$name}}</b></div>
                            Tài khoản của bạn vừa được đăng ký. Bạn nhận được email này vì chúng tôi muốn đảm bảo rằng đó chính là bạn.
                            <div style="padding-top:24px;text-align:center"><a
                                  href="#"
                                  style="display:inline-block;text-decoration:none" target="_blank">
                                <table border="0" cellpadding="0" cellspacing="0" style="background-color:#4184f3;border-radius:2px;min-width:90px">
                                  <tbody>
                                  <tr style="height:6px"></tr>
                                  <tr>
                                    <td style="padding-left:8px;padding-right:8px;text-align:center">
                                      <a href="{{route('f.register-active', $token) . '?site=' . $site}}"
                                         style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:#ffffff;font-weight:400;line-height:20px;text-decoration:none;font-size:13px"
                                         target="_blank">KÍCH HOẠT TÀI KHOẢN</a></td>
                                  </tr>
                                  <tr style="height:6px"></tr>
                                  </tbody>
                                </table>
                              </a></div>
                          </div>
                        </div>
                      </td>
                      <td
                          style="background:url('{{asset('email/conner/conner-dot-r.png')}}') center left repeat-y"
                          width="6">
                        <div></div>
                      </td>
                    </tr>
                    <tr>
                      <td height="5" width="6"
                          style="background:url('{{asset('email/conner/conner-dot-bl.png')}}') top left no-repeat"
                      ></td>
                      <td height="5" width="6"
                          style="background:url('{{asset('email/conner/conner-dot-b.png')}}') top center repeat-x"
                      ></td>
                      <td height="5" width="6"
                          style="background:url('{{asset('email/conner/conner-dot-br.png')}}') top left no-repeat"
                      ></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
                        <div style="text-align:left">
                          <div
                              style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:12px;line-height:20px;padding-top:10px">
                            <div>Email này là để thông báo cho bạn biết về những thay đổi quan trọng đối với Tài khoản Eids và dịch vụ của bạn.</div>
                            <div style="direction:ltr">&copy; 2018 Eids.<a
                                  style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:12px;line-height:20px;padding-top:10px">
                                Tầng 4, tòa nhà 25T1, đường Hoàng Đạo Thúy, phường Trung Hòa, quận Cầu Giấy, TP. Hà Nội</a>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td></td>
                    </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <tr style="height: 32px"></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
