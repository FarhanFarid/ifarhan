<?php

namespace App\Helpers;

//models
use App\Models\PatientInformation;
use App\Models\IdaGeneral; 
use App\Models\IdagPlanreferredto;
use App\Models\IdagReassessment;

use DB;
use Auth;
use Carbon\Carbon;

class NavIDA 
{
	public function nav_ida($episodeno=null,$username=null)
    {
		$holdcode = $episodeno;
		$checkPatInfo = PatientInformation::where('episodenumber', $episodeno)
                        ->where('status_id', 2)
                        ->first();

        if($checkPatInfo['pchcflag'] == "Y")
        {
            if($checkPatInfo['episodedept'] == "CT" || $checkPatInfo['episodedept'] == "CTP")
            {
                $yesep      = 0;
                $yesiop     = 0;
                $yespchc    = 1;
                $yesct      = 0;
            }
            else if($checkPatInfo['episodedept'] == "EMY")
            {
                $yesep      = 0;
                $yesiop     = 0;
                $yespchc    = 1;
                $yesct      = 0;
            }
            else
            {
                $yesep      = 0;
                $yesiop     = 0;
                $yespchc    = 1;
                $yesct      = 0;
            }
        }
        else
        {
            if($checkPatInfo['episodedept'] == "CT" || $checkPatInfo['episodedept'] == "CTP")
            {
                $yesep      = 0;
                $yesiop     = 0;
                $yespchc    = 0;
                $yesct      = 1;
            }
            else if($checkPatInfo['episodedept'] == "EMY")
            {
                $yesep      = 1;
                $yesiop     = 0;
                $yespchc    = 0;
                $yesct      = 0;
            }
            else
            {
                $yesep      = 0;
                $yesiop     = 1;
                $yespchc    = 0;
                $yesct      = 0;
            }
        }

        if($holdcode != null)
        {
            $getIdaGeneral = IdaGeneral::where('episodeno', $holdcode)
                            ->where('status_id', 2)
                            ->first();

            if($getIdaGeneral != null)
            {
                $getDate24 = Carbon::parse($getIdaGeneral['created_at'])->addDays(1);

                if(Carbon::now() > $getDate24)
                {
                    $canunlock = 0;
                }
                else
                {
                    $canunlock = 1;
                }

                $getDate24Re = Carbon::parse($getIdaGeneral['completedat'])->addDays(1);

                if(Carbon::now() > $getDate24Re)
                {
                    $canunlockre = 0;
                }
                else
                {
                    $canunlockre = 1;
                }

                $holdlockstatus = $getIdaGeneral['islock'];
                $createdid      = $getIdaGeneral->created_by;

                $getreferredto = IdagPlanreferredto::where('episodeno', $holdcode)
                                    ->where('status_id', 2)
                                    ->where('specific', $username)
                                    ->first();

                if($getreferredto != null)
                {
                    if($canunlockre == 1)
                    {
                        $getreas = IdagReassessment::where('episodeno', $holdcode)
                                    ->where('status_id', 2)
                                    ->where('reassessmentactivity', null)
                                    ->first();

                        if($getreas != null)
                        {
                            $showreassessment = 1;
                        }
                        else
                        {
                            $showreassessment = 0;
                        }
                    }
                    else
                    {
                        $showreassessment = 0;
                    }
                }
                else
                {
                    $showreassessment = 0;
                }
            }
            else
            {
                $holdlockstatus     = 0;
                $createdid          = 0;
                $canunlock          = 0;
                $canunlockre        = 0;
                $showreassessment   = 0;
            }
        }
        else
        {
            $holdlockstatus     = 0;
            $createdid          = 0;
            $canunlock          = 0;
            $canunlockre        = 0;
            $showreassessment   = 0;
        }
		
		$data['yesiop'] 	= $yesiop;
        $data['yesep'] 		= $yesep;
        $data['yespchc'] 	= $yespchc;
        $data['yesct'] 		= $yesct;
        $data['holdlockstatus'] 	= $holdlockstatus;
        $data['createdid'] 			= $createdid;
        $data['canunlock'] 			= $canunlock;
        $data['canunlockre'] 				= $canunlockre;
        $data['showreassessment'] 			= $showreassessment;
        
		return $data; 
	}
}