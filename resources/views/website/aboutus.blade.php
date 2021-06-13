@extends('website.layouts.main')
@section('styles')
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
</style>
@endsection
@section('content')
@include('website.partials.header-2')
<section>
    <div class=" banner-breadcumb ">
        <div class="breadcrumb-image" style="background-image: url(images/theme_background_color.jpg);">
            <div class="container text-center">
                <div class="breadcrumbs_path">
                    <?php
                    $arrow_direction=(app()->getLocale()=='en')?'right':'left';
                    ?>
                        <a href="{{route('website.home')}}">{{ trans('website.menu.home') }}</a>
                        <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp; {{ trans('website.menu.aboutus') }}
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="service_organizers bg_custom_1507727948742">
        
        
    <div class="container p-50">
        <div class="row">
        <div class="heading">
            <h1>{{ trans('website.menu.aboutus') }}</h1>
            {{-- <p> هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p> --}}
            </div>    
        </div>
        
        <div class="row about">
        <div class="col-md-3 col-xs-12">
            <div class="title">
                {{ trans('website.global.about') }}
                <br />
              <div class="english">  CHOICES</div>
            
            </div>
            
            
            </div>
            
             <div class="col-md-3 col-xs-12">
            <div class="pic">
           <img src="images/about.png" class="img-fluid">
            
            </div>
            
            
            </div>
            <div class="col-md-6 col-xs-12">
            <div class="content">
               <h3>من نحن </h3>
                <p>فريق يمتلك العديد من الخبرات في عالم الترفيه والفعاليات نضيف لكل فعالية متعتها الخاصة نهتم بجودة الحدث وادارة التفاصيل الصغيرة عبر منصة متكاملة تتيح لكل مستفيد تلبية رغباته واحتياجاته بكل سهولة وبساطة لنبقى علامة دائمة في ذاكرة كل عميل .</p>
                
                <br />
                
                  <h3>رؤيتنا </h3>
                <p>أن تصبح منصتنا مرجعك الأول، للتعرف على جميع الفعاليات المحلية والدولية، وتحصل على الخدمات بأفضل وسيلة ممكنة. </p>
                
                <br />
                
                
                  <h3>رسالتنا  </h3>
                <p>توظيف التقنية الحديثة في مجال الفعاليات لتسريع سير الاعمال وتنفيذها بكل احترافية و دقة .</p>
                
                <br />
                </div>
            
            
            </div>
            
        </div>
        
        
        
       
        
        
        </div>
        
        
        
       
        
        
        
        
    <!----------sponsors------------->
    

<div class="popup" data-popup="popup-1">
     <div class="popup-inner sponsors_inner">
        
        <div class="pic"><img src="images/DmqkXG6WwAAI15h.jpg" class="img-fluid"></div>
        <h2>بوابة الترفية</h2>
        <p>أنشئت بوابة الترفيه لتقدم تراخيص الأنشطة والخدمات التابعة للهيئة العامة للترفيه التي تعد الجهة المشرعة لهذا القطاع الحيوي في المملكة العربية السعودية، والتي تهدف إلى تطوير وتنظيم قطاع الترفيه ودعم بنيته التحتية، بالتعاون مع مختلف الجهات. وتعمل البوابة على تسهيل الأعمال للراغبين في تقديم الخدمات الترفيهية على اختلاف أنواعها، كما يمكن من خلالها الاطلاع على الاشتراطات والضوابط اللازمة للعمل في القطاع.

</p>
        
               <button class="sponsors_inner__button"><a data-popup-close="popup-1" href="#" class="">إغلاق</a></button>

        <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
    </div>
        </div>
        <!----------sponsors------------->
    
    
    
    </section>
@endsection