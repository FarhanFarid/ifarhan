<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Death</h4>
    </div>
</div>
<div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
    <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="unlikely" id="unlikely"  name="unlikely" {{ in_array('unlikely', $outcomeadverseevent->death  ?? []) ? 'checked' : '' }} />
                    <label class="form-check-label" for="flexCheckDefault">
                        Unlikely Related to Transfusion
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="probable" id="probable"  name="probable" {{ in_array('probable', $outcomeadverseevent->death  ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="flexCheckDefault">
                        Probable Related to Transfusion
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="possible" id="possible"  name="possible" {{ in_array('possible', $outcomeadverseevent->death  ?? []) ? 'checked' : '' }}/>
                    <label class="form-check-label" for="flexCheckDefault">
                        Possible Related to Transfusion
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>