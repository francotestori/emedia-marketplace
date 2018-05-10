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
        <td><img src="{{asset('welcome-header.png')}}" width="600" height="288" alt="¡Bienvenido a Emedia Market!" style="background-color:#29abe2; color:#fff; font-weight:3em; font-weight:800" /></td>
    </tr>
    <tr>
        <td height="291" align="center" bgcolor="#29abe1">
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236); font-weight: bold;">
                {{Lang::get('mail.welcome.name', ['user' => $name])}}
                <br/>
                {{Lang::get('mail.welcome.thanks')}}
            </p>
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236);">
                <strong>{{Lang::get('mail.welcome.congratulations')}}</strong>
                <br/>
                {{Lang::get('mail.welcome.belong')}}
            </p>
            <p  style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236);">{{Lang::get('mail.welcome.what')}}</p>
            <br />
            <table width="343" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="343" height="49" align="center" bgcolor="#f3e353" style="border-radius: 25px;background-color: rgb(243, 227, 83);">
                        <a href="{{ URL::to('register/verify/' . $activation_code) }}" style="text-decoration:none; color:#000;font-size: 22px; font-family: Arial;
                           color: rgb(0, 0, 0); line-height: 1.2; text-transform:uppercase">
                            {{Lang::get('mail.welcome.begin')}}<strong>{{Lang::get('mail.welcome.now')}}</strong>
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="115" align="center">
            <p style="font-size: 14px; font-family: Arial;">{{Lang::get('mail.welcome.doubt')}}<br />
                <strong> info@emediamarket.com</strong>
            </p>
            <p style="font-size: 14px; font-family: Arial;">
                {{Lang::get('mail.common.greeting')}}
                <br />
                {{Lang::get('mail.common.team')}}
            </p>
        </td>
    </tr>
    <tr>
        <td bgcolor="#676767" align="center">
            <img src="{{asset('img/mail/logo-footer.png')}}" width="136" height="31" alt="eMediaMarket" />
        </td>
    </tr>
</table>
</body>
</html>