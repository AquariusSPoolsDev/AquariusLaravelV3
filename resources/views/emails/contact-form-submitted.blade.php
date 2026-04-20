<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Customer Enquiry</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:Lato,Arial,sans-serif;font-size:15px;line-height:1.6;color:#1e293b;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f1f5f9;padding:32px 0;">
        <tr>
            <td align="center">

                {{-- Card --}}
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background-color:#ffffff;border-radius:12px;overflow:hidden;">

                    {{-- Header --}}
                    <tr>
                        <td style="background-color:#183d7a;padding:20px 24px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="vertical-align:middle;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="vertical-align:middle;padding-right:10px;">
                                                    <img src="{{ asset('assets/favicon/aquarius-logo-navbar.png') }}" alt="Aquarius Swimming Pools" width="48" style="display:block;border:0;height:auto;">
                                                </td>
                                                <td style="vertical-align:middle;">
                                                    <span style="display:block;font-family:Outfit,Arial,sans-serif;font-size:24px;font-weight:600;color:#ffffff;text-transform:uppercase;line-height:1;letter-spacing:0.5px;">Aquarius</span>
                                                    <span style="display:block;font-family:Outfit,Arial,sans-serif;font-size:14px;font-weight:500;color:#ffffff;text-transform:uppercase;line-height:1;letter-spacing:0.5px;">Swimming Pools</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="right" style="vertical-align:middle;">
                                        <span style="font-family:Outfit,Arial,sans-serif;font-size:18px;font-weight:700;color:#ffffff;">New Customer Enquiry</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:28px 24px 8px 24px;">

                            {{-- Section: Customer Info --}}
                            <p style="margin:0 0 12px 0;font-family:Outfit,Arial,sans-serif;font-size:17px;font-weight:700;color:#183d7a;">Customer Information</p>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:24px;">
                                <tr>
                                    <td style="padding:8px 0;border-bottom:1px solid #e2e8f0;">
                                        <span style="font-weight:700;color:#1e293b;">Name</span>
                                    </td>
                                    <td style="padding:8px 0;border-bottom:1px solid #e2e8f0;color:#475569;">
                                        {{ $submission->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;border-bottom:1px solid #e2e8f0;">
                                        <span style="font-weight:700;color:#1e293b;">Email</span>
                                    </td>
                                    <td style="padding:8px 0;border-bottom:1px solid #e2e8f0;color:#475569;">
                                        {{ $submission->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;">
                                        <span style="font-weight:700;color:#1e293b;">Phone</span>
                                    </td>
                                    <td style="padding:8px 0;color:#475569;">
                                        {{ $submission->country_code }} {{ $submission->phone }}
                                    </td>
                                </tr>
                            </table>

                            {{-- Section: Enquiry Details --}}
                            <p style="margin:0 0 12px 0;font-family:Outfit,Arial,sans-serif;font-size:17px;font-weight:700;color:#183d7a;">Enquiry Details</p>

                            @if ($submission->interest)
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                                <tr>
                                    <td style="padding:8px 0;border-bottom:1px solid #e2e8f0;">
                                        <span style="font-weight:700;color:#1e293b;">Interest</span>
                                    </td>
                                    <td style="padding:8px 0;border-bottom:1px solid #e2e8f0;color:#475569;">
                                        {{ $submission->interest }}@if ($submission->interest_other) &mdash; {{ $submission->interest_other }}@endif
                                    </td>
                                </tr>
                            </table>
                            @endif

                            @if ($submission->query)
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                                <tr>
                                    <td>
                                        <p style="margin:0 0 6px 0;font-weight:700;color:#1e293b;">Query</p>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="background-color:#f8fafc;border-left:4px solid #2d63c8;border-radius:4px;padding:12px 16px;color:#475569;">
                                                    {{ $submission->query }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            @endif

                            @if (!$submission->interest && !$submission->query)
                            <p style="color:#94a3b8;margin:0 0 16px 0;">No additional details provided.</p>
                            @endif

                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color:#f8fafc;border-top:1px solid #e2e8f0;padding:16px 24px;text-align:center;">
                            <p style="margin:0 0 4px 0;font-size:13px;color:#64748b;">&copy; {{ date('Y') }} Aquarius Swimming Pools Sdn Bhd.</p>
                            <p style="margin:0;font-size:13px;color:#94a3b8;">Notification from aquariusswimmingpools.com. Please respond within 2 working days.</p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
