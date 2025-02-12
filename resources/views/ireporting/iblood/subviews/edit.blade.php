<div class="modal fade modal-md" tabindex="-1" id="edit-record"  style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3; ">EDIT RECORD</h4>
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
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">RECORD DETAIL</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Episode No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="episodeNumber" id="episodeNumber" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Bag No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="bagNumber" id="bagNumber" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3" id="reaction-details">
                                                <div class="col-md-4 pt-4">
                                                    <b>Product</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-select form-select-solid" name="product" id="product" data-dropdown-parent="#edit-record" data-control="select2" data-placeholder="Select Product">
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
                                            <div class="row m-1 mb-3" id="reaction-details">
                                                <div class="col-md-4 pt-4">
                                                    <b>Expiry Date</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="date" name="matchdate" id="matchdate">
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4 pt-4">
                                                    <b>Transfer To:</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="bagNumber" id="bagNumber" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="store-blood2" class="align-self-end btn btn-danger btn-sm font-weight-bold btn-block mt-3 mb-3" style="margin-top: auto;">{{__('SUBMIT')}}</button>

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