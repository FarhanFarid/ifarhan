<div class="modal fade modal-lg" tabindex="-1" id="add-suspected-drug" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3; ">SUSPECTED DRUG</h4>
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
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">DRUG DETAILS</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Product</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="product" id="product">
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Dose</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="dose" id="dose">
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Frequency</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" aria-label="Select example" name="frequency" id="frequency">
                                                        <option value=""></option>
                                                        <option value="dly">dly</option>
                                                        <option value="bid">bid</option>
                                                        <option value="om">om</option>
                                                        <option value="tid">tid</option>
                                                        <option value="on">on</option>
                                                        <option value="od">od</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Batch Number</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="batchno" id="batchno">
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Therapy Date</b>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-text">Start</span>
                                                        <input class="form-control" type="date" name="startdate" id="startdate">
                                                    </div>                                                
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-text">Stop</span>
                                                        <input class="form-control" type="date" name="stopdate" id="stopdate">
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Indication</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="indication" id="indication">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="submitconcodrug" class="align-self-end btn btn-danger btn-sm font-weight-bold btn-block mt-3 mb-3" style="margin-top: auto;">{{__('SUBMIT')}}</button>
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