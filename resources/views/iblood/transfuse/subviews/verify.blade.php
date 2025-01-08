<div class="modal fade modal-md" tabindex="-1" id="verify-transfusion" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3; ">SECOND VERIFIER</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="card-body">
                            <div class="row m-3">
                                <div class="col-md-12" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center">
                                            <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #ff0000;">IMPORTANT INFORMATION</h4>
                                        </div>
                                        <ol>
                                            <li style="color: #1d69e3;">Every adverse event related to transfusion of blood or blood component shall be managed, investigated and documented accordingly.</li>
                                            <li style="color: #1d69e3;">The form must be completed within 2 weeks of the incident.</li>
                                            <li style="color: #1d69e3;">The blood bank shall retain the completed form and send a copy to the State Transfusion Committee and the National Haemovigilance Coordinating Centre (NHCC), Pusat Darah Negara within a month.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="card-body">
                            <form id="#">
                                @csrf
                                <div class="row m-3">
                                    <div class="col-md-12" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important;">
                                        <div class="card card-custom gutter-b mb-3 mt-1" style="border-radius: 0px !important; background-color: #e9f2ff;">
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">STAFF DETAILS</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Username</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="username" id="username">
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Password</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="password" name="password" id="password">
                                                    <input class="form-control" type="hidden" name="bagnumber" id="bagnumber">
                                                    <input class="form-control" type="hidden" name="mrnumber" id="mrnumber">
                                                    <input class="form-control" type="hidden" name="lbNumber" id="lbNumber">
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Transfuse Date</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control form-control-solid" type="datetime-local" name="actualtransfusedate" id="actualtransfusedate" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3" id="transfusereason" style="display: none;">
                                                <div class="col-md-4 pt-4">
                                                    <b>Change Date Reason</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" name="transfusecdreason" id="transfusecdreason">
                                                        <option></option>
                                                        <option value="Emergency/Severe Case">Emergency/Severe Case</option>
                                                        <option value="System Down/Code White">System Down/Code White</option>
                                                        <option value="Misconduct/Malpractice">Misconduct/Malpractice</option>
                                                        <option value="Hardware Malfunction">Hardware Malfunction</option>
                                                        <option value="Late Entry">Late Entry</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="verifyDetail" class="align-self-end btn btn-danger btn-sm font-weight-bold btn-block mt-3 mb-3" style="margin-top: auto;">{{__('SUBMIT')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <button type="button" class="btn btn-light btn-sm font-weight-bold btn-block" data-bs-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>