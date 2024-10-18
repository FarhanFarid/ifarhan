<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">General</h4>
    </div>
</div>
<div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
    <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="genchill" id="genchill" name="genchill" {{ in_array('genchill', $record->general ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="genchill">
                        Chill
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="genvomit" id="genvomit" name="genvomit" {{ in_array('genvomit', $record->general ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="genvomit">
                        Vomiting
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="gennausea" id="gennausea" name="gennausea" {{ in_array('gennausea', $record->general ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="gennausea">
                        Nausea
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="genanxiety" id="genanxiety" name="genanxiety" {{ in_array('genanxiety', $record->general ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="genanxiety">
                        Restless/Anxiety
                    </label>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="genrigors" id="genrigors" name="genrigors" {{ in_array('genrigors', $record->general ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="genrigors">
                        Rigors
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="gencyano" id="gencyano" name="gencyano" {{ in_array('gencyano', $record->general ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="gencyano">
                        Cyanosis
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="genfever" id="genfever" name="genfever" {{ in_array('genfever', $record->general ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="genfever">
                        Fever
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="genhemor" id="genhemor" name="genhemor" {{ in_array('genhemor', $record->general ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="genhemor">
                        Hemorrhage
                    </label>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="signsymptomsgeneralother" value="signsymptomsgeneralother" name="signsymptomsgeneralother" {{ in_array('signsymptomsgeneralother', $record->general ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="signsymptomsgeneralother">
                        Others (specify)
                    </label>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control form-control-sm" id="signsymptomsgeneralotherinput" name="signsymptomsgeneralotherinput" placeholder="Please specify"  style="display: none;" value="{{ $record->others_general  ?? '' }}" style="{{ in_array('signsymptomsgeneralother', $record->general  ?? []) ? '' : 'display: none;' }}"/>

            </div>
        </div>
    </div>
</div>