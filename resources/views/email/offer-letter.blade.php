<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
    Dear {{$data['name']}},<br>
     
     Kindly click on the <a href="https://loans.ukdiononline.com/public/confirm/my/letter?email={{$data["email"]}}&theloan={{$data["loan_id"]}}&customer={{$data["customer_id"]}}&ref={{$data["code"]}}">link</a> below to confirm/accept you offer letter using the reference id bellow;
     

     
     <a href="https://loans.ukdiononline.com/public/confirm/my/letter?email={{$data["email"]}}&theloan={{$data["loan_id"]}}&customer={{$data["customer_id"]}}&ref={{$data["code"]}}" class="textpara">
        https://loans.ukdiononline.com/public/confirm/my/letter?email={{$data["email"]}}&theloan={{$data["loan_id"]}}&customer={{$data["customer_id"]}}&ref={{$data["code"]}}
     </a>
    
    <h3>
         Reference ID: {{$data['code']}} <br>
    </h3>
    
    <p>
        Regards,
        Uk-Dion Team
    </p>

	
</body>
</html>