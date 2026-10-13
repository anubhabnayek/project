<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application Update</title>
</head>

@php
$status = strtolower(trim((string) $leave->status));

$colors = [
'approved' => ['bg' => '#e6f4ea', 'text' => '#1e7e34', 'bar' => '#28a745'],
'rejected' => ['bg' => '#fdecea', 'text' => '#b02a37', 'bar' => '#dc3545'],
];
$c = $colors[$status] ?? ['bg' => '#fff8e1', 'text' => '#8a6d00', 'bar' => '#ffc107'];
@endphp

<body style="margin:0; padding:0; background-color:#f4f6f9; font-family:Arial, Helvetica, sans-serif;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f9; padding:30px 0;">
        <tr>
            <td align="center">

                <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                    style="width:100%; max-width:600px; background-color:#ffffff; border-radius:6px; overflow:hidden; border:1px solid #e3e6ea;">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color:#343a40; padding:24px;">
                            <h1 style="margin:0; color:#ffffff; font-size:22px; font-weight:bold;">
                                Leave Management System
                            </h1>
                        </td>
                    </tr>

                    <!-- Status bar -->
                    <tr>
                        <td style="background-color:{{ $c['bar'] }}; height:4px; font-size:0; line-height:0;">&nbsp;</td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px 36px; color:#333333; font-size:15px; line-height:1.6;">

                            <p style="margin:0 0 16px 0;">
                                Hello <strong>{{ $leave->employee->name ?? 'Employee' }}</strong>,
                            </p>

                            <p style="margin:0 0 24px 0;">{{ $messageText }}</p>

                            <!-- Details -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0"
                                style="border:1px solid #e3e6ea; border-radius:4px; font-size:14px;">
                                <tr>
                                    <td style="padding:12px 16px; background-color:#f8f9fa; border-bottom:1px solid #e3e6ea; width:35%;"><strong>Leave Type</strong></td>
                                    <td style="padding:12px 16px; border-bottom:1px solid #e3e6ea;">{{ $leave->leave_type }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; background-color:#f8f9fa; border-bottom:1px solid #e3e6ea;"><strong>From Date</strong></td>
                                    <td style="padding:12px 16px; border-bottom:1px solid #e3e6ea;">{{ \Carbon\Carbon::parse($leave->from_date)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; background-color:#f8f9fa; border-bottom:1px solid #e3e6ea;"><strong>To Date</strong></td>
                                    <td style="padding:12px 16px; border-bottom:1px solid #e3e6ea;">{{ \Carbon\Carbon::parse($leave->to_date)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; background-color:#f8f9fa;{{ $leave->rejection_reason ? ' border-bottom:1px solid #e3e6ea;' : '' }}"><strong>Status</strong></td>
                                    <td style="padding:12px 16px; {{ $leave->rejection_reason ? ' border-bottom:1px solid #e3e6ea;' : '' }}">
                                        <span style="display:inline-block; padding:4px 12px; border-radius:12px; background-color:{{ $c['bg'] }}; color:{{ $c['text'] }}; font-weight:bold; font-size:13px;">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                </tr>

                                @if($leave->rejection_reason)
                                <tr>
                                    <td style="padding:12px 16px; background-color:#f8f9fa;"><strong>Rejection Reason</strong></td>
                                    <td style="padding:12px 16px;">{{ $leave->rejection_reason }}</td>
                                </tr>
                                @endif
                            </table>

                            <p style="margin:28px 0 0 0;">
                                Regards,<br>
                                <strong>Admin Team</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color:#f8f9fa; padding:16px; font-size:12px; color:#888888; border-top:1px solid #e3e6ea;">
                            This is an automated message. Please do not reply to this email.<br>
                            &copy; {{ date('Y') }} Leave Management System
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
