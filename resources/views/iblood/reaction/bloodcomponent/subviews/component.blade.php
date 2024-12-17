<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important; position: relative;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Procedure</h4>
    </div>
    <div style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #333; padding-top:2px;">
        <small>
            <b>Last Updated By:</b> 
            {{ $component && $component->updatedby ? $component->updatedby->name : ($component && $component->createdby ? $component->createdby->name : '-') }}
        </small><br>
    
        <small>
            <b>Updated At:</b> 
            {{ $component && $component->updated_at ? \Carbon\Carbon::parse($component->updated_at)->format('d/m/Y H:i') : ($component && $component->created_at ? \Carbon\Carbon::parse($component->created_at)->format('d-m-Y H:i') : '-') }}
        </small>
    </div>
</div>
<div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
    <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
        <div class="row mb-5">
            <div class="row mb-2">
                <div class="d-flex justify-content-center">
                    <h5 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #797979;"><u>Blood Component</u></h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-3">
                    <input class="form-check-input form-check-input" type="checkbox" value="wholeblood" id="wholeblood" name="wholeblood" {{ (isset($inventory) && $inventory->product == "WHOLE BLOOD")  || in_array('wholeblood', $component->product ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Whole Blood
                    </label>
                </div>
                <div class="col-3">
                    <input class="form-check-input form-check-input" type="checkbox" value="packcell" id="packcell" name="packcell" {{ (isset($inventory) && $inventory->product == "PACKED CELL") || in_array('packcell', $component->product ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Packed Cell
                    </label>
                </div>
                <div class="col-3">
                    <input class="form-check-input form-check-input" type="checkbox" value="apheresis" id="apheresis" name="apheresis" {{ (isset($inventory) && $inventory->product == "APHERESIS PLATELET") || in_array('apheresis', $component->product ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Apheresis Platelet
                    </label>
                </div>
                <div class="col-3">
                    <input class="form-check-input form-check-input" type="checkbox" value="random" id="random" name="random" {{ (isset($inventory) && $inventory->product == "PLATELET CONC.") || in_array('random', $component->product ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Random Platelet
                    </label>
                </div>
            </div> 
            <div class="row mb-3">
                <div class="col-3">
                    <input class="form-check-input form-check-input" type="checkbox" value="ffp" id="ffp" name="ffp" {{ (isset($inventory) && $inventory->product == "FFP.") || in_array('ffp', $component->product ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Fresh Frozen Plasma
                    </label>
                </div>
                <div class="col-3">
                    <input class="form-check-input form-check-input" type="checkbox" value="cryoppt" id="cryoppt" name="cryoppt" {{ (isset($inventory) && $inventory->product == "CRYOPPT") || in_array('cryoppt', $component->product ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Cryoprecipitate
                    </label>
                </div>
                <div class="col-3">
                    <input class="form-check-input form-check-input" type="checkbox" value="cryosuper" id="cryosuper" name="cryosuper" {{ (isset($inventory) && $inventory->product == "CRYOSUPERNATANT") || in_array('cryosuper', $component->product ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Cryosupernatant/ Liver plasma
                    </label>
                </div>
                <div class="col-3">
                    <input class="form-check-input form-check-input" type="checkbox" value="others" id="others" name="others" {{ (isset($inventory) && $inventory->product == "OTHERS") || in_array('others', $component->product ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        Others (please specify)
                    </label>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-3">
                    
                </div>
                <div class="col-3">
                    
                </div>
                <div class="col-3">
                    
                </div>
                <div class="col-3">
                    <input type="text" class="form-control form-control-sm" id="otherscomponent" name="otherscomponent" placeholder="Please specify"  style="display: none;" value="{{ $inventory->product  ?? ''}}" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="emergencycross" class="form-check-label mb-2">Irridiated (if applicable)</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="yes" id="irridiated" name="irridiated"  {{ (isset($component) && $component->irridiated == "yes") ? 'checked' : '' }}/>
                                <label class="form-check-label" for="yes">
                                    YES
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="no" id="irridiated" name="irridiated" {{ (isset($component) && $component->irridiated == "no") ? 'checked' : '' }}/>
                                <label class="form-check-label" for="no">
                                    NO
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="emergencycross" class="form-check-label mb-2">Filtered (if applicable)</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="yes" id="filtered" name="filtered" {{ (isset($component) && $component->filtered == "yes") ? 'checked' : '' }}/>
                                <label class="form-check-label" for="yes">
                                    YES
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="no" id="filtered" name="filtered" {{ (isset($component) && $component->filtered == "no") ? 'checked' : '' }}/>
                                <label class="form-check-label" for="no">
                                    NO
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="emergencycross" class="form-check-label mb-2">Pathogen Inactivated (if applicable)</label>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="yes" id="pathogen" name="pathogen" {{ (isset($component) && $component->pathogen == "yes") ? 'checked' : '' }}/>
                                <label class="form-check-label" for="yes">
                                    YES
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="no" id="pathogen" name="pathogen" {{ (isset($component) && $component->pathogen == "no") ? 'checked' : '' }}/>
                                <label class="form-check-label" for="no">
                                    NO
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </div>
</div>