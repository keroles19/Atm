<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo" style="padding-left: 1em !important;">
        <a href="{{ route('atm.home') }}" class="app-brand-link">
              <span class="app-brand-logo demo">
              <img src="{{asset('assets/img/favicon/favicon.png')}}" alt="{{ env('APP_NAME') }}">
              </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-3">
        <!-- Dashboard  -->
        <li class="menu-item {{  activeClass('atm.home')  }}">
            <a href="{{route('atm.home')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Page 1"> Home </div>
            </a>
        </li>
    </ul>
</aside>
