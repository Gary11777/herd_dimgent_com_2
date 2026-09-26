New website enquiry: {{ $messageSubject }}

Name:    {{ $senderName }}
Email:   {{ $senderEmail }}
@if ($phone)
Phone:   {{ $phone }}
@endif
@if ($company)
Company: {{ $company }}
@endif

{{ $body }}

--
Sent from the contact form on {{ config('app.url') }}@if ($ipAddress) (IP {{ $ipAddress }})@endif

