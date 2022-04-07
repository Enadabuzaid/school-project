@php
    $count = count(request()->segments());

    $parent = request()->segment($count - 1);

    $first = request()->segment(2);
    $last = request()->segment($count);
@endphp

<div class="my-auto">
    <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">{{trans("breadcrumb.$first")}}</h4>

        {{-- (-) one because I want remove language segment --}}
        @if( $count - 1 >= 3)
        <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans("breadcrumb.$parent")}}</span>
        @endif
        <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans("breadcrumb.$last")}}</span>
    </div>
</div>
