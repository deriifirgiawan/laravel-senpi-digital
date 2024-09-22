<!-- resources/views/reports/pdf.blade.php -->
<!DOCTYPE html>
<html>

    <head>
        <title>{{ $title }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            table,
            th,
            td {
                border: 1px solid black;
            }

            th,
            td {
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .section-kop-surat {
                text-align: center;
                border-bottom: 1px solid #000;
                width: 100%;
                padding: 0px 10px;
            }
        </style>
    </head>

    <body>
        <section class="section-kop-surat">
            <p>KEPOLISIAN NEGARA REBUBLIK</p>
            <p>INDONESIA</p>
            <p>DAERAH JAWA BARAT</p>
            <p>RESOR CIANJUR</p>
        </section>
        <h2>{{ $title }}</h2>
        <p>Periode: {{ $start_date }} sampai {{ $end_date }}</p>

        <table>
            <thead>
                <tr>
                    @foreach ($headings as $heading)
                        <th style="text-transform: capitalize;">{{ $heading }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        @foreach ($headings as $heading)
                            <td>{{ $row[$heading] }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>

</html>
