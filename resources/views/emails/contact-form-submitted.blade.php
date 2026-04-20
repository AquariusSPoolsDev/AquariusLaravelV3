<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer Enquiry</title>
    <style>
        body {
            font-family: Inter, Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 2rem 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 37.5rem;
            margin: 1.5rem auto;
            background: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 0.3rem 0.6rem rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #071019;
            color: #ffffff;
            padding: 1.25rem;
            border-radius: 0.75rem 0.75rem 0 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-container { flex-shrink: 0; }

        .logo { width: 8rem; height: auto; }

        .header-title {
            text-align: right;
            margin: 0;
            font-size: 1.5rem;
        }

        .content { padding: 1.25rem; }

        .section {
            margin-bottom: 1rem;
            border-bottom: 0.1rem solid #edf2f7;
            padding-bottom: 1rem;
        }

        .section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .section h3 {
            color: #071019;
            margin-top: 0;
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .field { margin-bottom: 10px; }

        .label {
            font-weight: bold;
            color: #071019;
            font-size: 1rem;
            display: inline-block;
        }

        .value {
            color: #2d3748;
            display: inline-block;
        }

        .query-value {
            margin-top: 0.25rem;
            display: block;
        }

        .query-box {
            background: #f7fafc;
            border-radius: 0.5rem;
            padding: 1rem;
            border-left: 0.25rem solid #071019;
        }

        .footer {
            text-align: center;
            padding: 1.25rem;
            color: #071019;
            font-size: 0.75rem;
            border-top: 0.1rem solid #edf2f7;
            background: #f8fafc;
            border-radius: 0 0 0.5rem 0.5rem;
        }

        .footer-p { margin-top: 0; margin-bottom: 0.25rem; }
        .footer-p0 { margin: 0; }

        @media only screen and (max-width: 600px) {
            .container { width: 100%; margin: 0; border-radius: 0; }
            .header { flex-direction: column; text-align: center; gap: 1rem; }
            .header-title { text-align: center; }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <img class="logo" src="{{ asset('assets/images/aquarius-logo-light.png') }}" alt="Aquarius Swimming Pools">
            </div>
            <h2 class="header-title">New Customer Enquiry</h2>
        </div>

        <div class="content">
            <div class="section">
                <h3>Customer Information</h3>
                <div class="field">
                    <div class="label">Name: </div>
                    <div class="value">{{ $submission->name }}</div>
                </div>
                <div class="field">
                    <div class="label">Email: </div>
                    <div class="value">{{ $submission->email }}</div>
                </div>
                <div class="field">
                    <div class="label">Phone: </div>
                    <div class="value">{{ $submission->country_code }} {{ $submission->phone }}</div>
                </div>
            </div>

            <div class="section">
                <h3>Enquiry Details</h3>
                @if ($submission->interest)
                    <div class="field">
                        <div class="label">Interest: </div>
                        <div class="value">
                            {{ $submission->interest }}
                            @if ($submission->interest_other)
                                — {{ $submission->interest_other }}
                            @endif
                        </div>
                    </div>
                @endif
                @if ($submission->query)
                    <div class="query-box">
                        <div class="label">Query:</div>
                        <div class="value query-value">{{ $submission->query }}</div>
                    </div>
                @endif
                @if (!$submission->interest && !$submission->query)
                    <p style="color:#718096">No additional details provided.</p>
                @endif
            </div>
        </div>

        <div class="footer">
            <p class="footer-p">© {{ date('Y') }} Aquarius Swimming Pools.</p>
            <p class="footer-p0">Notification from aquariusswimmingpools.com. Please respond within 2 working days.</p>
        </div>
    </div>
</body>

</html>
