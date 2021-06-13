<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('consultation_access')
            <li class="{{ request()->is("admin/consultations") || request()->is("admin/consultations/*") ? "active" : "" }}">
                <a href="{{ route("admin.consultations.index") }}">
                    <i class="fa-fw fas fa-cogs">

                    </i>
                    <span>{{ trans('cruds.consultation.title') }}</span>

                </a>
            </li>
        @endcan
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                        {{--  --}}
                        <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                            <a href="{{ route('admin.users.index',['group'=>'admin']) }}">
                                <i class="fa-fw fas fa-user">

                                </i>
                                <span>المدراء</span>

                            </a>
                        </li>
                        <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                            <a href="{{ route('admin.users.index',['group'=>'sponsor']) }}">
                                <i class="fa-fw fas fa-user">

                                </i>
                                <span>الشركات الراعية</span>

                            </a>
                        </li>
                        <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                            <a href="{{ route('admin.users.index',['group'=>'organizer']) }}">
                                <i class="fa-fw fas fa-user">

                                </i>
                                <span>منظمى الفاعليات</span>

                            </a>
                        </li>
                        <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                            <a href="{{ route('admin.users.index',['group'=>'provider']) }}">
                                <i class="fa-fw fas fa-user">

                                </i>
                                <span>مقدمى الخدمات</span>

                            </a>
                        </li>
                        {{--  --}}
                            <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <a href="{{ route('admin.users.index',['group'=>'user']) }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            {{--  --}}
            @can('event_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-calendar-alt">

                        </i>
                        <span>{{ trans('cruds.eventManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('event_access')
                        <li class="{{ request()->is("admin/events") || request()->is("admin/events/*") ? "active" : "" }}">
                            <a href="{{ route("admin.events.index") }}">
                                <i class="fa-fw fas fa-gift">
        
                                </i>
                                <span>{{ trans('cruds.event.title') }}</span>
        
                            </a>
                        </li>
                        @endcan
                        @can('event_access')
                        <li class="{{ request()->is("admin/categories") || request()->is("admin/categories/*") ? "active" : "" }}">
                            <a href="{{ route('admin.categories.index',['type'=>'activity']) }}">
                                <i class="fa-fw fab fa-centercode">
        
                                </i>
                                <span>{{ trans('cruds.activity.title') }}</span>
        
                            </a>
                        </li>
                        
                        @endcan
                    </ul>
                </li>
            @endcan
            {{-- edn events & start news --}}
            @can('event_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa-fw far fa-newspaper">

                        </i>
                        <span>{{ trans('cruds.newsManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('article_access')
                        <li class="{{ request()->is("admin/articles") || request()->is("admin/articles/*") ? "active" : "" }}">
                            <a href="{{ route("admin.articles.index") }}">
                                <i class="fa-fw fas fa-newspaper">

                                </i>
                                <span>{{ trans('cruds.article.title') }}</span>

                            </a>
                        </li>
                        @endcan
                        @can('category_access')
                        <li class="{{ request()->is("admin/categories") || request()->is("admin/categories/*") ? "active" : "" }}">
                            <a href="{{ route('admin.categories.index',['type'=>'news']) }}">
                                <i class="fa-fw fab fa-servicestack">
                                </i>
                                <span>{{ trans('cruds.news.title') }}</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
            </li>
            @endcan
            {{-- end news start orders --}}
            @can('order_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa-fw fas fa-briefcase">
                    </i>
                        <span>{{ trans('cruds.orderManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                         
            @can('order_access')
            <li class="{{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "active" : "" }}">
                <a href="{{ route("admin.orders.index",['type'=>'service']) }}">
                    <i class="fa-fw fas fa-cogs">

                    </i>
                    <span>{{ trans('cruds.service_order.title') }}</span>

                </a>
            </li>
          @endcan

        @can('offer_access')
            <li class="{{ request()->is("admin/offers") || request()->is("admin/offers/*") ? "active" : "" }}">
                <a href="{{ route("admin.offers.index",['type'=>'service']) }}">
                    <i class="fa-fw fas fa-cogs">

                    </i>
                    <span>{{ trans('cruds.service_offer.title') }}</span>

                </a>
            </li>
        @endcan
        {{-- sponsors --}}
        @can('order_access')
        <li class="{{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "active" : "" }}">
            <a href="{{ route("admin.orders.index",['type'=>'sponsoring']) }}">
                <i class="fa-fw fas fa-cogs">

                </i>
                <span>{{ trans('cruds.sponsoring_order.title') }}</span>

            </a>
        </li>
      @endcan
      @can('offer_access')
            <li class="{{ request()->is("admin/offers") || request()->is("admin/offers/*") ? "active" : "" }}">
                <a href="{{ route("admin.offers.index",['type'=>'sponsoring']) }}">
                    <i class="fa-fw fas fa-cogs">

                    </i>
                    <span>{{ trans('cruds.sponsoring_offer.title') }}</span>

                </a>
            </li>
        @endcan
        </ul>
            </li>
             @endcan
            {{--  --}}
            @can('city_access')
                <li class="{{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "active" : "" }}">
                    <a href="{{ route("admin.cities.index") }}">
                        <i class="fa-fw fas fa-map-marker-alt">

                        </i>
                        <span>{{ trans('cruds.city.title') }}</span>

                    </a>
                </li>
            @endcan
            {{-- @can('booth_access')
            <li class="{{ request()->is("admin/booths") || request()->is("admin/booths/*") ? "active" : "" }}">
                <a href="{{ route("admin.booths.index") }}">
                    <i class="fa-fw fas fa-cogs">

                    </i>
                    <span>{{ trans('cruds.booth.title') }}</span>

                </a>
            </li>
        @endcan --}}
        @can('booth_detail_access')
            <li class="{{ request()->is("admin/booth-details") || request()->is("admin/booth-details/*") ? "active" : "" }}">
                <a href="{{ route("admin.booth-details.index") }}">
                    <i class="fa-fw fas fa-cogs">

                    </i>
                    <span>{{ trans('cruds.boothDetail.title') }}</span>

                </a>
            </li>
        @endcan
        @can('configration_access')
        <li class="{{ request()->is("admin/configrations") || request()->is("admin/configrations/*") ? "active" : "" }}">
            <a href="{{ route("admin.configrations.index") }}">
                <i class="fa-fw fas fa-cogs">

                </i>
                <span>{{ trans('cruds.configration.title') }}</span>

            </a>
        </li>
    @endcan
    @can('coupon_access')
        <li class="{{ request()->is("admin/coupons") || request()->is("admin/coupons/*") ? "active" : "" }}">
            <a href="{{ route("admin.coupons.index") }}">
                <i class="fa-fw fas fa-cogs">

                </i>
                <span>{{ trans('cruds.coupon.title') }}</span>

            </a>
        </li>
    @endcan
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                        <a href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </section>
</aside>