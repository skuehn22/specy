<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>trustyfy.com</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        body{
            color:#0f0f0f;
        }

    </style>
</head>

<body style="color: #0f0f0f; text-align: center;  margin:0; padding:0; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;" bgcolor="#fff">
<br><br>
<table align='center' style="color: #0f0f0f; padding:25px; min-width:320px; border-radius: 5px; border: 2px solid #d4d4d4;" width="45%" cellspacing="0" cellpadding="0" bgcolor="#fff">
    <tr>
        <td style="text-align: center;">
            <br><br>
            <a href="http://www.trustfy.io" style="text-decoration:none;" target="_blank">
                <span style="color:#1e8033; font-size:36px; font-weight: 800; ">trustfy.io</span>
            </a>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;">
            <br><br>
            <span style="color: #535353;font-family: Arial, Helvetica, sans-serif;font-size: 14px;">
            Hallo {{$rating->name_client}}, <br> <br>
            You're getting this e-mail from: {{ $rating->name  }}
            <br><br>
            <p>
                We would be happy if you would leave a short evaluation of the last work with you.
            </p>
            <p>
                Message:<br><br>
                {{ $rating->description  }}
            </p>
                <br>
                <p>
                     <a style="color: #1e8033;"  href="https://www.trustfy.io/open-rating?hash={{$rating->session}}">Link to rate</a>
                </p>

            </span>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;">
            <span style="color: #535353;font-family: Arial, Helvetica, sans-serif;font-size: 14px;">
            <p>
                We’re Trustfy, an independent review platform for freelancers and their clients.
            </p>
            <p>
                We already trust review sites to make decisions about what shops to frequent or restaurants to eat at- but how does this work when hiring a freelancer?
            </p>
            <p>
                You shouldn’t have to rely on a mix of third-party job sites and marketplaces, many of which have paywalls, to access a freelancer’s reputation. That’s why we’re creating an open-access review system that lets clients rate their freelancers and freelancers rate their clients, be they companies or individuals.
            </p>
            <p>
                Freelancing is the future of work, and we want that future to be fair, transparent and honest.
            </p>
            </span>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">
            <br><br>
            <span style="color: #9e9e9e;font-family: Arial, Helvetica, sans-serif;font-size: 14px;">
            <p>&copy; <a href="http://www.trustfy.io" style="color: #1e8033; text-decoration: none; ">trustfy.io</a> 2018. All Rights Reserved. <br> <br></p>
            </span>
        </td>
    </tr>
</table>

</body>
</html>
