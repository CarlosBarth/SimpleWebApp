<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('SGDEV') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('- Gerenciamento') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'contato') class="active " @endif>
                <a href="{{ route('consulta_pessoa')  }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('Consulta de Pessoas') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'pessoa') class="active " @endif>
                <a href="{{ route('consulta_pessoa')  }}">
                    <i class="tim-icons icon-delivery-fast"></i>
                    <p>{{ __('Consulta de Veículos') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="tim-icons icon-settings-gear-63" ></i>
                    <span class="nav-link-text" >{{ __('Gerenciamento') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('Perfil de Usuário') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('Consulta de Usuários') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'pessoa') class="active " @endif>
                            <a href="{{ route('pessoa.index')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('Consulta de Funcionários') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
