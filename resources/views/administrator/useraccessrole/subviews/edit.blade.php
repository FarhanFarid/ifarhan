<div class="modal fade" id="editaccessrole" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Update Access Role')}}</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="las la-times text-dark fs-2"></i>
                </div>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div id="editform">
                        <div class="row mb-6">
                            <label class="form-label required fw-semibold fs-6">Trakcare User Group</label>
                            <div class="fv-row">
                                <select class="form-control form-control-md" name="tcusergroup" id="tcusergroupedit">
                                    <option value="" selected disabled>Please select...</option>
                                    @foreach($getSecuritygroup as $security)
                                        <option value="{{$security->securitygroup}}">{{$security->securitygroup}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="form-label required fw-semibold fs-6">Quippe Role</label>
                            <div class="fv-row">
                                <select class="form-control form-control-md" name="quipperolename" id="quipperolenameedit">
                                    <option value="" selected disabled>Please select...</option>
                                    @foreach($getRole as $role)
                                        <option value="{{$role->role}}">{{$role->role}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="idedit">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm font-weight-bold" data-bs-dismiss="modal">{{__('CLOSE')}}</button>
                <button type="button" class="btn btn-success btn-sm font-weight-bold update-accessrole">{{__('SAVE CHANGES')}}</button>
            </div>
        </div>
    </div>
</div>