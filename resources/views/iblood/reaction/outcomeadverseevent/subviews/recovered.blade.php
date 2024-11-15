<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important; position: relative;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Procedure</h4>
    </div>
    <div style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #333; padding-top:2px;">
        <small>
            <b>Last Updated By:</b> 
            {{ $outcomeadverseevent && $outcomeadverseevent->updatedby ? $outcomeadverseevent->updatedby->name : ($outcomeadverseevent && $outcomeadverseevent->createdby ? $outcomeadverseevent->createdby->name : '-') }}
        </small><br>
    
        <small>
            <b>Updated At:</b> 
            {{ $outcomeadverseevent && $outcomeadverseevent->updated_at ? \Carbon\Carbon::parse($outcomeadverseevent->updated_at)->format('d/m/Y H:i') : ($outcomeadverseevent && $outcomeadverseevent->created_at ? \Carbon\Carbon::parse($outcomeadverseevent->created_at)->format('d-m-Y H:i') : '-') }}
        </small>
    </div>
</div>
<div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
    <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="noill" id="noill"  name="noill" {{ in_array('noill', $outcomeadverseevent->recovered  ?? []) ? 'checked' : '' }} />
                    <label class="form-check-label" for="flexCheckDefault">
                        No ill effect
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="adverseoutcomeillness" id="adverseoutcomeillness" name="adverseoutcomeillness" {{ in_array('adverseoutcomeillness', $outcomeadverseevent->recovered  ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label mb-2" for="adverseoutcomeillness">
                        Illness (morbidity)
                    </label>
                    <input type="text" class="form-control form-control-sm" id="adverseoutcomeillnessinput" name="adverseoutcomeillnessinput" placeholder="Please specify"  value="{{ $outcomeadverseevent->morbidity  ?? ''}}" style="{{ in_array('adverseoutcomeillness', $outcomeadverseevent->recovered  ?? []) ? '' : 'display: none;' }}"/>
                </div>
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-check-label">Timeframe of recovery</label>
                <input type="text" class="form-control form-control-sm" id="timeframerecovery" name="timeframerecovery" value="{{ $outcomeadverseevent->timeframe  ?? ''}}"/>
            </div>
        </div>
    </div>
</div>