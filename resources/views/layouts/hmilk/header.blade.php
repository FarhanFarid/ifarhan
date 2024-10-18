<title>iCLIC</title>
<meta charset="utf-8" />
<meta name="description" content="IJN iCLIC System"/>
<meta name="keywords" content="iclic ijn, ijn"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="IJN iCLIC" />
<meta property="og:url" content="https://uat-iclinical.awan.info/"/>
<meta property="og:site_name" content="IJN iCLIC" />
<link rel="shortcut icon" href="{{ asset('media/logo/ijn-logo.png') }}" />
<!--begin::Fonts(mandatory for all pages)-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
<link href="{{ asset('theme/assets/plugins/global/plugins.bundle.cs') }}s" rel="stylesheet" type="text/css" />
<link href="{{ asset('theme/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!--end::Global Stylesheets Bundle-->
@stack('css')