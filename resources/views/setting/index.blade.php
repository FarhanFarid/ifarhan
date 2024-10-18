@extends('layouts.master')

@section('content')
<div class="card card-custom gutter-b">
	<div class="card-header flex-wrap py-3">
		<div class="card-title">
			<h3 class="card-label">{{ __('Configuration Settings') }}</h3>
		</div>
		<div class="card-toolbar">
            <a class="btn btn-success update-system">{{ __('Update') }}</a>
		</div>
	</div>
	<div class="card-body">
		<form class="form">
			@csrf
            <div class="form-group">
                <label>{{__('Maintenance Mode')}}</label>
                <div class="form-check form-switch form-check-custom form-check-solid mt-3">
                    <input class="form-check-input" type="checkbox" value="1" id="maintenance" name="maintenance" />
                    <label class="form-check-label fw-semibold ms-3" for="status">
                        On
                    </label>
                </div>
            </div>
		</form>
	</div>
</div>
@endsection
@push('script')
<script>
    // global app configuration object
    var config = {
        routes: {
        	setting : {
            	detail : "{{ route('setting.detail') }}",
            	update : "{{ route('setting.update') }}",
            },
        	page : "{{ route('setting') }}",
        }
    };
</script>
<script src="{{ asset('js/setting/setting.js') }}"></script>
@endpush