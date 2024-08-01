<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="{{route('equipment.type.index')}}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'equipment.type.index' ) ? ' active' : '' }}">{{__('Types')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="{{ route('equipment.manufacturer.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'equipment.manufacturer.index' ) ? 'active' : '' }}">{{__('Manufacturer')}}<div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="{{ route('equipment.condition.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'equipment.condition.index' ) ? ' active' : '' }}">{{__('Condition')}}<div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        {{-- <a href="{{ route('custom-field.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'custom-field.index' ) ? 'active' : '' }}   ">{{__('Custom Field')}}<div class="float-end"><i class="ti ti-chevron-right"></i></div></a> --}}

    </div>
</div>
