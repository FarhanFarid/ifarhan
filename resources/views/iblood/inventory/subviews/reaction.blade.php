<div class="modal fade modal-md" tabindex="-1" id="add-reaction" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3; ">ADD REACTION</h4>
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
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">REACTION DETAIL</h4>
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
                                                    <b>Reaction Details</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" name="reactiondetails" id="reactiondetails" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="addReaction" class="align-self-end btn btn-danger btn-sm font-weight-bold btn-block mt-3 mb-3" style="margin-top: auto;">{{__('SUBMIT')}}</button>
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