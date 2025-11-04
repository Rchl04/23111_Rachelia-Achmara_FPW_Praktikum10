<!DOCTYPE html>
<html>

<head>
    <title>Rekap Stock Produk Gudang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            margin: 5px 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 11px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        /* Bagian tanda tangan */
        .signatures {
            margin-top: 40px;
            width: 100%;
            font-size: 12px;
        }

        .sign-row {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .sign-box {
            width: 30%;
            text-align: center;
        }

        .sign-name {
            margin-top: 80px;
            border-top: 1px solid #000;
            display: inline-block;
            padding-top: 5px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <h1>PT SUSU ALAM JAYA</h1>
        <h2>Rekap Stock Produk Gudang</h2>
    </header>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Unit</th>
                <th>Type</th>
                <th>Information</th>
                <th>Qty</th>
                <th>Producer</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->unit }}</td>
                <td>{{ $product->type }}</td>
                <td>{{ $product->information }}</td>
                <td>{{ $product->qty }}</td>
                <td>{{ $product->producer }}</td>
                <td>{{ $product->created_at->format('Y-m-d') }}</td>
                <td>{{ $product->updated_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tanda tangan -->
    <table style="width:100%; margin-top:60px; text-align:center; font-size:12px; border:none;">
        <tr>
            <td style="width:33%; border:none;">Dilaksanakan Oleh,</td>
            <td style="width:33%; border:none;">Diketahui Oleh,</td>
            <td style="width:33%; border:none;">Disetujui Oleh,</td>
        </tr>
        <tr>
            <!-- Area kosong untuk tanda tangan -->
            <td style="height:100px; border:none;"></td>
            <td style="height:100px; border:none;"></td>
            <td style="height:100px; border:none;"></td>
        </tr>
        <tr>
            <!-- Nama atau tanda (...................) di bawah tanda tangan -->
            <td style="border:none;">(...........................)</td>
            <td style="border:none;">(...........................)</td>
            <td style="border:none;">(...........................)</td>
        </tr>
    </table>
</body>

</html>