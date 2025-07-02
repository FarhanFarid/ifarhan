<div class="modal" id="transfer-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 30% !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: 700;">Transfer Location/Storage</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="las la-times text-dark fs-2"></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="mb-5 hover-scroll-x">
                    <div class="d-grid">
                        <ul class="nav nav-tabs flex-nowrap text-nowrap">
                            <li class="nav-item" style="margin-right: 10px;">
                                <a class="nav-link active btn btn-light-success btn-active-success btn-color-light-success btn-active-color-light rounded-bottom-0" data-bs-toggle="tab" href="#storage">Transfer Storage</a>
                            </li>
                            <li class="nav-item" style="margin-right: 10px;">
                                <a class="nav-link btn btn-light-warning btn-active-warning btn-color-light-warning btn-active-color-light rounded-bottom-0" data-bs-toggle="tab" href="#location">Transfer Location</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="storage" role="tabpanel">
                        <form id="transferstorageform">
                            @csrf
                            <div class="container-fluid" style="border: 1px solid #00000038">
                                <div class="row mt-3 mb-3 px-3">
                                    <label for="episodestore" class="form-check-label" style="color: black; font-weight: 700; font-size: 10px;">Episode:</label>
                                    <input class="form-control form-control-sm" type="text" name="episodestore" id="episodestore" readonly>
                                </div>
                                <div class="row mb-3 px-3">
                                    <label for="batchidstore" class="form-check-label" style="color: black; font-weight: 700; font-size: 10px;">Batch ID</label>
                                    <input class="form-control form-control-sm" type="text" name="batchidstore" id="batchidstore" readonly>
                                </div>
                                <div class="row mb-3 px-3">
                                    <label for="currentloc" class="form-check-label" style="color: black; font-weight: 700; font-size: 10px;">Location</label>
                                    <input class="form-control form-control-sm" type="text" name="currentloc" id="currentloc" readonly>
                                </div>
                                <div class="row mb-3 px-3">
                                    <label for="storagearea" class="form-check-label" style="color: black; font-weight: 700; font-size: 10px;">Current Storage Area</label>
                                    <input class="form-control form-control-sm" type="text" name="storagearea" id="storagearea" readonly>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm btn-block font-weight-bold save-savestorage mb-5 px-10">{{__('SAVE')}}</button>
                            </div>
                        </form>
                        
                        
                    </div>
                    <div class="tab-pane fade show" id="location" role="tabpanel">
                        <form id="transferlocform">
                            @csrf
                            <div class="container-fluid" style="border: 1px solid #00000038">
                                <div class="row mt-3 mb-3 px-3">
                                    <label for="episodeloc" class="form-check-label" style="color: black; font-weight: 700; font-size: 10px;">Episode:</label>
                                    <input class="form-control form-control-sm" type="text" name="episodeloc" id="episodeloc" readonly>
                                </div>
                                <div class="row mb-3 px-3">
                                    <label for="batchidloc" class="form-check-label" style="color: black; font-weight: 700; font-size: 10px;">Batch ID</label>
                                    <input class="form-control form-control-sm" type="text" name="batchidloc" id="batchidloc" readonly>
                                </div>
                                <div class="row mb-3">
                                    <label for="transferlocation" class="form-check-label" style="color: black; font-weight: 700; font-size: 10px;">Transfer To:</label>
                                    <select class="form-select form-select-sm" data-control="select2" data-dropdown-parent="#transfer-modal" data-dropdown-parent="body" data-placeholder="Select an option" id="transferlocation" name="transferlocation">
                                        <option value="PICU">PICU</option>
                                        <option value="PICU2">PICU2</option>
                                        <option value="PCICU">PCICU</option>
                                    </select>
                                </div>
                                <input class="form-control form-control-sm" type="hidden" name="storagearealoc" id="storagearealoc" readonly>
                                <button type="button" class="btn btn-primary btn-sm btn-block font-weight-bold save-saveloc mb-5 px-10">{{__('SAVE')}}</button>
                            </div>
                        </form>  
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">{{ __('CLOSE') }}</button>
            </div>
        </div>
    </div>
</div>