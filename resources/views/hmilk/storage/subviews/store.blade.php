<div class="modal fade modal-xl" tabindex="-1" id="add-milk" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3; ">STORE MILK</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                        </div>
                        <div class="card-body">
                            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 3px #1d69e3 !important;">
                                <form id="#">
                                    @csrf
                                    <div class="row m-5">
                                        <div class="col-md-6">
                                            <div class="row p-1">
                                                <b>Batch Date</b>
                                            </div>
                                            <div class="row p-1">
                                                <input type="datetime-local" class="form-control" id="bdate" name="bdate" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row p-1">
                                                <b>Pack Quantity</b>
                                            </div>
                                            <div class="row p-1">
                                                <input type="number" class="form-control" id="quantity" name="quantity" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-5">
                                        <div class="col-md-6">
                                            <div class="row p-1">
                                                <b>Mother's Name</b>
                                            </div>
                                            <div class="row p-1">
                                                <input type="text" class="form-control" id="mname" name="mname" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row p-1">
                                                <b>Mother's NRIC / Passport No.</b>
                                            </div>
                                            <div class="row p-1">
                                                <input type="text" class="form-control" id="mnric" name="mnric" required/>
                                            </div>
                                            <div class="row p-1">
                                                <input type="hidden" class="form-control" id="episodeno" name="episodeno" required/>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <button type="button" id="savebatch" class="btn btn-primary btn-sm font-weight-bold mx-5 mb-5">{{__('ADD')}}</button>
                            </div>
                            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 3px #1d69e3 !important; display: none;" id="gen-batch">
                                <div class="row m-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="color: #000000; min-width: 25px;">{{__('NO.')}}</th>
                                                    <th style="color: #000000; min-width: 100px;">{{__('EPISODE')}}</th>
                                                    <th style="color: #000000; min-width: 100px;">{{__('BATCH NO.')}}</th>
                                                    <th style="color: #000000; min-width: 100px;">{{__('LOCATION')}}</th>
                                                    <th style="color: #000000; min-width: 100px;">{{__('BATCH DATE')}}</th>
                                                    <th style="color: #000000; min-width: 100px;">{{__('EXPIRY DATE')}}</th>
                                                    <th style="color: #000000; min-width: 100px;">{{__("MOTHER'S NAME")}}</th>
                                                    <th style="color: #000000; min-width: 100px;">{{__("MOTHER'S NRIC")}}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="milk-batch">
                                    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <button type="button" id="printlabel" class="btn btn-primary btn-sm font-weight-bold mx-5 mb-5">{{__('PRINT LABEL')}}</button>
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