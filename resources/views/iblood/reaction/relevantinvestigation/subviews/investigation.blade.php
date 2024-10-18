<div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
    <div class="d-flex justify-content-center">
        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Relevant Investigation</h4>
    </div>
</div>
<div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
    <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
        {{-- <div class="row mb-5">
            <div class="row mb-2">
                <div class="d-flex justify-content-center">
                    <h5 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #797979;"><u>H1. Chest X-ray findings (specify):</u></h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <textarea class="form-control" id="xrayfindings" name="xrayfindings" readonly> </textarea>
                </div>
            </div>           
        </div> --}}
        <div class="row mb-5">
            <div class="row mb-2">
                <div class="d-flex justify-content-center">
                    <h5 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #797979;"><u>H2. Relevant <b>pre-transfusion</b> laboratory investigation results:</u></h5>
                </div>
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-check-label">Full blood count</label>
                <input type="text" class="form-control form-control-sm" id="prefbc" name="prefbc" value="{{ $relevantinvestigation->prefbc  ?? ''}}"/>
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-check-label">Liver Function</label>
                <input type="text" class="form-control form-control-sm" id="prelf" name="prelf" value="{{ $relevantinvestigation->prelf  ?? ''}}"/>
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-check-label">Coagulation Test</label>
                <input type="text" class="form-control form-control-sm" id="prect" name="prect" value="{{ $relevantinvestigation->prect  ?? ''}}"/>
            </div>
        </div>
        <div class="row mb-5">
            <div class="row mb-2">
                <div class="d-flex justify-content-center">
                    <h5 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #797979;"><u>H3. Relevant <b>post-transfusion</b> laboratory investigation results:</u></h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="exampleFormControlInput1" class="form-check-label">Full blood count including Reticulocyte count</label>
                    <input type="text" class="form-control form-control-sm" id="postfbc" name="postfbc" value="{{ $relevantinvestigation->postfbc  ?? ''}}"/>
                </div>
                <div class="col-md-3">
                    <label for="exampleFormControlInput1" class="form-check-label">Liver Function</label>
                    <input type="text" class="form-control form-control-sm" id="postlf" name="postlf" value="{{ $relevantinvestigation->postlf  ?? ''}}"/>
                </div>
                <div class="col-md-3">
                    <label for="exampleFormControlInput1" class="form-check-label">Coagulation Test</label>
                    <input type="text" class="form-control form-control-sm" id="postct" name="postct" value="{{ $relevantinvestigation->postct  ?? ''}}"/>
                </div>
                <div class="col-md-3">
                    <label for="exampleFormControlInput1" class="form-check-label">Red cells antibodies</label>
                    <input type="text" class="form-control form-control-sm" id="postrca" name="postrca" value="{{ $relevantinvestigation->postrca  ?? ''}}"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="posthapto" class="form-check-label">Haptoglobin</label>
                    <input type="text" class="form-control form-control-sm" id="posthapto" name="posthapto" value="{{ $relevantinvestigation->posthapto  ?? ''}}"/>
                </div>
            
                <!-- Blood C&S Patient Section -->
                <div class="col-md-5">
                    <div class="border p-2">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label class="form-check-label">Blood C&S Patient:</label>
                            </div>
                            <div class="col-md-8">
                                <label for="bloodpatientorg" class="form-check-label">Organism</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="bloodpatientpos" id="bloodpatient" name="bloodpatient" {{ isset($relevantinvestigation) && $relevantinvestigation->bloodpatient == 'bloodpatientpos' ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="bloodpatient">
                                        POS
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="bloodpatientneg" id="bloodpatient" name="bloodpatient" {{ isset($relevantinvestigation) && $relevantinvestigation->bloodpatient == 'bloodpatientneg' ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="bloodpatient">
                                        NEG
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm" id="bloodpatientorg" name="bloodpatientorg" value="{{ $relevantinvestigation->bloodpatientorg  ?? ''}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Blood C&S Donor Section -->
                <div class="col-md-5">
                    <div class="border p-2">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label class="form-check-label">Blood C&S Donor:</label>
                            </div>
                            <div class="col-md-8">
                                <label for="blooddonororg" class="form-check-label">Organism</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="blooddonorpos" id="blooddonorpos" name="blooddonor" {{ isset($relevantinvestigation) && $relevantinvestigation->blooddonor == 'blooddonorpos' ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="blooddonorpos">
                                        POS
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="blooddonorneg" id="blooddonorneg" name="blooddonor" {{ isset($relevantinvestigation) && $relevantinvestigation->blooddonor == 'blooddonorneg' ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="blooddonorneg">
                                        NEG
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm" id="blooddonororg" name="blooddonororg" value="{{ $relevantinvestigation->bloodpatientorg  ?? ''}}"/>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            
            <div class="row mb-3">
                {{-- <div class="col-md-3">
                    <input type="text" class="form-control form-control-sm" id="urinefeme" name="urinefeme" value="{{ $relevantinvestigation->urinefeme  ?? ''}}"/>
                </div> --}}
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-check-label">Urine FEME</label>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="haemoglobinuria" id="haemoglobinuria"  name="haemoglobinuria" {{ isset($relevantinvestigation) && $relevantinvestigation->haemoglobinuria ? 'checked' : '' }}/>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Haemoglobinuria
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="hematuria" id="hematuria"  name="hematuria" {{ isset($relevantinvestigation) && $relevantinvestigation->hematuria ? 'checked' : '' }} />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Hematuria
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="row mb-2">
                <div class="d-flex justify-content-center">
                    <h5 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #797979;"><u>H4. State other relevant investigations if any</u></h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <textarea class="form-control" id="otherinves" name="otherinves">{{ $relevantinvestigation->otherinves  ?? ''}}</textarea>
                </div>
            </div>           
        </div>
    </div>
</div>