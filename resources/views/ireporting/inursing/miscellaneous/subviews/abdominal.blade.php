<div class="row mb-5">
    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label class="form-label fw-semibold fs-6 mt-2">Date&nbsp;:</label>
            <div class="fv-row">
                <input class="form-control form-control-md" placeholder="Pick date range" id="filterdatemscabdominal" value="{{ \Carbon\Carbon::now()->format('d/m/Y') }} - {{ \Carbon\Carbon::now()->format('d/m/Y') }}" readonly/>
            </div>
        </div>
    </div>
</div>
<table class="table table-bordered table-row-bordered" id="report-mscabdominal-table">
    <thead class="thead-light">
        <tr class="fw-semibold fs-6 text-center">
            <th style="max-width: 50px; color: #14787c; background-color:#ecfefe; vertical-align: top;">No.</th>
            <th style="min-width: 50px; color: #14787c; background-color:#ecfefe; vertical-align: top;">MRN</th>
            <th style="min-width: 100px; color: #14787c; background-color:#ecfefe; vertical-align: top;">Name</th>
            <th style="min-width: 100px; color: #14787c; background-color:#ecfefe; vertical-align: top;">Episode No.</th>                        
            <th style="min-width: 50px; color: #14787c; background-color:#ecfefe; vertical-align: top;">Date</th>
            <th style="min-width: 50px; color: #14787c; background-color:#ecfefe; vertical-align: top;">Time</th>
            <th style="min-width: 100px; color: #14787c; background-color:#ecfefe; vertical-align: top;">Abdominal Girth</th>
            <th style="min-width: 100px; color: #14787c; background-color:#ecfefe; vertical-align: top;">Remarks</th>
            <th style="min-width: 150px; color: #14787c; background-color:#ecfefe; vertical-align: top;">Recorded By</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>