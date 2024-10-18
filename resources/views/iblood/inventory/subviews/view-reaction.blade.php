<div class="modal fade modal-md" tabindex="-1" id="view-reaction" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">VIEW REACTION</h4>
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
                                            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">REACTION DETAILS</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered" id="reaction-table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="color: #14787c; min-width: 100px;">Date/Time</th>
                                                        <th style="color: #14787c; min-width: 100px;">Reaction</th>
                                                        <th style="color: #14787c; min-width: 100px;">Added By</th>
                                                        <th style="color: #14787c; min-width: 100px;">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
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
