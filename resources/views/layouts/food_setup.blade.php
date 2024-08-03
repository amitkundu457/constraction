<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="{{route('vehicle.type.index')}}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'vehicle.type.index' ) ? ' active' : '' }}">{{__('Vehicle Types')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        {{-- <a href="{{ route('product-category.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'product-category.index' ) ? 'active' : '' }}">{{__('Vehicle Spare')}}<div class="float-end"><i class="ti ti-chevron-right"></i></div></a> --}}

    </div>
</div>
