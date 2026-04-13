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

        .logo-container {
            flex-shrink: 0;
        }

        .logo {
            width: 8rem;
            height: auto;
        }

        .header-title {
            text-align: right;
            margin: 0;
            font-size: 1.5rem;
        }

        .content {
            padding: 1.25rem;
        }

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

        .field {
            margin-bottom: 10px;
        }

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

        .callback-box,
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

        .footer-p {
            margin-top: 0rem;
            margin-bottom: 0.25rem;
        }

        .footer-p0 {
            margin: 0rem;
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 100%;
                margin: 0;
                border-radius: 0;
            }

            .header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .header-title {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <!-- Replace the src with your actual logo URL -->
                <img class="logo" src="{{ asset('images/your-logo.png') }}" alt="Company Logo">
            </div>
            <h2 class="header-title">New Customer Enquiry</h2>
        </div>

        <div class="content">
            <!-- Customer Information -->
            <div class="section">
                <h3>Customer Information</h3>
                <div class="field">
                    <div class="label">Name:</div>
                    <div class="value">{{ $data['cust_name'] }}</div>
                </div>
                <div class="field">
                    <div class="label">Email:</div>
                    <div class="value">{{ $data['cust_email'] }}</div>
                </div>
                <div class="field">
                    <div class="label">Phone Number:</div>
                    <div class="value">{{ $data['cust_phone'] }}</div>
                </div>
            </div>

            <!-- Interest & Query -->
            <div class="section">
                <h3>Enquiry Details</h3>
                <div class="field">
                    <div class="label">Customer's Interest:</div>
                    <div class="value">{{ $data['cust_pool_interests'] }}</div>
                </div>
                <div class="query-box">
                    <div class="label">Customer's Query:</div>
                    <div class="value query-value">{{ $data['cust_query'] }}</div>
                </div>
            </div>

            <!-- Callback Details -->
            <div class="section">
                <h3>Requested Callback Time</h3>
                <div class="callback-box">
                    <div class="field">
                        <div class="label">Date:</div>
                        <div class="value">{{ \Carbon\Carbon::parse($data['cust_callback_date'])->format('l, j F Y') }}</div>
                    </div>
                    <div class="field">
                        <div class="label">Time:</div>
                        <div class="value">{{ \Carbon\Carbon::parse($data['cust_callback_time'])->format('g:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p class="footer-p">© {{ date('Y') }} Aquarius Swimming Pools.</p>
            <p class="footer-p0">This is a notification for a new customer enquiry received through aquariusswimmingpools.com. Please
                respond within our standard response time of 2 working days.</p>
        </div>
    </div>
</body>

</html>
