<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">History</h4>
    </div>
</div>
<div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
    <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
        <div class="row mb-5">
            <div class="row mb-2">
                <div class="d-flex justify-content-center">
                    <h5 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #797979;"><u>Patient’s primary / provisional diagnosis</u></h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <textarea class="form-control" id="diagnosis" name="diagnosis">{{ $relevanthistory->diagnosis  ?? ''}}</textarea>
                </div>
            </div>           
        </div>
        <div class="row mb-5">
            <div class="col-md-6">
                <label for="indication" class="form-check-label">Indication for transfusion</label>
                <input type="text" class="form-control form-control-sm" id="indication" name="indication" value="{{ $relevanthistory->indication  ?? ''}}"/>
            </div>
            <div class="col-md-6">
                <label for="relevanthistory" class="form-check-label">Other relevant medical and/or surgical history</label>
                <input type="text" class="form-control form-control-sm" id="relevanthistory" name="relevanthistory" value="{{ $relevanthistory->relevanthistory  ?? ''}}"/>
            </div>   
        </div>
        <div class="row mb-5">
            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-check-label mb-2">History of pregnancy / miscarriage (if applicable)</label>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory" {{ isset($relevanthistory) && $relevanthistory->preghistory == 'yes' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="bloodpatient">
                                YES
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="no" id="preghistory" name="preghistory" {{ isset($relevanthistory) && $relevanthistory->preghistory == 'no' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="bloodpatient">
                                NO
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="emergencycross" class="form-check-label mb-2">Emergency crossmatch (immediate spin)</label>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="yes" id="emergencycross" name="emergencycross" {{ isset($relevanthistory) && $relevanthistory->emergencycross == 'yes' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="yes">
                                YES
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="no" id="emergencycross" name="emergencycross" {{ isset($relevanthistory) && $relevanthistory->emergencycross == 'no' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="no">
                                NO
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="safeo" class="form-check-label mb-2">Transfusion with safe “O” or uncrossmatched group specific blood</label>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="yes" id="safeo" name="safeo" {{ isset($relevanthistory) && $relevanthistory->safeo == 'yes' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="yes">
                                YES
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="no" id="safeo" name="safeo" {{ isset($relevanthistory) && $relevanthistory->safeo == 'no' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="no">
                                NO
                            </label>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>