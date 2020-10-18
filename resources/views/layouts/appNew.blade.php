<!DOCTYPE html>
<html lang="es">
    <head>
        @include('layouts.meta')
        <!-- Extras -->
        @yield('head')
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        @include('includes.header-mobile')

        <div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
                @include('includes.aside')
                <!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    @include('includes.header')
                    <!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        @yield('content')
                    </div>
                    <!--end::Content-->
                    @include('includes.footer')
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>

        @include('includes.user-panel')
        @include('includes.scroll')
        <!-- Extras -->
        @include('includes.config')
        @yield('script')
    </body>
</html>
