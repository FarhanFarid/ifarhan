<div class="modal fade modal-md" tabindex="-1" id="receive-transferred" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3; ">RECEIVED TRANSFERRED</h4>
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
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">TRANSFUSION DETAIL</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Episode No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="epsdno" id="epno" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Bag No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="bagNo" id="bNo" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Reaction</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" aria-label="Select example" name="reactions" id="reactions">
                                                        <option value=""></option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Volume Transfused</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" name="volumes" id="volumes">
                                                        <span class="input-group-text">ml</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="receiveTransferred" class="align-self-end btn btn-danger btn-sm font-weight-bold btn-block mt-3 mb-3" style="margin-top: auto;">{{__('SUBMIT')}}</button>
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