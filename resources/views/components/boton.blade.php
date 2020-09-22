<!--begin::Button-->
<a href="{{ $slot }}" {{ $attributes->merge(['class'=>'btn font-weight-bolder']) }}>
<span class="svg-icon svg-icon-md">
    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        {{ $svg }}
    </svg>
    <!--end::Svg Icon-->
</span>{{ $title }}</a>
<!--end::Button-->