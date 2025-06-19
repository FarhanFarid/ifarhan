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

<style>
    #bloodinventory-table th, 
    #bloodinventory-table td {
        text-align: center;
        vertical-align: middle;
    }

    #bloodinventory-table .row {
        justify-content: center;
    }

    .badge {
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }

    /* Hover Effect */
    .text-hover-success:hover {
        color: #14787c !important;
    }

    /* Icon rotation on expand */
    .rotate-90 {
        transform: rotate(90deg);
    }

    /* Submenu padding */
    .row {
        padding-left: 10px;
    }

    /* Submenu item styling */
    #ibloodSubmenu a, #idaSubmenu a, #iNurSubmenu a
     {
        font-size: 0.9rem;
        padding: 5px;
        display: block;
        border-left: solid 3px transparent;
        transition: all 0.3s;
    }

    /* Active submenu item */
    #ibloodSubmenu a.text-teal, #idaSubmenu a.text-teal, #iNurSubmenu a.text-teal {
        border-color: #14787c;
        color: #14787c !important;
        font-weight: bold;
    }

    /* Submenu hover effect */
    #ibloodSubmenu a:hover, #idaSubmenu a:hover, #iNurSubmenu a:hover {
        background-color: #f8f9fa;
        border-color: #14787c;
        padding-left: 15px;
    }
</style>
@stack('css')