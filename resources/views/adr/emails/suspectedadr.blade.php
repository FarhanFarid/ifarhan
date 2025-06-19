<!DOCTYPE html>
<html>
<head>
    @include('layouts.adr.header')
</head>
<body>
    <p class="mb-2">Dear Sir/Madam,</p>
    <p class="mb-5">Please find below listed the suspected ADR reports for your thorough review and finalization.</p>
    <div class="table-responsive mb-3">
        <table class="table table-bordered table-sm m-0" style="width: 50%; table-layout: fixed; font-size: 1.2rem; border: 1px solid #767676; border-collapse: collapse;">
            <thead style="background-color: #3fdcff; color: #000000; font-weight: 600;" class="text-center">
                <tr>
                    <th style="padding: 2px; border: 1px solid #767676;">MRN</th>
                    <th style="padding: 2px; border: 1px solid #767676;">Episode No.</th>
                    <th style="padding: 2px; border: 1px solid #767676;">Ageing</th>
                </tr>
            </thead>
            <tbody style="color: #000000; font-weight: 400;">
                @forelse($report as $item)
                    <tr>
                        <td style="padding: 2px; border: 1px solid #767676; text-align: center;">{{ $item['prn'] ?? 'N/A' }}</td>
                        <td style="padding: 2px; border: 1px solid #767676; text-align: center;">{{ $item['episodeno'] ?? 'N/A' }}</td>
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
    <p>Thank you.</p>
</body>
</html>
