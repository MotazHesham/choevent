<div class="slider">
    <div class="blog-slider">
        <div class="blog-slider__wrp swiper-wrapper">
           
            @isset($sliderNews)
            @foreach ($sliderNews as $article)
            <div class="blog-slider__item swiper-slide">
                <div class="blog-slider__img">
                <img src="{{$article->featured_image?$article->featured_image->url:''}}" alt="">
                </div>
                <div class="blog-slider__content">
                    <span class="blog-slider__code"> {{$article->created_at->format('d/ m/ Y')}} </span>
                    <div class="blog-slider__title">{{$article->title}} </div>
                <div class="blog-slider__text">{!!$article->short_description!!}</div>
                    <a href="{{route('website.news.show',['id'=>$article->id])}}" class="blog-slider__button"> {{ trans('website.global.more') }}</a>
                </div>
            </div>
            @endforeach
            @endisset
           
        </div>
        <div class="blog-slider__pagination"></div>
    </div>
</div>