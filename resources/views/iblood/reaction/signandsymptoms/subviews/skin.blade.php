<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Skin</h4>
    </div>
</div>
<div class="card-body flex-grow-1 d-flex flex-column">
    <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
        <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="skinoed" id="skinoed" name="skinoed" {{ in_array('skinoed', $record->skin ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="skinoed">
                            Oedema
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="skinflush" id="skinflush" name="skinflush" {{ in_array('skinflush', $record->skin ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="skinflush">
                            Flushing
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="skinhives" id="skinhives" name="skinhives" {{ in_array('skinhives', $record->skin ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="skinhives">
                            Hives
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="skinitch" id="skinitch" name="skinitch" {{ in_array('skinitch', $record->skin ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="skinitch">
                            Itching
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="skinpallor" id="skinpallor" name="skinpallor" {{ in_array('skinpallor', $record->skin ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="skinpallor">
                            Pallor
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="skinjaun" id="skinjaun" name="skinjaun" {{ in_array('skinjaun', $record->skin ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="skinjaun">
                            Jaundice
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="skinurti" id="skinurti" name="skinurti" {{ in_array('skinurti', $record->skin ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="skinurti">
                            Urticaria
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="skinpete" id="skinpete" name="skinpete" {{ in_array('skinpete', $record->skin ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="skinpete">
                            Petechiae
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="skinrash" id="skinrash" name="skinrash" {{ in_array('skinrash', $record->skin ?? []) ? 'checked' : '' }}/>
                        <label class="form-check-label" for="skinrash">
                            Rash
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>