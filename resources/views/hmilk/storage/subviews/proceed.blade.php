<div class="modal fade modal-md" tabindex="-1" id="proceed-milk" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3; ">PREPARE / HANDOVER MILK</h4>
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
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">PROCEED DETAILS</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Episode No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="episdno" id="episdno" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Batch ID</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="bchId" id="bchId" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Remark</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" aria-label="Select example" name="remarks" id="remarks">
                                                        <option value="Fresher Milk">Fresher Milk</option>
                                                        <option value="Mother's Request">Mother's Request</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="updateProceed" class="align-self-end btn btn-success btn-sm font-weight-bold btn-block mt-3 mb-3" style="margin-top: auto;">{{__('PROCEED')}}</button>
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