<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{  request()->routeIs('admin.users.index') ? 'active' : '' }}">
                    <a href="{{route('admin.users.index')}}">
                        <i class="fas fa-user"></i>
                        <p>Пользователь</p>
                    </a>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.cost.index') ? 'active' : '' }}">
                    <a href="{{route('admin.cost.index')}}">
                        <i class="fas fa-hand-holding-usd"></i>
                        <p>Расходы</p>
                    </a>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.price.index') ? 'active' : '' }}">
                    <a href="{{route('admin.price.index')}}">
                        <i class="fas fa-coins"></i>
                        <p>Цена</p>
                    </a>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.worker.index') ? 'active' : '' }}">
                    <a href="{{route('admin.worker.index')}}">
                        <i class="fas fa-users"></i>
                        <p>Рабочий</p>
                    </a>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.client.index') ? 'active' : '' }}">
                    <a href="{{route('admin.client.index')}}">
                        <i class="fas fa-won-sign"></i>
                        <p>Клиент</p>
                    </a>
                </li>
            </ul>


        </div>
    </div>
</div>


