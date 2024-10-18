<div class="modal" id="adverse-drug-report" style="z-index: 10000 !important;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="max-width: 90% !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: 700;">ADVERSE DRUG REACTIONS</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="las la-times text-dark fs-2"></i>
                </div>
            </div>
            <div class="modal-body">
                <iframe id="report-iframe" src="" style="width: 100%; height: 600px; border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">{{ __('CLOSE') }}</button>
                <a type="button" class="btn btn-info btn-sm font-weight-bold btn-maximize" href="{{ route('blood.reaction.report.generate') }}?{!! $url !!}" target="_blank"><i class='la la-expand-arrows-alt'></i>&nbsp;{{ __('MAXIMIZE') }}</a>
                <button type="button" data-bs-dismiss="modal" class="btn btn-dark font-weight-bold btn-print btn-sm" target="_blank"><i class='la la-print'></i>&nbsp;{{ __('PRINT') }}</button>
                {{-- @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LABTemp" || Auth::user()->usergrp == "LABClerk") --}}
                    <button type="button" class="btn btn-success btn-sm font-weight-bold save-finalization">{{__('FINALIZE REPORT')}}</button>
                {{-- @endif --}}
            </div>
        </div>
    </div>
</div>