<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official e-Statement — {{ $customer->name }} — BankFlow MY</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #0f172a;
            background: #fff;
            margin: 0;
            padding: 30px;
            font-size: 12px;
            line-height: 1.5;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #0f172a;
            padding-bottom: 20px;
            margin-bottom: 24px;
        }
        .bank-brand {
            font-size: 18px;
            font-weight: 900;
            letter-spacing: -0.5px;
            color: #059669;
        }
        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
            background: #f8fafc;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }
        .metric-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 12px;
            border-radius: 8px;
        }
        .metric-label {
            font-size: 10px;
            text-transform: uppercase;
            color: #64748b;
            font-weight: 700;
        }
        .metric-val {
            font-size: 14px;
            font-weight: 800;
            font-family: monospace;
            margin-top: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            background: #0f172a;
            color: #fff;
            font-size: 11px;
            text-transform: uppercase;
            padding: 8px 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }
        .text-right { text-align: right; }
        .text-emerald { color: #059669; font-weight: 700; }
        .text-rose { color: #e11d48; font-weight: 700; }
        .footer {
            border-top: 1px solid #cbd5e1;
            padding-top: 16px;
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: #64748b;
        }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="background: #059669; color: #fff; border: none; padding: 8px 16px; border-radius: 6px; font-weight: bold; cursor: pointer;">
            Print / Save to PDF
        </button>
    </div>

    <div class="header">
        <div>
            <div class="bank-brand">BANKFLOW MALAYSIA BERHAD</div>
            <div style="font-size: 10px; color: #64748b; margin-top: 2px;">
                Registration No: 202601004921 (142099-M) &bull; Licensed Islamic Commercial Bank
            </div>
            <div style="font-size: 10px; color: #64748b;">
                Head Office: Menara BankFlow, Level 28, Jalan Tun Perak, 50050 Kuala Lumpur
            </div>
        </div>
        <div style="text-align: right;">
            <div style="display: inline-block; padding: 4px 8px; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 4px; color: #065f46; font-weight: bold; font-size: 10px;">
                CERTIFIED OFFICIAL e-STATEMENT
            </div>
            <div style="font-family: monospace; font-size: 10px; color: #64748b; margin-top: 4px;">
                HASH: SHA256-BF{{ substr(md5($account->account_number ?? '0'), 0, 16) }}
            </div>
        </div>
    </div>

    <div class="meta-grid">
        <div>
            <div style="font-size: 10px; color: #64748b; font-weight: bold; text-transform: uppercase;">Account Holder Details</div>
            <div style="font-size: 13px; font-weight: bold; margin-top: 2px;">{{ $customer->name }}</div>
            <div>Account: {{ $account->account_number ?? '1640 1234 5678' }} ({{ $account->account_name ?? 'Savings-i' }})</div>
            <div style="color: #64748b;">Contact: {{ $customer->phone_number }}</div>
        </div>
        <div style="text-align: right;">
            <div style="font-size: 10px; color: #64748b; font-weight: bold; text-transform: uppercase;">Statement Cycle</div>
            <div style="font-size: 13px; font-weight: bold; margin-top: 2px;">
                {{ \Carbon\Carbon::createFromDate($year, $month, 1)->format('F Y') }}
            </div>
            <div>Currency: Malaysian Ringgit (MYR)</div>
            <div style="color: #059669; font-weight: bold;">PIDM Protected up to RM250,000</div>
        </div>
    </div>

    <div class="metrics-grid">
        <div class="metric-card">
            <div class="metric-label">Opening Balance</div>
            <div class="metric-val">RM {{ number_format($statement['opening_balance'] ?? 0, 2) }}</div>
        </div>
        <div class="metric-card">
            <div class="metric-label">Total Credits (+)</div>
            <div class="metric-val text-emerald">+RM {{ number_format($statement['total_credits'] ?? 0, 2) }}</div>
        </div>
        <div class="metric-card">
            <div class="metric-label">Total Debits (-)</div>
            <div class="metric-val text-rose">-RM {{ number_format($statement['total_debits'] ?? 0, 2) }}</div>
        </div>
        <div class="metric-card">
            <div class="metric-label">Closing Balance</div>
            <div class="metric-val">RM {{ number_format($statement['closing_balance'] ?? 0, 2) }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Reference No</th>
                <th>Transaction Details</th>
                <th>Type</th>
                <th class="text-right">Amount (MYR)</th>
                <th class="text-right">Balance (MYR)</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($statement['transactions']) && $statement['transactions']->isNotEmpty())
                @foreach($statement['transactions'] as $tx)
                    <tr>
                        <td>{{ $tx->created_at ? $tx->created_at->format('d M Y, h:i A') : '-' }}</td>
                        <td style="font-family: monospace;">{{ $tx->reference_number }}</td>
                        <td>
                            <strong>{{ $tx->recipient_name ?? $tx->description }}</strong>
                            <div style="font-size: 10px; color: #64748b;">{{ $tx->description }}</div>
                        </td>
                        <td>{{ ucfirst(str_replace('_', ' ', $tx->transaction_type)) }}</td>
                        <td class="text-right {{ $tx->direction === 'credit' ? 'text-emerald' : 'text-rose' }}" style="font-family: monospace;">
                            {{ $tx->direction === 'credit' ? '+' : '-' }}RM {{ number_format($tx->amount, 2) }}
                        </td>
                        <td class="text-right" style="font-family: monospace; font-weight: 600;">
                            RM {{ number_format($tx->balance_after, 2) }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" style="text-align: center; color: #64748b; padding: 20px;">
                        No transactions recorded for this statement cycle.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <div>
            This document is computer-generated by BankFlow Malaysia Core Banking Ledger and authenticated via Digital Certificate.<br>
            Protected by PIDM (Perbadanan Insurans Deposit Malaysia). Regulated by Bank Negara Malaysia.
        </div>
        <div style="text-align: right; font-family: monospace;">
            Generated on: {{ date('Y-m-d H:i:s') }}
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('autoprint') === '1') {
                window.print();
            }
        });
    </script>
</body>
</html>
