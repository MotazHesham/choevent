<div class="drop-down main-drop-down">
    <nav role='navigation'>
    <ul>
        <li><a href="{{route('website.home')}}">{{ trans('website.menu.home') }}</a></li>
        <li><a href="{{route('website.events.index')}}">{{ trans('website.menu.events') }}</a></li>
        <li><a href="{{route('website.organizers.index')}}"> {{ trans('website.menu.organizers') }}</a></li>
        <li><a href="{{route('website.sponsors.index')}}">  {{ trans('website.menu.sponsors') }}</a></li>
        <li><a href="{{route('website.providers.index')}}">  {{ trans('website.menu.providers') }}</a></li>
        <li><a href="{{route('website.tickets.index')}}"> {{ trans('website.menu.tickets') }}</a></li>
        <li><a href="{{route('website.booth.index')}}">  {{ trans('website.menu.booth') }}</a></li>
        <li><a href="{{route('website.consultations.create')}}">  {{ trans('cruds.consultation.title_singular') }}</a></li>
        <li><a href="{{route('website.aboutus')}}">{{ trans('website.menu.aboutus') }} </a></li>
        <li><a href="{{url('conditions')}}">{{ trans('website.menu.conditions') }}</a></li>
        <li><a href="{{route('website.contactus')}}">{{ trans('website.menu.contactus') }}</a></li>
    </ul>
    </nav>
</div>
    <div class="menu">
    <a class="trigger" href="#">&equiv;</a>
    <a class="close" href="#">&times;</a>
    </div>
    <script id="rendered-js">
        $('.menu a').click(function () {
        
        $('.trigger').toggle();
        $('.menu').toggleClass('round');
        $('.close').toggle();
        $('.drop-down').toggleClass('down');
        
        
        });
    //# sourceURL=pen.js
        </script>