<!DOCTYPE html>
<html>
<head>
    @include('layouts.adr.header')
</head>
<body>
    <p class="mb-2">Dear All,</p>
    <p class="mb-2">As part of our on-going business process improvement, MIS department developed a program that will automatically inform all related departments the summary of suspected adverse drug reaction (ADR) report.</p>
    <p class="mb-5">The notification will arrive as an e-mail to you daily at 8 AM.</p>
    <div class="table-responsive mb-3">
        <table class="table table-bordered table-sm m-0" style="width: 50%; table-layout: fixed; font-size: 1.2rem; border: 1px solid #767676; border-collapse: collapse;">
            <thead style="background-color: #3fdcff; color: #000000; font-weight: 600;" class="text-center">
                <tr>
                    <th style="padding: 2px; border: 1px solid #767676;">MRN</th>
                    <th style="padding: 2px; border: 1px solid #767676;">Episode No.</th>
                    <th style="padding: 2px; border: 1px solid #767676;">Reported Date</th>
                    <th style="padding: 2px; border: 1px solid #767676;">Ageing</th>
                </tr>
            </thead>
            <tbody style="color: #000000; font-weight: 400;">
                @forelse($report as $item)
                    <tr>
                        <td style="padding: 2px; border: 1px solid #767676; text-align: center;">{{ $item['prn'] ?? 'N/A' }}</td>
                        <td style="padding: 2px; border: 1px solid #767676; text-align: center;">{{ $item['episodeno'] ?? 'N/A' }}</td>
                        <td style="padding: 2px; border: 1px solid #767676; text-align: center;">
                            {{ isset($item['reported_at']) ? \Carbon\Carbon::parse($item['reported_at'])->format('d/m/Y') : 'N/A' }}
                        </td>                        
                        @php
                            $ageing = 'N/A';
                            $style = 'color: black;';
                            if (!empty($item['reported_at'])) {
                                $reported = \Carbon\Carbon::parse($item['reported_at']);
                                $days = $reported->diffInDays(now());
                                $ageing = $days . ' days';
                                if ($days > 30) {
                                    $style = 'color: red;';
                                }
                            }
                        @endphp
                        <td style="padding: 2px; border: 1px solid #767676; text-align: center; {{ $style }}">
                            {{ $ageing }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding: 2px; border: 1px solid #767676; text-align: center;">
                            No pending record to review.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <p class="mb-2">We welcome feedback for further improvement.</p>
    <p class="mb-2">Thank you and best regards.</p>
    <p class="mb-2">MIS Department</p>
    <p class="mb-2"><b>Note: This E-Mail is generated automatically. Please do not reply.</b></p>
</body>
</html>
