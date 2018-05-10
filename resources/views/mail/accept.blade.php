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
        <td><img src="{{asset('img/mail/accept-header.jpg')}}" alt="Tu artículo ha sido aprobado" style="background-color:#29abe2; color:#fff; font-weight:3em; font-weight:800" /></td>
    </tr>
    <tr>
        <td height="356" align="center" bgcolor="#29abe1">
            <br>
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236); font-weight: bold; text-transform: uppercase;">
                {{Lang::get('mail.accept.name', ['user' => $editor])}}<br />

            </p>
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236);">
                {{Lang::get('mail.accept.good')}}<br />
            </p>
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236); padding-left: 5%; padding-right: 5%;">
                {{Lang::get('mail.accept.accepted')}}<br>
                {{Lang::get('mail.accept.article')}}
            </p>
            <p style="font-size: 18px;font-family: Arial; color: rgb(236, 236, 236); font-weight: bold;">
                {{Lang::get('mail.accept.credited')}} <br>
            </p>
            <br />
            <table width="457" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="457" height="49" align="center" bgcolor="#f3e353" style="border-radius: 25px;background-color: rgb(243, 227, 83);">
                        <a href="{{route('users.show', $user_id)}}}}" style="text-decoration:none; color:#000;font-size: 22px; font-family: Arial;
                           color: rgb(0, 0, 0); line-height: 1.2; text-transform:uppercase">
                            <strong>
                                {{Lang::get('mail.accept.see')}}
                            </strong>
                            {{Lang::get('mail.accept.wallet')}}
                        </a>
                    </td>

                </tr>
            </table> <br><br>
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
        <td bgcolor="#676767" align="center"><img src="logo-footer.jpg"  alt="eMediaMarket" /></td>
    </tr>
</table>
</body>
</html>