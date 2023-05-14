<!-- Side Nav START -->
<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item ">
                <a  href="{{ URL::to('admin') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title"> {{ trans('home.DashBoard') }} </span>
                </a>
            </li>
            @if(\App\Models\Permission::check('employees/land') == 1)
            <li class="nav-item ">
                <a  href="{{ URL::to('admin/employees/land') }}">
                    <span class="icon-holder">
                      <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title"> {{ trans('home.Employees') }} </span>
                </a>
            </li>
            @endif
            @if(\App\Models\Permission::check('data-entry') == 1)
            <li class="nav-item ">
                <a  href="{{ URL::to('admin/data-entry') }}">
                    <span class="icon-holder">
                      <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title"> {{ trans('home.Data Entry') }} </span>
                </a>
            </li>
            @endif
            @if(\App\Models\Permission::check('edit-entry') == 1)
            <li class="nav-item ">
                <a  href="{{ URL::to('admin/edit-entry') }}">
                    <span class="icon-holder">
                      <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title"> {{ trans('home.Edit Entries') }} </span>
                </a>
            </li>
            @endif
            @if(\App\Models\Permission::check('fertilizations') == 1)
            <li class="nav-item ">
                <a  href="{{ URL::to('admin/fertilizations') }}">
                    <span class="icon-holder">
                      <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title"> {{ trans('home.Fertilization Plans') }} </span>
                </a>
            </li>
            @endif
            @if(\App\Models\Permission::check('pesticides') == 1)
            <li class="nav-item ">
                <a  href="{{ URL::to('admin/pesticides') }}">
                    <span class="icon-holder">
                      <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title"> {{ trans('home.Pesticide Plans') }} </span>
                </a>
            </li>
            @endif
            @if(\App\Models\Permission::check('sells') == 1)
            <li class="nav-item ">
                <a  href="{{ URL::to('admin/sells') }}">
                    <span class="icon-holder">
                      <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title"> {{ trans('home.Sells') }} </span>
                </a>
            </li>
            @endif
            @if(\App\Models\Permission::check('equipments') == 1)
            <li class="nav-item ">
                <a  href="{{ URL::to('admin/equipments') }}">
                    <span class="icon-holder">
                      <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title"> {{ trans('home.Equipments') }} </span>
                </a>
            </li>
            @endif
            @if(\App\Models\Permission::check('alerts') == 1)
            <li class="nav-item ">
                <a  href="{{ URL::to('admin/alerts') }}">
                    <span class="icon-holder">
                      <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title"> {{ trans('home.Alerts') }} </span>
                </a>
            </li>
            @endif
            <li class="nav-item ">
                <a  href="{{ URL::to('admin/logout') }}">
                    <span class="icon-holder">
                      <i class="fas fa-power-off"></i>
                    </span>
                    <span class="title">{{ trans('home.Logout') }} </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Side Nav END -->