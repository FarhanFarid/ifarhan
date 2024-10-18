@extends('layouts.master')

@section('content')
<div class="row mb-10">
    <span><b>ACCESS ROLE<b></span>
</div>
<a class="btn btn-primary new-accessrole mb-2"><i class="las la-plus-circle fs-2"></i>{{__('Access Role')}}</a>
<table class="table table-bordered table-row-bordered gy-5 gs-7" id="adminuseraccessrole-table">
    <thead class="thead-dark">
        <tr class="fw-semibold fs-6 text-gray-800">
            <th style="min-width: 50px;">No.</th>
            <th style="min-width: 50px;">TrakCare User Groups</th>
            <th style="min-width: 30px;">Quippe Role</th>
            <th style="min-width: 50px;">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<!--begin::Modal-->
@include('administrator.useraccessrole.subviews.add')
@include('administrator.useraccessrole.subviews.edit')
<!--end::Modal-->
@endsection
@push('script')
<script>
    // global app configuration object
    var config = {
        routes: {
            accessrole : {
                list : "{{ route('administrator.useraccessrole.role') }}?{!! $url !!}",
                store : "{{ route('administrator.useraccessrole.store') }}?{!! $url !!}",
                update : "{{ route('administrator.useraccessrole.update') }}?{!! $url !!}",
            },
        }
    };
</script>
<script src="{{ asset('js/administrator/useraccessrole.js') }}"></script>
@endpush