<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Renal</h4>
    </div>
</div>
<div class="card-body flex-grow-1 d-flex flex-column">
    <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
        <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="renaloli" id="renaloli" name="renaloli" {{ in_array('renaloli', $record->renal ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="renaloli">
                            Oliguria
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="renalurine" id="renalurine" name="renalurine" {{ in_array('renalurine', $record->renal ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="renalurine">
                            Dark coloured urine
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="renalanu" id="renalanu" name="renalanu" {{ in_array('renalanu', $record->renal ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="renalanu">
                            Anuria
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>