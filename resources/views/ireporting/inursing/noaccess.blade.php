@extends('layouts.ireporting.master')

@section('content')

<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">Alert</h4>
        </div>
        <div class="card-body">
            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 5px #1d69e3 !important;">
                <div class="card-body" style="padding: 0.75rem !important;">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger d-flex align-items-center p-5">
                                    <i class="fa-solid fa-triangle-exclamation fs-2hx me-4" style="color: #ff5252;"></i>
                                    <div class="d-flex flex-column">
                                        <h4 class="mb-1 text-danger">You do not have the access to enter this page.</h4>                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
