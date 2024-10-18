<div class="modal fade modal-md" tabindex="-1" id="discard-milk" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3; ">DISCARD MILK</h4>
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
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">DISCARD DETAILS</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Episode No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="epsdno" id="epsdno" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Batch ID</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="btchId" id="btchId" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Remarks</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" aria-label="Select example" name="remark" id="remark">
                                                        <option value="Expired">Expired</option>
                                                        <option value="Milk to Home">Milk to Home</option>
                                                        <option value="Milk to Other Hospital">Milk to Other Hospital</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="updateDiscard" class="align-self-end btn btn-danger btn-sm font-weight-bold btn-block mt-3 mb-3" style="margin-top: auto;">{{__('DISCARD')}}</button>
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