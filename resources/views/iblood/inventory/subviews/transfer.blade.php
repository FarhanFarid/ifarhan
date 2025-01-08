<div class="modal fade modal-md" tabindex="-1" id="transfer-location" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3; ">TRANSFER LOCATION</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="card-body">
                            <form id="#">
                                @csrf
                                <div class="row m-3">
                                    <div class="col-md-12" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important;">
                                        <div class="card card-custom gutter-b mb-3 mt-1" style="border-radius: 0px !important; background-color: #e9f2ff;">
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">TRANSFER DETAIL</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Location</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" name="transferLocation" id="transferLocation" data-control="select2" data-placeholder="Select Location">
                                                        <option></option>
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                    </select>
                                                    <input class="form-control" type="hidden" name="eNumber" id="eNumber" readonly>
                                                    <input class="form-control" type="hidden" name="bNumber" id="bNumber" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Transfer Date</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control form-control-solid" type="datetime-local" name="actualtransferdate" id="actualtransferdate" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3" id="transferreason" style="display: none;">
                                                <div class="col-md-4 pt-4">
                                                    <b>Change Date Reason</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" name="transfercdreason" id="transfercdreason">
                                                        <option></option>
                                                        <option value="Emergency/Severe Case">Emergency/Severe Case</option>
                                                        <option value="System Down/Code White">System Down/Code White</option>
                                                        <option value="Misconduct/Malpractice">Misconduct/Malpractice</option>
                                                        <option value="Hardware Malfunction">Hardware Malfunction</option>
                                                        <option value="Late Entry">Late Entry</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3" id="reasonreturn" style="display: none;">
                                                <div class="col-md-4 pt-4">
                                                    <b>Return reason</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" name="reason" id="reason">
                                                        <option></option>
                                                        <option value="Bleeding stopped">Bleeding stopped</option>
                                                        <option value="Circulation overloaded">Circulation overloaded</option>
                                                        <option value="Procedure/Surgery Cancel">Procedure/Surgery Cancel</option>
                                                        <option value="Patient deceased before transfusion">Patient deceased before transfusion</option>
                                                        <option value="Xmatch expired">Xmatch expired</option>
                                                        <option value="Empty bag">Empty bag</option>
                                                        <option value="Transfusion cancel">Transfusion cancel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3" id="otherlocationdiv" style="display: none;">
                                                <div class="col-md-4 pt-4">
                                                    <b>Other Location</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="otherslocation" id="otherslocation">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="submitLocation" class="align-self-end btn btn-primary btn-sm font-weight-bold btn-block mt-3 mb-3" style="margin-top: auto;">{{__('SUBMIT')}}</button>
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