{{-- <div class="modal" id="patient-details" style="z-index: 10000 !important;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="max-width: 90% !important;"> --}}
<div class="modal fade modal-xl" tabindex="-1" id="patient-details" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9ffeb;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #228B22; ">PATIENT DETAILS</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="row mb-5">
                            <div class="col-md-12 mb-2">
                                <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9ffeb;">
                                    <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #228B22;">INFORMATIONS</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 5px228B22#1d69e3 !important;">
                                        <div class="card-body" style="padding: 0.75rem !important;">
                                            <div class="row">
                                                <div class="col-3">
                                                    <b>NAME</b>: <span id="patient-name"></span>
                                                    <br />
                                                    <b>MRN</b>: <span id="patient-mrn"></span>                                                    
                                                </div>
                                                <div class="col-3">
                                                    <b>Episode No.</b>: <span id="patient-epi"></span>
                                                    <br />
                                                    <b>Epsiode Date</b>: <span id="patient-epidate"></span>
                                                    <br />
                                                    <b>Episode Doctor</b>: <span id="patient-epidoc"></span>
                                                    <br />
                                                    <b>Epsiode Dept</b>: <span id="patient-epidept"></span>
                                                </div>
                                                <div class="col-2">
                                                    <b>DOB</b>: <span id="patient-dob"></span>
                                                    <br />
                                                    <b>Age</b>: <span id="patient-age"></span>
                                                    <br />
                                                    <b>Sex</b>: <span id="patient-sex"></span>
                                                </div>
                                                <div class="col-2">
                                                    <b>Blood Type</b>: <span id="patient-bloodtype"></span>
                                                    <br />
                                                    <b>GL Type</b>: <span id="patient-gltype"></span>
                                                    <br />
                                                    <b>Payor</b>: <span id="patient-payor"></span>
                                                </div>
                                                <div class="col-2">
                                                    <b>Weight</b>: <span id="patient-weight"></span> kg
                                                    <br />
                                                    <b>Height</b>: <span id="patient-height"></span> cm
                                                    <br />
                                                    <b>BMI</b>: <span id="patient-bmi"></span> kg/m2
                                                    <br />
                                                    <b>BSA</b>: <span id="patient-bsa"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-radius: 0px !important; background-color: #e9ffeb;">
                <button type="button" class="btn btn-light btn-sm font-weight-bold btn-block" data-bs-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>