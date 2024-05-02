<!--admingroups_start-->
@if(!auth()->guard('client')->check())
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ App\Models\AdminGroup::count() }}</h3>
        <p>{{ trans('admin.admingroups') }}</p>
      </div>
      <div class="icon">
        <i class="fas fa-users"></i>
      </div>
      <a href="{{ aurl('admingroups') }}" class="small-box-footer">{{ trans('admin.admingroups') }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
<!--admingroups_end-->
<!--admins_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ App\Models\Admin::count() }}</h3>
        <p>{{ trans('admin.admins') }}</p>
      </div>
      <div class="icon">
        <i class="fas fa-users"></i>
      </div>
      <a href="{{ aurl('admins') }}" class="small-box-footer">{{ trans('admin.admins') }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
<!--admins_end-->



<!--clients_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Client::count()) }}</h3>
        <p>{{ trans("admin.clients") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-user"></i>
      </div>
      <a href="{{ aurl("clients") }}" class="small-box-footer">{{ trans("admin.clients") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--clients_end-->
<!--grades_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Grade::count()) }}</h3>
        <p>{{ trans("admin.grades") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-project-diagram"></i>
      </div>
      <a href="{{ aurl("grades") }}" class="small-box-footer">{{ trans("admin.grades") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--grades_end-->
<!--types_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Type::count()) }}</h3>
        <p>{{ trans("admin.types") }}</p>
      </div>
      <div class="icon">
        <i class="fab fa-typo3"></i>
      </div>
      <a href="{{ aurl("types") }}" class="small-box-footer">{{ trans("admin.types") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--types_end-->
<!--categories_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Category::count()) }}</h3>
        <p>{{ trans("admin.categories") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-ruler-vertical"></i>
      </div>
      <a href="{{ aurl("categories") }}" class="small-box-footer">{{ trans("admin.categories") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--categories_end-->
<!--directions_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Direction::count()) }}</h3>
        <p>{{ trans("admin.directions") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-archway"></i>
      </div>
      <a href="{{ aurl("directions") }}" class="small-box-footer">{{ trans("admin.directions") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--directions_end-->
<!--responses_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Response::count()) }}</h3>
        <p>{{ trans("admin.responses") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-allergies"></i>
      </div>
      <a href="{{ aurl("responses") }}" class="small-box-footer">{{ trans("admin.responses") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--responses_end-->
<!--decesions_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Decesion::count()) }}</h3>
        <p>{{ trans("admin.decesions") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-american-sign-language-interpreting"></i>
      </div>
      <a href="{{ aurl("decesions") }}" class="small-box-footer">{{ trans("admin.decesions") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--decesions_end-->
<!--machines_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Machine::count()) }}</h3>
        <p>{{ trans("admin.machines") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-dharmachakra"></i>
      </div>
      <a href="{{ aurl("machines") }}" class="small-box-footer">{{ trans("admin.machines") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--machines_end-->
<!--offsets_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Offset::count()) }}</h3>
        <p>{{ trans("admin.offsets") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-window-close"></i>
      </div>
      <a href="{{ aurl("offsets") }}" class="small-box-footer">{{ trans("admin.offsets") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--offsets_end-->
<!--relueres_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\Reluere::count()) }}</h3>
        <p>{{ trans("admin.relueres") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-balance-scale"></i>
      </div>
      <a href="{{ aurl("relueres") }}" class="small-box-footer">{{ trans("admin.relueres") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--relueres_end-->
<!--bookmachines_start-->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ mK(App\Models\BookMachine::count()) }}</h3>
        <p>{{ trans("admin.bookmachines") }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-icons"></i>
      </div>
      <a href="{{ aurl("bookmachines") }}" class="small-box-footer">{{ trans("admin.bookmachines") }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!--bookmachines_end-->