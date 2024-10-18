<div class="modal fade modal-xl" tabindex="-1" id="warm-milk" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3; ">PREPARE MILK</h4>
                <div class="card-toolbar">
                    <select class="form-select" aria-label="Select example">
                        <option value="" disabled selected>Please Select Handover Method</option>
                        <option value="1">Nurse</option>
                        <option value="2">Caregiver</option>
                    </select>
                </div>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="card-body nurse-handover-section">
                            <div class="card card-custom gutter-b mb-3" style="border-radius: 0px !important; background-color: #e9f2ff;">
                                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">NURSE HANDOVER</h4>
                            </div>
                            <form id="#">
                                @csrf
                                <div class="row m-3">
                                    <div class="col-md-6" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important;">
                                        <div class="card card-custom gutter-b mb-3 mt-1" style="border-radius: 0px !important; background-color: #e9f2ff;">
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">PACK DETAILS</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Episode No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="episodeNo" id="episodeNo" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Batch No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="batchNo" id="batchNo" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Batch ID</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="batchId" id="batchId" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Expiry Date</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="expiryDate" id="expiryDate" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important;">
                                        <div class="card card-custom gutter-b mb-3 mt-1" style="border-radius: 0px !important; background-color: #e9f2ff;">
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">NURSE DETAILS</h4>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-1 mb-20">
                                                <div class="col-md-4">
                                                    <b>Name</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="nurseName" id="nurseName" readonly>
                                                </div>
                                            </div>
                                            <button type="button" id="updateStatus" class="align-self-end btn btn-warning btn-sm font-weight-bold btn-block mt-8" style="margin-top: auto;">{{__('PREPARE')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body caregiver-handover-section">
                            <div class="card card-custom gutter-b mb-3" style="border-radius: 0px !important; background-color: #e9f2ff;">
                                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">CAREGIVER HANDOVER</h4>
                            </div>
                            <form id="#">
                                @csrf
                                <div class="row m-3">
                                    <div class="col-md-6" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important;">
                                        <div class="card card-custom gutter-b mb-3 mt-1" style="border-radius: 0px !important; background-color: #e9f2ff;">
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">PACK DETAILS</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Episode No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="cgepisodeNo" id="cgepisodeNo" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Batch No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="cgbatchNo" id="cgbatchNo" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Batch ID</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="cgbatchId" id="cgbatchId" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Expiry Date</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="cgexpiryDate" id="cgexpiryDate" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important;">
                                        <div class="card card-custom gutter-b mb-3 mt-1" style="border-radius: 0px !important; background-color: #e9f2ff;">
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">CAREGIVER DETAILS</h4>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Name</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="mName" id="mName" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>NRIC / Passport No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="mNric" id="mNric" readonly>
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-10">
                                                <div class="col-md-4">
                                                    <b>Not main caregiver?</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-check-input checkbox_check" type="checkbox" value="1" id="isCaregiver" name="cgNric"/>
                                                </div>
                                            </div>
                                            {{-- <button type="button" id="cgupdateStatus" class="align-self-end btn btn-warning btn-sm font-weight-bold btn-block mb-1 cgPreparebtn" style="margin-top: auto;">{{__('PREPARE')}}</button> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-3">
                                    <div class="col-md-12  handover-to-section" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important;">
                                        <div class="card card-custom gutter-b mb-3 mt-1" style="border-radius: 0px !important; background-color: #e9f2ff;">
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">HANDOVER TO:</h4>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>Name</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="cgName" id="cgName">
                                                </div>
                                            </div>
                                            <div class="row m-1">
                                                <div class="col-md-4">
                                                    <b>NRIC / Passport No.</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="cgNric" id="cgNric">
                                                </div>
                                            </div>
                                            <div class="row m-1 mb-3">
                                                <div class="col-md-4">
                                                    <b>Relationship</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="cgRelationship" id="cgRelationship">
                                                </div>
                                            </div>
                                            {{-- <button type="button" id="cgupdateStatus" class="align-self-end btn btn-warning btn-sm font-weight-bold btn-block mb-1" style="margin-top: auto;">{{__('PREPARE')}}</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <button type="button" id="cgupdateStatus" class="align-self-end btn btn-warning btn-sm font-weight-bold btn-block mb-1" style="margin-top: auto;">{{__('HANDOVER')}}</button>
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