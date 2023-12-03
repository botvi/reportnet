<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <style>
        @media print {

            /* CSS untuk mengatur tampilan saat dicetak */
            body {
                padding: 20px;
                font-family: Arial, sans-serif;
            }

            #table {
                border-collapse: collapse;
                width: 100%;
                margin-bottom: 20px;
            }

            #table th,
            #table td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }

            #table th {
                background-color: #f2f2f2;
            }
        }

        /* CSS tambahan untuk desain tabel */
        #table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0 auto;
            width: 100%;
        }

        #table th,
        #table td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        #table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        #table td {
            text-align: left;
        }
    </style>
</head>

<body>
    <table class="table table-borderless text-center"
        style="border-width:0px!important; border:none; text-align:center; width:100%">
        <tbody>
            <tr>
                <td>
                    <h4>
                        LAPORAN PENGADUAN DENGAN STATUS SELESAI<br />
                        WEBNIKS</h4>

                    <p style="margin-left:0px; margin-right:0px">Alamat : Taluk Kuantan, Kode Pos : 29295, No. Telp :
                        6692232</p>
                </td>
            </tr>
        </tbody>
    </table>

    <div
        style="background:#000000; cursor:text; height:4px; margin-bottom:0px; margin-left:0px; margin-right:0px; margin-top:0px; width:100%">
        &nbsp;</div>

    <div style="background:#000000; cursor:text; height:2px; margin-top:2px; width:100%">&nbsp;</div>

    <table id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Instansi</th>
                <th>Admin Jaringan</th>
                <th>Telepon</th>
                <th>IP</th>
                <th>Pengaduan</th>
                <th>Status</th>
         
             
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach($laporan as $data)
            <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nama_instansi }}</td>
                    <td>{{ $data->admin_jaringan }}</td>
                    <td>{{ $data->telepon }}</td>
                    <td>{{ $data->ip_wan }}</td>
                    <td>{{ $data->deskripsi_title }}</td>
                    <td>{{ $data->status }}</td>
                   


                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>
