
<div class="modal fade modal-xl" tabindex="-1" id="receive-blood" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3; ">RECEIVE BLOOD</h4>
            </div>

            <div class="modal-body">

                <div class="row labno-section">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="row p-1">
                            <input type="text" class="form-control" id="labno" name="labno" placeholder="LAB NUMBER" required/>
                        </div>
                        <div class="row p-1">
                            <button type="button" id="verify-labno" class="btn btn-primary btn-lg font-weight-bold mx-5 px-20">{{__('VERIFY')}}</button>
                        </div>
                    </div>
                </div>

                <div class="row bloodbag-section" style="display: none;">
                    <div class="col-md-12 mb-2">
                        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                        </div>
                        <div class="card-body">
                            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 3px #1d69e3 !important;">
                                <form id="#">
                                    @csrf
                                    <div class="row m-5">
                                        <div class="col-md-3">
                                            <div class="row p-1">
                                                <b>Receiving Location</b>
                                            </div>
                                            <select class="form-select form-select-solid" name="location" id="location" data-control="select2" data-placeholder="Select Location">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row p-1">
                                                <b>Product</b>
                                            </div>
                                            <div class="row p-1">
                                                <select class="form-select form-select-solid" name="product" id="product" data-control="select2" data-placeholder="Select Product">
                                                    <option value="">Please select the product</option>
                                                    <option value="AUTOLOGOUS PACKED CELL">AUTOLOGOUS PACKED CELL</option>
                                                    <option value="CRYOPPT">CRYOPPT</option>
                                                    <option value="FFP.">FFP.</option>
                                                    <option value="APHERESIS FFP">APHERESIS FFP</option>
                                                    <option value="FILTERED PACK RED CELLS">FILTERED PACK RED CELLS</option>
                                                    <option value="LEUCODEPLET-POOLPLT">LEUCODEPLET-POOLPLT</option>
                                                    <option value="CRYOSUPERNATANT">CRYOSUPERNATANT</option>
                                                    <option value="OCTAPLAS">OCTAPLAS</option>
                                                    <option value="PACKED CELL">PACKED CELL</option>
                                                    <option value="APHERESIS PLT.">APHERESIS PLT.</option>
                                                    <option value="PLATELET CONC.">PLATELET CONC.</option>
                                                    <option value="PAEDIPACK CELL">PAEDIPACK CELL</option>
                                                    <option value="SPUN BLOOD">SPUN BLOOD</option>
                                                    <option value="WHOLE BLOOD">WHOLE BLOOD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row p-1">
                                                <b>Lab No.</b>
                                            </div>
                                            <div class="row p-1">
                                                <input type="text" class="form-control" id="labnumber" name="labnumber" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row p-1">
                                                <b>Bag No.</b>
                                            </div>
                                            <div class="row p-1">
                                                <input type="text" class="form-control" id="bagno" name="bagno" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <button type="button" id="add-blood" class="btn btn-primary btn-md font-weight-bold mx-5 mb-3 px-20">{{__('ADD')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <br>
                            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">SCANNED PACK</h4>
                            </div>
                            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 3px #1d69e3 !important; display: none;" id="gen-batch">
                                <div class="row m-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="color: #000000; min-width: 100px;">{{__('PRODUCT')}}</th>
                                                    <th style="color: #000000; min-width: 25px;">{{__('BAG NO.')}}</th>
                                                    <th style="color: #000000; min-width: 25px;">{{__('LAB NO.')}}</th>
                                                    <th style="color: #000000; min-width: 100px;">{{__('LOCATION')}}</th>
                                                    <th style="color: #000000; min-width: 100px;">{{__('ACTION')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="blood-batch">
                                    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="button" id="save-blood" class="btn btn-success btn-md font-weight-bold mx-5 mb-5 px-15">{{__('RECEIVE')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>