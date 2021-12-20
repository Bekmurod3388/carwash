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
                        <i class="fas fa-user"></i>
                        <p>Cost</p>
                    </a>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.price.index') ? 'active' : '' }}">
                    <a href="{{route('admin.price.index')}}">
                        <i class="fas fa-user"></i>
                        <p>Price</p>
                    </a>
                </li>
                <li class="nav-item {{  request()->routeIs('admin.worker.index') ? 'active' : '' }}">
                    <a href="{{route('admin.worker.index')}}">
                        <i class="fas fa-user"></i>
                        <p>worker</p>
                    </a>
                </li>

            </ul>


        </div>
    </div>
</div>


