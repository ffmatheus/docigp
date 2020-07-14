<div class="container-fluid">
    <div class="row long-name text-center">
        <div class="col-12">
            {{ config('app.long_name') }}
        </div>
    </div>

</div>


<nav class="navbar navbar-expand-md navbar-light shadow bg-white">
    <div class="container">

        <a class="py-1 navbar-brand" href="{{ url('/') }}" >
            <img src="/img/logo-alerj-docigp.png" class="img-fluid logo-alerj " alt="">
        </a>

        <div class="d-flex ml-auto">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#globalNavbar" aria-controls="globalNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="globalNavbar" style="">


            <ul class="navbar-nav mr-auto">

                @guest
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">Painel de Controle</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Tabelas <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('entries.index') }}">
                                Prestação de Contas
                            </a>

                            @can('parties:show')
                                <a class="dropdown-item" href="{{ route('parties.index') }}">
                                    Partidos
                                </a>
                            @endCan

                            @can('legislatures:show')
                                <a class="dropdown-item" href="{{ route('legislatures.index') }}">
                                    Legislaturas
                                </a>
                            @endCan

                            @can('congressmen:show')
                                <a class="dropdown-item" href="{{ route('congressmen.index') }}">
                                    Deputados
                                </a>
                            @endCan

                            @can('users:show')
                                <a class="dropdown-item" href="{{ route('users.index') }}">
                                    Usuários
                                </a>
                            @endCan

                            @can('providers:show')
                                <a class="dropdown-item" href="{{ route('providers.index') }}">
                                    Fornecedores / Favorecidos
                                </a>
                            @endCan

                            @can('cost-centers:show')
                                <a class="dropdown-item" href="{{ route('cost-centers.index') }}">
                                    Centro de Custo
                                </a>
                            @endCan

                            @can('entry-types:show')
                                <a class="dropdown-item" href="{{ route('entry-types.index') }}">
                                    Tipos de Lançamentos
                                </a>
                        @endCan

                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                                                                                                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest

{{--
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <div class="navbar-collapse navbar-top-collapse">
                            <ul id="menu-top-menu" class="nav navbar-nav">

                                <li id="menu-item-601" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-601">
                                    <a title="Admin &amp; Dashboard" href="https://themes.getbootstrap.com/product-category/admin-dashboard/">Admin &amp; Dashboard</a>
                                </li>
                                <li id="menu-item-603" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-603">
                                    <a title="Landing &amp; Corporate" href="https://themes.getbootstrap.com/product-category/landing-corporate/">Landing &amp; Corporate</a>
                                </li>
                                <li id="menu-item-1537" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-1537">
                                    <a title="Application" href="https://themes.getbootstrap.com/product-category/application/">Application</a>
                                </li>
                                <li id="menu-item-602" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat current-product-ancestor current-menu-parent current-product-parent menu-item-602">
                                    <a title="E-Commerce &amp; Retail" href="https://themes.getbootstrap.com/product-category/ecommerce-retail/">E-Commerce &amp; Retail</a>
                                </li>
                                <li id="menu-item-1538" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-1538">
                                    <a title="Portfolio &amp; Blog" href="https://themes.getbootstrap.com/product-category/portfolio-blog/">Portfolio &amp; Blog</a>
                                </li>
                                <li id="menu-item-1539" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-1539">
                                    <a title="Specialty" href="https://themes.getbootstrap.com/product-category/specialty/">Specialty</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://themes.getbootstrap.com/official-themes">Why Our Themes?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://themes.getbootstrap.com/guide">The Guide</a>
                </li>--}}
            </ul>


            {{--            <ul class="navbar-nav d-none d-lg-flex ml-2 order-3">
                            <li class="nav-item">
                                <a class="nav-link" href="https://themes.getbootstrap.com/signin/">Sign in</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://themes.getbootstrap.com/my-account/">Sign up</a>
                            </li>
                        </ul>--}}

            {{--            <ul class="navbar-nav mr-auto order-3">
                            <li class="nav-item-divider"></li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://themes.getbootstrap.com/signin/">Sign in</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://themes.getbootstrap.com/my-account/">Sign up</a>
                            </li>
                        </ul>--}}


        </div>
    </div>
</nav>


{{--




<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container-fluid">

        <div class="row">
            <div class="col-8">
                <a class="navbar-brand d-flex" href="{{ url('/') }}" style="white-space: normal;">
                    <img src="/img/logo-alerj.png" class="img-fluid logo-alerj " alt=""> <span
                        class="docigp-name align-self-center"> {{ config('app.name') }} </span>
                </a>
            </div>

            <div class="col-4 my-auto text-right">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Service Links -->

                        @guest
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index') }}">Painel de Controle</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Tabelas <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('entries.index') }}">
                                        Prestação de Contas
                                    </a>

                                    @can('parties:show')
                                        <a class="dropdown-item" href="{{ route('parties.index') }}">
                                            Partidos
                                        </a>
                                    @endCan

                                    @can('legislatures:show')
                                        <a class="dropdown-item" href="{{ route('legislatures.index') }}">
                                            Legislaturas
                                        </a>
                                    @endCan

                                    @can('congressmen:show')
                                        <a class="dropdown-item" href="{{ route('congressmen.index') }}">
                                            Deputados
                                        </a>
                                    @endCan

                                    @can('users:show')
                                        <a class="dropdown-item" href="{{ route('users.index') }}">
                                            Usuários
                                        </a>
                                    @endCan

                                    @can('providers:show')
                                        <a class="dropdown-item" href="{{ route('providers.index') }}">
                                            Fornecedores / Favorecidos
                                        </a>
                                    @endCan

                                    @can('cost-centers:show')
                                        <a class="dropdown-item" href="{{ route('cost-centers.index') }}">
                                            Centro de Custo
                                        </a>
                                    @endCan

                                    @can('entry-types:show')
                                        <a class="dropdown-item" href="{{ route('entry-types.index') }}">
                                            Tipos de Lançamentos
                                        </a>
                                @endCan

                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                                                                                                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

--}}
