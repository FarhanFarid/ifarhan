<table class="table table-bordered" id="adverse-event-table">
    <thead class="thead-light">
        <tr>
            <th style="color: #14787c; min-width: 10px; text-align: center;  vertical-align: middle;">{{__('Section')}}</th>
            <th style="color: #14787c; min-width: 280px; text-align: center;  vertical-align: middle;">{{__('Events')}}</th>
            <th style="color: #14787c; min-width: 10px; text-align: center;  vertical-align: middle;">{{__('Action')}}</th>
        </tr>
    </thead>
    <tbody> 
        {{-- J1 --}}
        <tr>
            <td rowspan="8" style="text-align: center; vertical-align: middle;">J1</td>
            <td><b>Incorrect Blood Component / Product Transfused (Proceed to Error and Incident tab for "IBCT". )</b></td>
            <td></td>
        </tr>
        <tr>
            <td>J1.1. Accute Immune Haemolytic Anaemia</td>
            <td style="text-align: center; vertical-align: middle;">                    
                <input class="form-check-input" type="checkbox" value="section1_1" id="section1_1"  name="section1_1" {{ in_array('section1_1', $typeadverseevent->section1  ?? []) ? 'checked' : '' }}/>
            </td>
        </tr>
        <tr>
            <td>J1.1a. ABO incompatible</td>
            <td style="text-align: center; vertical-align: middle;">                    
                <input class="form-check-input" type="checkbox" value="section1_1a" id="section1_1a"  name="section1_1a" {{ in_array('section1_1a', $typeadverseevent->section1  ?? []) ? 'checked' : '' }}/>
            </td>
        </tr>
        <tr>
            <td>J1.1b. Other red cell incompatibility (e.g. Rh positive given to Rh negative)</td>
            <td style="text-align: center; vertical-align: middle;">                    
                <input class="form-check-input" type="checkbox" value="section1_1b" id="section1_1b"  name="section1_1b" {{ in_array('section1_1b', $typeadverseevent->section1  ?? []) ? 'checked' : '' }}/>
            </td>
        </tr>
        <tr>
            <td>J1.2. Blood is compatible but is meant for another patient</td>
            <td style="text-align: center; vertical-align: middle;">                    
                <input class="form-check-input" type="checkbox" value="section1_2" id="section1_2"  name="section1_2" {{ in_array('section1_2', $typeadverseevent->section1  ?? []) ? 'checked' : '' }}/>
            </td>
        </tr>
        <tr>
            <td>J1.3. Others:</td>
            <td style="text-align: center; vertical-align: middle;">                    
            </td>
        </tr>
        <tr>
            <td>J1.3a. Special requirement not met (e.g. iradiated, filtered, phenotyped)</td>
            <td style="text-align: center; vertical-align: middle;">                    
                <input class="form-check-input" type="checkbox"  value="section1_3a" id="section1_3a"  name="section1_3a" {{ in_array('section1_3a', $typeadverseevent->section1  ?? []) ? 'checked' : '' }}/>
            </td>
        </tr>
        <tr>
            <td>J1.3b. Inappropriate transfusion (e.g. wrong component)</td>
            <td style="text-align: center; vertical-align: middle;">                    
                <input class="form-check-input" type="checkbox" value="section1_3b" id="section1_3b"  name="section1_3b" {{ in_array('section1_3b', $typeadverseevent->section1  ?? []) ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J2 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J2</td>
            <td>Delayed Haemolytic Transfusion Reaction</td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section2" id="section2"  name="section2" {{ isset($typeadverseevent) && $typeadverseevent->section2 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J3 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J3</td>
            <td>Non-immune hemolytic reaction (due to mechanical factor, osmotic, heat, cold, etc)</td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section3" id="section3"  name="section3" {{ isset($typeadverseevent) && $typeadverseevent->section3 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J4 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J4</td>
            <td>Febrile Non-Haemolytic Transfusion Reaction (FNHTR)</td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section4" id="section4"  name="section4" {{ isset($typeadverseevent) && $typeadverseevent->section4 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J5 --}}
        <tr>
            <td rowspan="4" style="text-align: center; vertical-align: middle;">J5</td>
            <td>Allergic Reaction</td>
            <td></td>
        </tr>
        <tr>
            <td>a. Mild (Rash/Urticaria)</td>
            <td style="text-align: center; vertical-align: middle;">                    
                <input class="form-check-input" type="checkbox" value="section5_a" id="section5_a"  name="section5_a" {{ in_array('section5_a', $typeadverseevent->section5  ?? []) ? 'checked' : '' }}/>
            </td>
        </tr>
        <tr>
            <td>b. Moderate (Anaphylactoid)</td>
            <td style="text-align: center; vertical-align: middle;">                    
                <input class="form-check-input" type="checkbox" value="section5_b" id="section5_b"  name="section5_b" {{ in_array('section5_b', $typeadverseevent->section5  ?? []) ? 'checked' : '' }}/>
            </td>
        </tr>
        <tr>
            <td>c. Severe (Anphylactic Transfusion Reaction)</td>
            <td style="text-align: center; vertical-align: middle;">                    
                <input class="form-check-input" type="checkbox" value="section5_c" id="section5_c"  name="section5_c" {{ in_array('section5_c', $typeadverseevent->section5  ?? []) ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J6 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J6</td>
            <td>Transfusing-Related Acute Lung Injury (TRALI)</td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section6" id="section6"  name="section6"  {{ isset($typeadverseevent) && $typeadverseevent->section6 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J7 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J7</td>
            <td>Transfusing-Associated Circulatory Oveload (TACO)</td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section7" id="section7"  name="section7"  {{ isset($typeadverseevent) && $typeadverseevent->section7 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J8 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J8</td>
            <td>Transfusing-Associated Dyspnoea (TAD)</td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section8" id="section8"  name="section8"  {{ isset($typeadverseevent) && $typeadverseevent->section8 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J9 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J9</td>
            <td>Transfusing-Associated Graft-versus-Host Disease (TA-GvHD)</td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section9" id="section9"  name="section9" {{ isset($typeadverseevent) && $typeadverseevent->section9 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J10 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J10</td>
            <td>Post-Transfusion Purpura (PTP)</td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section10" id="section10"  name="section10"  {{ isset($typeadverseevent) && $typeadverseevent->section10 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J11 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J11</td>
            <td>Post-Transfusion Infection: Virus (please specify) <input type="text" class="form-control form-control-sm" id="section11_input"  name="section11_input" placeholder="Please specify"  style="display: none; max-width: 40%;" value="{{ $typeadverseevent->section11_input  ?? ''}}" style="{{ isset($typeadverseevent) && $typeadverseevent->section11 ? '' : 'display: none;' }}"/></td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section11" id="section11"  name="section11"  {{ isset($typeadverseevent) && $typeadverseevent->section11 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J12 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J12</td>
            <td>Post-Transfusion Infection: Bacteria (please specify) <input type="text" class="form-control form-control-sm" id="section12_input"  name="section12_input" placeholder="Please specify"  style="display: none; max-width: 40%;" value="{{ $typeadverseevent->section12_input  ?? ''}}" style="{{ isset($typeadverseevent) && $typeadverseevent->section12 ? '' : 'display: none;' }}"/></td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section12" id="section12"  name="section12"  {{ isset($typeadverseevent) && $typeadverseevent->section12 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J13 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J13</td>
            <td>Post-Transfusion Infection: Parasite (please specify) <input type="text" class="form-control form-control-sm" id="section13_input"  name="section13_input" placeholder="Please specify"  style="display: none; max-width: 40%;" value="{{ $typeadverseevent->section13_input  ?? ''}}" style="{{ isset($typeadverseevent) && $typeadverseevent->section13 ? '' : 'display: none;' }}"/></td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section13" id="section13"  name="section13"  {{ isset($typeadverseevent) && $typeadverseevent->section13 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J14 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J14</td>
            <td>Handling and storage error</td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section14" id="section14"  name="section14"  {{ isset($typeadverseevent) && $typeadverseevent->section14 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J15 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J15</td>
            <td>Equipment related (e.g. faulty waterbath, transfusion set, etc)</td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section15" id="section15"  name="section15"  {{ isset($typeadverseevent) && $typeadverseevent->section15 ? 'checked' : '' }}/>
            </td>
        </tr>
        {{-- J16 --}}
        <tr>
            <td style="text-align: center; vertical-align: middle;">J16</td>
            <td>Others, please specify: <input type="text" class="form-control form-control-sm" id="section16_input"  name="section16_input" placeholder="Please specify"  style="display: none; max-width: 40%;" value="{{ $typeadverseevent->section16_input  ?? ''}}" style="{{ isset($typeadverseevent) && $typeadverseevent->section16 ? '' : 'display: none;' }}"/></td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="form-check-input" type="checkbox" value="section16" id="section16"  name="section16"  {{ isset($typeadverseevent) && $typeadverseevent->section16 ? 'checked' : '' }}/>
            </td>
        </tr>
    </tbody>
</table>