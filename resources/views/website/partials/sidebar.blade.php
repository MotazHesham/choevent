<div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation" style="min-height:500px">
    <div class="navi">
        <ul>
        <li class="active"><a href="{{route('website.profile')}}"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">{{ trans('website.menu.personal_info') }} </span></a></li>
            @if($user->group=='organizer')
            <li><a href="{{route('website.organizer.events')}}">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">{{ trans('website.menu.events') }}</span>
                </a>
            </li>
            {{-- 
             --}}
           
            {{-- <li><a href="previousorders.html"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">طلبات الرعاية</span></a></li> --}}
            {{-- <li><a href="offers.html"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">عروض الرعاية </span></a></li> --}}
           
            {{-- <li><a href="offers.html"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">طلبات الخدمة</span></a></li> --}}
            {{-- <li><a href="myaccout.html"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">عروض الخدمة</span></a></li> --}}
            @endif
            @if($user->group=='sponsor')
            <li><a href="{{route('website.organizer.events')}}">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">{{ trans('website.menu.events') }}</span>
                </a>
            </li>
           
            <li><a href="{{route('website.offers.index',['type'=>'sponsoring'])}}">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">{{trans('website.menu.previous_offers') }}</span>
                </a>
            </li>
            {{-- <li><a href="offers.html"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">عروض الرعاية </span></a></li> --}}
            @endif
            @if($user->group=='provider')
            <li><a href="{{route('website.organizer.events')}}">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">{{trans('website.menu.events') }}</span>
                </a>
            </li>
          
            <li><a href="{{route('website.offers.index',['type'=>'service'])}}">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm">{{trans('website.menu.previous_offers') }}</span>
                </a>
            </li>
           
            @endif
            <li>
                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('website.header.logout') }}
                </a>
            </li>
            
        </ul>
    </div>
</div>