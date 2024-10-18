<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Vital Sign (Prior to Reaction)</h4>
    </div>
</div>
<div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
    <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="vitaltemp" class="required form-label">Temperature (◦C)</label>
                <input type="text" class="form-control form-control-solid" id="vitaltemp" name="vitaltemp" value="{{$vitaltemp}}"/>
            </div>
            <div class="col-md-3">
                <label for="exampleFormControlInput1" class="required form-label">Blood Pressure</label>
                <div class="row">
                    <div class="col-5">
                        <input type="text" class="form-control form-control-solid" id="vitalsysto" name="vitalsysto" value="{{ $vitalsysto}}"/>
                    </div>
                    <div class="col-1" style="display:block; vertical-align: middle;">
                        /
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control form-control-solid" id="vitaldysto" name="vitaldysto" value="{{ $vitaldysto}}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <label for="vitalpulse" class="required form-label">Pulse Rate</label>
                <input type="text" class="form-control form-control-solid" id="vitalpulse" name="vitalpulse" value="{{ $vitalpulse}}"/>
            </div>
            <div class="col-md-2">
                <label for="vitalspo" class="required form-label">SPO2</label>
                <input type="text" class="form-control form-control-solid" id="vitalspo" name="vitalspo" value="{{ $vitalspo}}"/>
            </div>
            <div class="col-md-2">
                <label for="vitalrr" class="required form-label">Respiratory Rate</label>
                <input type="text" class="form-control form-control-solid" id="vitalrr" name="vitalrr" value="{{ $record->respirate  ?? ''}}"/>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Vital Sign (At Time of Reaction)</h4>
    </div>
</div>
<div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
    <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="reactvitaltemp" class="required form-label">Temperature (◦C)</label>
                <input type="text" class="form-control form-control-solid" id="reactvitaltemp" name="reactvitaltemp" value="{{ $record->reacttemp  ?? ''}}"/>
            </div>
            <div class="col-md-3">
                <label for="exampleFormControlInput1" class="required form-label">Blood Pressure</label>
                <div class="row">
                    <div class="col-5">
                        <input type="text" class="form-control form-control-solid" id="reactvitalsysto" name="reactvitalsysto" value="{{ $record->reactsysto  ?? ''}}"/>
                    </div>
                    <div class="col-1" style="display:block; vertical-align: middle;">
                        /
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control form-control-solid" id="reactvitaldysto" name="reactvitaldysto" value="{{ $record->reactdiasto  ?? ''}}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <label for="reactvitalpulse" class="required form-label">Pulse Rate</label>
                <input type="text" class="form-control form-control-solid" id="reactvitalpulse" name="reactvitalpulse" value="{{ $record->reactpulse  ?? ''}}"/>
            </div>
            <div class="col-md-2">
                <label for="reactvitalspo" class="required form-label">SPO2</label>
                <input type="text" class="form-control form-control-solid" id="reactvitalspo" name="reactvitalspo" value="{{ $record->reactspo  ?? ''}}"/>
            </div>
            <div class="col-md-2">
                <label for="reactvitalrr" class="required form-label">Respiratory Rate</label>
                <input type="text" class="form-control form-control-solid" id="reactvitalrr" name="reactvitalrr" value="{{ $record->reactrr  ?? ''}}"/>
            </div>
        </div>
    </div>
</div>



