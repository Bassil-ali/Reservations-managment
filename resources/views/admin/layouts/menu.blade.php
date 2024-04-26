<!-- Add icons to the links using the .nav-icon class
with font-awesome or any other icon font library -->
<li class="nav-header"></li>
<li class="nav-item">
  <a href="{{ aurl('') }}" class="nav-link {{ active_link(null,'active') }}">
    <i class="nav-icon fas fa-home"></i>
    <p>
      {{ trans('admin.dashboard') }}
    </p>
  </a>
</li>
@if(admin()->user()->role('settings_show'))
<li class="nav-item">
  <a href="{{ aurl('settings') }}" class="nav-link  {{ active_link('settings','active') }}">
    <i class="nav-icon fas fa-cogs"></i>
    <p>
      {{ trans('admin.settings') }}
    </p>
  </a>
</li>
@endif
@if(admin()->user()->role("admins_show"))
<li class="nav-item {{ active_link('admins','menu-open') }}">
  <a href="#" class="nav-link  {{ active_link('admins','active') }}">
    <i class="nav-icon fas fa-users"></i>
    <p>
      {{trans('admin.admins')}}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('admins')}}" class="nav-link {{ active_link('admins','active') }}">
        <i class="fas fa-users nav-icon"></i>
        <p>{{trans('admin.admins')}}</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('admins/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}}</p>
      </a>
    </li>
  </ul>
</li>
@endif
@if(admin()->user()->role("admingroups_show"))
<li class="nav-item {{ active_link('admingroups','menu-open') }}">
  <a href="#" class="nav-link  {{ active_link('admingroups','active') }}">
    <i class="nav-icon fas fa-users"></i>
    <p>
      {{trans('admin.admingroups')}}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('admingroups')}}" class="nav-link {{ active_link('admingroups','active') }}">
        <i class="fas fa-users nav-icon"></i>
        <p>{{trans('admin.admingroups')}}</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('admingroups/create') }}" class="nav-link ">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}}</p>
      </a>
    </li>
  </ul>
</li>
@endif




<!--clients_start_route-->
@if(admin()->user()->role("clients_show"))
<li class="nav-item {{active_link('clients','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('clients','active')}}">
    <i class="nav-icon fa fa-user"></i>
    <p>
      {{trans('admin.clients')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('clients')}}" class="nav-link  {{active_link('clients','active')}}">
        <i class="fa fa-user nav-icon"></i>
        <p>{{trans('admin.clients')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('clients/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--clients_end_route-->

<!--grades_start_route-->
@if(admin()->user()->role("grades_show"))
<li class="nav-item {{active_link('grades','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('grades','active')}}">
    <i class="nav-icon fa fa-project-diagram"></i>
    <p>
      {{trans('admin.grades')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('grades')}}" class="nav-link  {{active_link('grades','active')}}">
        <i class="fa fa-project-diagram nav-icon"></i>
        <p>{{trans('admin.grades')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('grades/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--grades_end_route-->

<!--types_start_route-->
@if(admin()->user()->role("types_show"))
<li class="nav-item {{active_link('types','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('types','active')}}">
    <i class="nav-icon fab fa-typo3"></i>
    <p>
      {{trans('admin.types')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('types')}}" class="nav-link  {{active_link('types','active')}}">
        <i class="fab fa-typo3 nav-icon"></i>
        <p>{{trans('admin.types')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('types/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--types_end_route-->

<!--categories_start_route-->
@if(admin()->user()->role("categories_show"))
<li class="nav-item {{active_link('categories','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('categories','active')}}">
    <i class="nav-icon fa fa-ruler-vertical"></i>
    <p>
      {{trans('admin.categories')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('categories')}}" class="nav-link  {{active_link('categories','active')}}">
        <i class="fa fa-ruler-vertical nav-icon"></i>
        <p>{{trans('admin.categories')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('categories/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--categories_end_route-->

<!--directions_start_route-->
@if(admin()->user()->role("directions_show"))
<li class="nav-item {{active_link('directions','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('directions','active')}}">
    <i class="nav-icon fa fa-archway"></i>
    <p>
      {{trans('admin.directions')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('directions')}}" class="nav-link  {{active_link('directions','active')}}">
        <i class="fa fa-archway nav-icon"></i>
        <p>{{trans('admin.directions')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('directions/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--directions_end_route-->

<!--responses_start_route-->
@if(admin()->user()->role("responses_show"))
<li class="nav-item {{active_link('responses','menu-open')}} ">
  <a href="#" class="nav-link {{active_link('responses','active')}}">
    <i class="nav-icon fa fa-allergies"></i>
    <p>
      {{trans('admin.responses')}} 
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{aurl('responses')}}" class="nav-link  {{active_link('responses','active')}}">
        <i class="fa fa-allergies nav-icon"></i>
        <p>{{trans('admin.responses')}} </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ aurl('responses/create') }}" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>{{trans('admin.create')}} </p>
      </a>
    </li>
  </ul>
</li>
@endif
<!--responses_end_route-->