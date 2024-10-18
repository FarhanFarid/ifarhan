<div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 5px #14787c !important;">
    <div class="card-body" style="padding: 0.75rem !important;">
        <div class="row">
            <div class="col-4">
                <span id="patientinfoname"></span>
                <br />
                <b>MRN</b>: <span id="patientinfomrn"></span>
                <br />
                <b>Episode No.</b> : <span id="patientinfoepsnum"></span>
                <br />
                <b>Episode Date</b>: <span id="patientinfoepsnumdate"></span>
            </div>
            <div class="col-2">
                <b>DOB</b>: <span id="patientinfodob"></span>
                <br />
                <b>Age</b>: <span id="patientinfoage"></span>
                <br />
                <b>Sex</b>: <span id="patientinfosex"></span>
                <br />
                <b>Race</b>: <span id="patientinforace"></span>
                <br />
            </div>
            <div class="col-3">
                <b>Blood Type</b>: <span id="patientinfobloodtype"></span>
                <br />
                <b>Allergy</b>: <span id="patientinfoallergy"></span>
                <br />
                <b>Payor</b>: <span id="patientinfopayor"></span>
                <br />
                <b>Religion</b>: <span id="patientinforeligion"></span>
                <div id="ifcpwnotnone" style="display: none;">
                    <b>CPW</b>: <span id="patientinfocpw"></span>
                </div>
            </div>
            <div class="col-2">
                <b>Weight</b>: <span id="patientinfoweight"></span>&nbsp;kg
                <br />
                <b>Height</b>: <span id="patientinfoheight"></span>&nbsp;cm
                <br />
                <b>BMI</b>: <span id="patientinfobmi"></span>&nbsp;kg/m&sup2
                <br />
                <b>BSA</b>: <span id="patientinfobsa"></span>&nbsp;m&sup2
            </div>
            <div class="col-1 ps-0 text-center ">
                <button type="button" class="btn btn-primary btn-md font-weight-bold save-button-subjective mb-1" style="display: none; position: absolute; top: 32%;">{{__('SAVE')}}</button>
                <button type="button" class="btn btn-primary btn-md font-weight-bold save-button-objective mb-1" style="display: none; position: absolute; top: 32%;">{{__('SAVE')}}</button>
                <button type="button" class="btn btn-primary btn-md font-weight-bold save-button-plan mb-1" style="display: none; position: absolute; top: 32%;">{{__('SAVE')}}</button>
                <!-- Physio -->
				@if(request()->routeIs('iali.physiotherapist') || request()->routeIs('iali.physiotherapist.assessment') || request()->routeIs('iali.assessment'))
					@if($diffHours > 24 )
						<br>
					@endif
					
					@if(!empty($form_id))
						<a href="{{url('iali/physiotherapist/assessment/'.$form.'?'.$url)}}" class="btn btn-secondary btn-sm font-weight-bold px-3 w-100" >{{__('NEW')}}</a>
					@endif
					<!--a href="{{url('iali/physiotherapist/assessment-previous-encounter-entry/'.$form.'?'.$url)}}" class="btn btn-secondary btn-sm font-weight-bold px-3 w-100" >{{__('Previous')}}</a-->
					<?php if($diffHours <= 24 ){?>
						<hr class="my-3">
						<button type="button" class="btn btn-primary btn-sm font-weight-bold w-100 save-button-iali-assesment " >{{__('SAVE')}}</button>
					<?php } ?>
                @endif
				
				<!-- 6MWT -->
				@if(request()->routeIs('iali.six_minute_walk_test'))
					@if($diffHours > 24 )
						<br>
					@endif
					@if(!empty($form_id))
						<a href="{{url('iali/sixMWT/?'.$url)}}" class="btn btn-secondary btn-sm font-weight-bold px-3 w-100" >{{__('NEW')}}</a>
					@endif
					<?php if($diffHours <= 24 ){?>
						<hr class="my-3">
						<button type="button" class="btn btn-primary btn-sm font-weight-bold w-100 save-button-iali-assesment " >{{__('SAVE')}}</button>
					<?php } ?>
                @endif
				
				<!-- BERG Test -->
				@if(request()->routeIs('iali.berg_test'))
					@if($diffHours > 24 )
						<br>
					@endif
					@if(!empty($form_id))
						<a href="{{url('iali/bergTest/?'.$url)}}" class="btn btn-secondary btn-sm font-weight-bold px-3 w-100" >{{__('NEW')}}</a>
					@endif
					<?php if($diffHours <= 24 ){?>
						<hr class="my-3">
						<button type="button" class="btn btn-primary btn-sm font-weight-bold w-100 save-button-iali-assesment " >{{__('SAVE')}}</button>
					<?php } ?>
                @endif
				
                @if(request()->routeIs('iali.counsellor.spiritualcare'))
                    <button type="button" class="btn btn-primary btn-md font-weight-bold save-button-iali-counsellor-spiritual mb-1" style="display: block; position: absolute; top: 32%;">{{__('SAVE')}}</button>
                @endif
                @if(request()->routeIs('iali.counsellor.counsellingservice') )
					<button type="button" class="btn btn-primary btn-md font-weight-bold save-button-iali-counsellor-service mb-1" style="display: block; position: absolute; top: 32%;">{{__('SAVE')}}</button>					
                @endif
            </div>
        </div>
    </div>
</div>