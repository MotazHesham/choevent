<!DOCTYPE html>
<html lang="en">
<head>
<!-- Basic page needs
	============================================ -->
	<title>Choices|إيجار بوث</title>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="">
	<meta name="robots" content="" />
<!-- Mobile specific metas
	============================================ -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Favicon
	============================================ -->

    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap');
        body {font-family: 'Cairo', sans-serif; font-weight: bold;}
        .content { margin: 0 auto; max-width: 700px; border: solid 10px #dbdbdb; padding: 30px; border-radius: 50px;}
        body { text-align: right;}
        .logo { text-align: center;}
        .logo img { width: 300px; margin: 0 auto; }
        li { list-style: none; padding: 10px; margin-top: 5px; border-radius: 20px; }
        .lable { width: 30%; float: right;}
        .details { width: 70%; float: left;}
        .clear { clear: both;}
        .bg-blue { background: #f2f2f2; }
        p{ color: #979797; font-size: 13px;}
        .barcode { text-align: center;}
        @media only screen and (max-width: 600px) {
        .logo img { width: 200px; margin: 0 auto; }

            
            .lable { width: 100%; float: none; text-align: center;}
        .details {  width: 100%; float: none; text-align: center;}
        }
    </style>
</head>

<body>
<!-- Main Container  -->
		<div class="confirmation_email">   
			<div class="content">
                <div class="logo"><img src="{{url('images/logo.png')}}"/></div>
               
                <div class="clear"></div>
                <header style="direction: rtl;"> 
                <h4>
                    
                    مرحبا : {{$user->name}}
                </h4>
              
                </header>
                
                <hr />
                <li  class="bg-blue">
                    <div class="lable">اسم المستخدم</div>
                    <div class="details">{{$user->name}}</div>
                     <div class="clear"></div>
    
                 </li>
                 <li  class="bg-blue">
                    <div class="lable">رقم الهوية</div>
                    <div class="details">{{$user->identity_number}}</div>
                     <div class="clear"></div>
                </li>
                <li class="bg-blue">
                    <div class="lable">نشاط البوث</div>
                     <div class="details"> {{$booth->activity}}</div>
                         <div class="clear"></div>
                </li>

                <li  class="bg-blue">
				<div class="lable">طول البوث</div>
                <div class="details">{{$booth->length}} م</div>
                 <div class="clear"></div>

                </li>
                <li  class="bg-blue">
                    <div class="lable">عرض البوث</div>
                    <div class="details">{{$booth->width}} م</div>
                     <div class="clear"></div>
    
                    </li>
                <li  class="bg-blue">
                    <div class="lable">سعر إيجار البوث</div>
                    <div class="details">{{$booth->price}} ريال </div>
                     <div class="clear"></div>
    
                </li>
                <li  class="bg-blue">
                    <div class="lable">اسم الفعالية</div>
                    <div class="details">{{$event->name}}</div>
                     <div class="clear"></div>
    
                    </li>
                    <li  class="bg-blue">
                        <div class="lable">موقع الفعالية على الخريطة</div>
                        <div class="details">{{$event->location_url}}</div>
                         <div class="clear"></div>
        
                    </li>
                    <li  class="bg-blue">
                        <div class="lable">لمزيد من التفاصيل عن الفعالية</div>
                    <div class="details"><a href="{{route('website.events.show',['id'=>$event->id])}}">
                        صفحة الفعالية
                    </a></div>
                         <div class="clear"></div>
        
                    </li>
            
              
               
                  <footer style="margin-top:10px" > 
                   
                     
                       <p style="text-align: center; font-size: 11px; ">  جميع الحقوق محفوظة © choices 2020.</p>
                
                    
                    </footer>
			</div>
                  

		</div>
		<!-- //Main Container -->

		<!-- Footer Container -->
		<!-- Footer Container -->
		
		<!-- //end Footer Container -->






</body>
</html>