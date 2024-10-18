<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Cardiovascular</h4>
    </div>
</div>
<div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
    <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="cardiochestpain" id="cardiochestpain"  name="cardiochestpain" {{ in_array('cardiochestpain', $record->cardio  ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="cardiochestpain">
                        Chest Pain
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="cardiopalpi" id="cardiopalpi" name="cardiopalpi" {{ in_array('cardiopalpi', $record->cardio  ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="cardiopalpi">
                        Palpitation
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="signsymptomscardioother" id="signsymptomscardioother" name="signsymptomscardioother" {{ in_array('signsymptomscardioother', $record->cardio  ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="signsymptomscardioother">
                        Others (specify)
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-3">

            </div>
            <div class="col-md-3">
                <input type="text" class="form-control form-control-sm" id="signsymptomscardiootherinput" name="signsymptomscardiootherinput" placeholder="Please specify"  style="display: none;" value="{{ $record->others_cardio  ?? ''}}" style="{{ in_array('signsymptomscardioother', $record->cardio  ?? []) ? '' : 'display: none;' }}"/>
            </div>
        </div>
    </div>
</div>