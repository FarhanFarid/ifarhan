<!DOCTYPE html>
<html lang="en" >
    <!--begin::Head-->
    <head>
        <title>iCLIC</title>
        <meta charset="utf-8"/>
        <meta name="description" content="IJN iCLIC System"/>
        <meta name="keywords" content="iclinical ijn, ijn"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="IJN iCLIC" />
        <meta property="og:url" content="https://uat-iclinical.awan.info/"/>
        <meta property="og:site_name" content="IJN iCLIC" />
        <link rel="shortcut icon" href="{{ asset('media/logo/ijn-logo.png') }}" />

        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
        <!--end::Fonts-->

        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('theme/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('theme/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <!--end::Global Stylesheets Bundle-->
          
        <script>
            // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>
    </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body id="kt_body" class="app-blank">
        <!--begin::Theme mode setup on page load-->
            <script>
            	var defaultThemeMode = "light";
            	var themeMode;

            	if ( document.documentElement ) {
            		if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
            			themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            		} else {
            			if ( localStorage.getItem("data-bs-theme") !== null ) {
            				themeMode = localStorage.getItem("data-bs-theme");
            			} else {
            				themeMode = defaultThemeMode;
            			}			
            		}

            		if (themeMode === "system") {
            			themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            		}

            		document.documentElement.setAttribute("data-bs-theme", themeMode);
            	}            
            </script>
        <!--end::Theme mode setup on page load-->   
        
        <!--begin::Root-->
            @yield('content')
        <!--end::Root-->
        <!--begin::Javascript-->
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
            <script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js') }}"></script>
            <script src="{{ asset('theme/assets/js/scripts.bundle.js') }}"></script>
        <!--end::Global Javascript Bundle-->
        <script src="{{ asset('js/custm.js') }}"></script>
        <!--end::Javascript-->
        @stack('script')
    </body>
    <!--end::Body-->
</html>