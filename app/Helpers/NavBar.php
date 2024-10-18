<?php

namespace App\Helpers;

//models
use App\Models\QuippeItem;

use DB;
use Auth;
use Carbon\Carbon;

class NavBar 
{
	public function navsidebar()
    {
		if(Auth::user()->usergrp == "Doctors")
        {
            $holdview = [env('Doctor'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "EMYDoctors")
        {
            $holdview = [env('Doctor'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "WardNurse" || Auth::user()->usergrp == "WardNursePrivate" || Auth::user()->usergrp == "WardClerk")
        {
            $holdview = [env('WardNurse'), env('WardNurse2'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "OPDNurse" || Auth::user()->usergrp == "OPDNursePrivate" || Auth::user()->usergrp == "WardClerk")
        {
            $holdview = [env('OPDNurse'), env('OPDNurse2'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "EMY")
        {
            $holdview = [env('EMY'), env('EMY2'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "Dietary")
        {
            $holdview = [env('Dietitian'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "CVT Technologist")
        {
            $holdview = [env('CVTTechnologist'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "Physiotherapist")
        {
            $holdview = [env('Physiotherapist'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "OTNurse")
        {
            $holdview = [env('OTNurse'), env('OPDNurse2'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "Perfusionist")
        {
            $holdview = [env('Perfusionist'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "Radiology")
        {
            $holdview = [env('Radiology'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "RadiologyExecutive")
        {
            $holdview = [env('RadiologyExecutive'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "Pharmacist")
        {
            $holdview = [env('Pharmacist'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "ICLNurse")
        {
            $holdview = [env('ICLNurse'), env('ICLNurse2'), env('MDT')];
        }
        else if(Auth::user()->usergrp == "CardiacRehab")
        {
            $holdview = [env('MDT')];
        }
        else if(Auth::user()->usergrp == "Diabetes")
        {
            $holdview = [env('MDT')];
        }
        else if(Auth::user()->usergrp == "Administrator")
        {
            $holdview = [env('Doctor'), env('WardNurse'), env('WardNurse2'), env('OPDNurse'), env('OPDNurse2'), env('EMY'), env('EMY2'), env('Dietitian'), env('ICLNurse'), env('ICLNurse2'), env('MDT')];
        }
        else
        {
            $holdview = null;
        }

        if ($holdview != null)
        {
            $NavBar = QuippeItem::whereIn('ParentId', $holdview)
                ->where('TypeName', 'template')
                ->get();
        }
        else
        {
            $NavBar = [];
        }

        if (Auth::user()->usergrp == "Administrator")
        {
            $holdviewcpw = [env('ITTeamCPW')];
        }
        else
        {
            $holdviewcpw = [env('ITTeamCPW')];
        }

        if ($holdviewcpw != null)
        {
            $NavBarCpw = QuippeItem::whereIn('ParentId', $holdviewcpw)
                ->where('TypeName', 'template')
                ->get();
        }
        else
        {
            $NavBarCpw = [];
        }
		
		$data['NavBar']       = $NavBar;
		$data['NavBarCpw']    = $NavBarCpw;
		
		return $data;
	}
}