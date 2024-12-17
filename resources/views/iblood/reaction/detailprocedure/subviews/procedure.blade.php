<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important; position: relative;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Procedure</h4>
    </div>
    <div style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #333; padding-top:2px;">
        <small>
            <b>Last Updated By:</b> 
            {{ $procedure && $procedure->updatedby ? $procedure->updatedby->name : ($procedure && $procedure->createdby ? $procedure->createdby->name : '-') }}
        </small><br>
    
        <small>
            <b>Updated At:</b> 
            {{ $procedure && $procedure->updated_at ? \Carbon\Carbon::parse($procedure->updated_at)->format('d/m/Y H:i') : ($procedure && $procedure->created_at ? \Carbon\Carbon::parse($procedure->created_at)->format('d-m-Y H:i') : '-') }}
        </small>
    </div>
</div>
<div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
    <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
        
        <div class="row mb-5">
            <div class="col-md-6">
                <label for="surgery" class="form-check-label">Name of procedure / surgery</label>
                <input type="text" class="form-control form-control-sm" id="surgery" name="surgery" value="{{ $procedure->surgery ?? $latestsurgical ?? '' }}" />            
            </div> 
        </div>
        <div class="row mb-5">
            <div class="col-md-4">
                <label for="bypass" class="form-check-label mb-2">On bypass machine</label>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="yes" id="bypass-yes" name="bypass" {{ isset($procedure) && $procedure->bypass == 'yes' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="bypass">
                                YES
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="no" id="bypass-no" name="bypass" {{ isset($procedure) && $procedure->bypass == 'no' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="bypass">
                                NO
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="warmer" class="form-check-label mb-2">Use of blood warmer</label>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="yes" id="warmer" name="warmer" {{ isset($procedure) && $procedure->warmer == 'yes' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="yes">
                                YES
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="no" id="warmer" name="warmer" {{ isset($procedure) && $procedure->warmer == 'no' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="no">
                                NO
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="drip" class="form-check-label mb-2">Starting drip solution used</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="normal" id="drip-normal" name="drip" {{ isset($procedure) && $procedure->drip == 'normal' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="yes">
                                Normal Saline
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="dextrose" id="drip-drex" name="drip" {{ isset($procedure) && $procedure->drip == 'dextrose' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="no">
                                5% Dextrose
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="others" id="drip-others" name="drip" {{ isset($procedure) && $procedure->drip == 'others' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="no">
                                Others
                            </label>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="row mb-5">
            <div class="col-md-4">
                <input type="text" class="form-control form-control-sm" id="durationbypass" name="durationbypass" placeholder="Duration on Bypass machine" value="{{ $procedure->durationbypass  ?? ''}}" style="{{ isset($procedure) && $procedure->bypass == 'yes'  ? '' : 'display: none;' }}"/>
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <input type="text" class="form-control form-control-sm" id="dripothers" name="dripothers" placeholder="Please specify" value="{{ $procedure->dripother  ?? ''}}"  style="{{ isset($procedure) && $procedure->drip == 'others'  ? '' : 'display: none;' }}"/>
            </div>
        </div>
    </div>
</div>