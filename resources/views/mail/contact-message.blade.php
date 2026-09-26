<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $messageSubject }}</title>
</head>
<body style="margin:0;padding:32px 16px;background:#f1f5f9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;color:#0f172a;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 1px 3px rgba(15,23,42,.08);">
        <tr>
            <td style="padding:24px 32px;background:#0f172a;color:#ffffff;">
                <div style="font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:#7dd3fc;font-weight:600;">New website enquiry</div>
                <div style="margin-top:6px;font-size:20px;font-weight:600;">{{ $messageSubject }}</div>
            </td>
        </tr>
        <tr>
            <td style="padding:28px 32px 8px;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;line-height:1.5;">
                    <tr>
                        <td style="padding:6px 0;width:110px;color:#64748b;">Name</td>
                        <td style="padding:6px 0;font-weight:600;">{{ $senderName }}</td>
                    </tr>
                    <tr>
                        <td style="padding:6px 0;color:#64748b;">Email</td>
                        <td style="padding:6px 0;"><a href="mailto:{{ $senderEmail }}" style="color:#0369a1;">{{ $senderEmail }}</a></td>
                    </tr>
                    @if ($phone)
                        <tr>
                            <td style="padding:6px 0;color:#64748b;">Phone</td>
                            <td style="padding:6px 0;">{{ $phone }}</td>
                        </tr>
                    @endif
                    @if ($company)
                        <tr>
                            <td style="padding:6px 0;color:#64748b;">Company</td>
                            <td style="padding:6px 0;">{{ $company }}</td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding:16px 32px 32px;">
                <div style="padding:20px;border-radius:8px;background:#f8fafc;border:1px solid #e2e8f0;font-size:15px;line-height:1.65;white-space:pre-wrap;">{{ $body }}</div>
            </td>
        </tr>
        <tr>
            <td style="padding:16px 32px;border-top:1px solid #e2e8f0;font-size:12px;color:#94a3b8;">
                Sent from the contact form on {{ config('app.url') }}@if ($ipAddress) &middot; IP {{ $ipAddress }}@endif
            </td>
        </tr>
    </table>
</body>
</html>
