<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="{{route('food.unit.index')}}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'food.unit.index' ) ? ' active' : '' }}">{{__('Unit')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
        <a href="{{route('food.category.index')}}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'food.category.index' ) ? ' active' : '' }}">{{__('Category')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
        <a href="{{route('food.area.index')}}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'food.area.index' ) ? ' active' : '' }}">{{__('Area')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    </div>
</div>
