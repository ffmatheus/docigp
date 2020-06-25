<div class="container-fluid">
    <div class="row long-name text-center">
        <div class="col-12">
            {{ config('app.long_name') }}
        </div>
    </div>

</div>

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

{{--                                                                @can('audits')--}}
{{--                                                                    <a class="dropdown-item" href="{{ route('audits.index') }}">--}}
{{--                                                                        Auditorias--}}
{{--                                                                    </a>--}}
{{--                                                                    @endCan--}}

                                                                </div>
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
