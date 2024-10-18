<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Pain</h4>
    </div>
</div>
<div class="card-body flex-grow-1 d-flex flex-column">
    <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
        <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="paininfuse" id="paininfuse" name="paininfuse" {{ in_array('paininfuse', $record->pain  ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="paininfuse">
                            Infusion site pain
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="painabdo" id="painabdo" name="painabdo" {{ in_array('painabdo', $record->pain ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="painabdo">
                            Abdominal pain
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="painflank" id="painflank" name="painflank" {{ in_array('painflank', $record->pain ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="painflank">
                            Flank pain
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="painchest" id="painchest" name="painchest" {{ in_array('painchest', $record->pain ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="painchest">
                            Chest pain
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="painhead" id="painhead" name="painhead" {{ in_array('painhead', $record->pain ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="painhead">
                            Headache
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="painback" id="painback" name="painback" {{ in_array('painback', $record->pain ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="painback">
                            Back pain
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="signsymptomspainother" id="signsymptomspainother" name="signsymptomspainother" {{ in_array('signsymptomspainother', $record->pain ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="signsymptomspainother">
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
                    <input type="text" class="form-control form-control-sm" id="signsymptomspainotherinput" name="signsymptomspainotherinput" placeholder="Please specify" value="{{ $record->others_pain  ?? ''}}" style="{{ in_array('signsymptomspainother', $record->pain  ?? []) ? '' : 'display: none;' }}"/>
                </div>
            </div>
        </div>
    </div>
</div>