<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Documento sin título</title>
</head>
<body>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td bgcolor="#676767" style="background-color:#676767"><img src="{{asset('img/mail/logo.png')}}"  alt="eMediaMarket" /></td>
    </tr>
    <tr>
        <td><img src="{{asset('img/mail/reject-header.jpg')}}" alt="Tu orden ha sido rechazada" style="background-color:#29abe2; color:#fff; font-weight:3em; " /></td>
    </tr>
    <tr>
        <td height="356" align="center" bgcolor="#29abe1">
            <br>
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236); font-weight: bold; text-transform: uppercase; font-weight:800 padding-left: 5%; padding-right: 5%;">
                {{Lang::get('mail.reject.name', ['user' => $editor])}}
                <br />

            </p>
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236); padding-left: 5%; padding-right: 5%; font-weight: 300;">
                {{Lang::get('mail.reject.addspace', ['url' => $url])}}<br />
                {{Lang::get('mail.reject.review')}}<br />
                {{Lang::get('mail.reject.reason')}}<br />
                <br />
            </p>
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236); padding-left: 5%; padding-right: 5%; font-weight: 300;">
                "{{$message}}"<br />
            </p>
            <br>
            <br>
        </td>
    </tr>
    <tr>
        <td height="115" align="center">
            <p style="font-size: 14px; font-family: Arial; padding-left: 5%; padding-right: 5%;">
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