<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Respiratory</h4>
    </div>
</div>
<div class="card-body flex-grow-1 d-flex flex-column">
    <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
        <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="respicough" id="respicough" name="respicough" {{ in_array('respicough', $record->respiratory ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="respicough">
                            Cough
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="respiwheeze" id="respiwheeze" name="respiwheeze" {{ in_array('respiwheeze', $record->respiratory ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="respiwheeze">
                            Wheezing
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="respihypox" id="respihypox" name="respihypox" {{ in_array('respihypox', $record->respiratory ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="respihypox">
                            Hypoxia
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="respidysp" id="respidysp" name="respidysp" {{ in_array('respidysp', $record->respiratory ?? []) ? 'checked' : '' }}>
                        <label class="form-check-label" for="respidysp">
                            Dyspnoea
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="signsymptomsrespiratoryother" id="signsymptomsrespiratoryother" name="signsymptomsrespiratoryother" {{ in_array('signsymptomsrespiratoryother', $record->respiratory ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="signsymptomsrespiratoryother">
                            Others (specify)
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-sm" id="signsymptomsrespiratoryotherinput" name="signsymptomsrespiratoryotherinput" placeholder="Please specify" value="{{ $record->others_respiratory  ?? ''}}" style="{{ in_array('signsymptomsrespiratoryother', $record->respiratory  ?? []) ? '' : 'display: none;' }}"/>
                </div>
            </div>
        </div>
    </div>
</div>