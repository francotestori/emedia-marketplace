<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Documento sin título</title>
</head>
<body>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td bgcolor="#676767" style="background-color:#676767"><img src="{{asset('img/mail/logo.png')}}" width="257" height="58" alt="eMediaMarket" /></td>
    </tr>
    <tr>
        <td>
            <img src="{{asset('img/mail/reset-header.png')}}" width="600" height="287" alt="No hay de qué preocuparse" style="background-color:#29abe2; color:#fff; font-weight:3em; font-weight:800" />
        </td>
    </tr>
    <tr>
        <td height="356" align="center" bgcolor="#29abe1">
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236); font-weight: bold;">
                {{Lang::get('mail.reset.resetting')}}
                <br/>
                {{Lang::get('mail.reset.clicking')}}
                <a href="{{url(config('app.url').route('password.reset', $token, false))}}">
                    {{url(config('app.url').route('password.reset', $token, false))}}
                </a>
                <br />
                <br />
            </p>
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236);">
                {{Lang::get('mail.reset.remind')}}
                <span style="color:#000">{{$email}}</span>
            </p>
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236);">
                {{Lang::get('mail.reset.unrequested')}}
                <br />
                {{Lang::get('mail.reset.delete')}}
            </p>
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236); font-weight: bold;">
                {{Lang::get('mail.reset.enjoy')}}
            </p>
            <br />
            <table width="457" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="457" height="49" align="center" bgcolor="#f3e353" style="border-radius: 25px;background-color: rgb(243, 227, 83);">
                        <a href="{{url(config('app.url').route('password.reset', $token, false))}}" style="text-decoration:none; color:#000;font-size: 22px; font-family: Arial;
                           color: rgb(0, 0, 0); line-height: 1.2; text-transform:uppercase">
                            {{Lang::get('mail.reset.change')}}
                            <strong>{{Lang::get('mail.reset.password')}}</strong>
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="115" align="center">
            <p style="font-size: 14px; font-family: Arial;">
                {{Lang::get('mail.common.greeting')}}
                <br />
                {{Lang::get('mail.common.team')}}
            </p>
        </td>
    </tr>
    <tr>
        <td bgcolor="#676767" align="center"><img src="{{asset('img/mail/logo-footer.png')}}" width="136" height="31" alt="eMediaMarket" /></td>
    </tr>
</table>
</body>
</html>
