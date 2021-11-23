<html>
<title>PDF Report</title>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        .pagenum:before {
            content: counter(page);
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin: 10px 50px 30px 50px;
            font-family: Arial, sans-serif;
        }

        /* header */

        header  {
            position: fixed;
            padding: 50px 0px 0px 0px;
            width: 100%;
            height: 75px;
        }

        header .table-header tr th{
            text-align: left;
            padding: 1px 0px;
            font-size: 13px;
            font-weight: normal;
        }

        header .table-header tr .company {
            font-weight: bold;
            font-size: 20px;
        }

        header .table-header tr .report-title {
            font-weight: bold;
        }


        /* main */

        main {
            margin-top: 130px;
            font-size: 13px;
        }

        main table {
            border-collapse: collapse;
        }

        main table thead {
            border: 1px solid #000;
        }

        main table thead tr th {
            padding: 5px 0px;
            text-align: left;
            font-weight: normal;
            border: 1px solid #000;
        }

        main table thead tr th:first-child {
            padding-left: 10px;
        }

        main table thead tr th:last-child {
            padding-right: 10px;
        }

        main table tbody tr td {
            display: table-cell;
            vertical-align: top;
            padding: 10px 0px;
        }

        main table tbody tr td:first-child {
            padding-left: 10px;
        }

        main table tbody tr td:last-child {
            padding-right: 10px;
        }

        .text-center {
            text-align: center;
        }


    </style>
</head>
<body>

<header>
    <table class="table-header" width="100%;">
        <tr>
            <th width="75%" class="company">LGU-Pandi Resident Information System</th>
            <th>User ID: <span class="username">{{ Auth::user()->name }}</span></th>
        </tr>
        <tr>
            <th class="city">Pandi, Bulacan</th>
            <th class="page-number">Page No: <span class="pagenum"></span></th>
        </tr>
        <tr>
            <th class="report-title">House Holds Per Barangay</th>
            <th class="datetime">{{ date('m/d/Y h:i:s A') }}</th>
        </tr>
    </table>
</header>

<main>

    <table style="width: 100%">
        <thead>
        <tr>
            <th rowspan="2" class="text-center" style="width:8%">Barangay / HH#</th>
            <th rowspan="2" class="text-center" style="width: 20%">Address</th>
            <th rowspan="2" class="text-center" style="width: 20%">Head</th>
            <th colspan="5" class="text-center" style="width: 20%">Member</th>
        </tr>
        <tr>
            <th class="text-center" style="width: 20%">Name</th>
            <th class="text-center">Gender</th>
            <th class="text-center">#</th>
            <th class="text-center">Birthday</th>
            <th class="text-center">Marital</th>
        </tr>
        </thead>
        <tbody>

            <?php $barangay = '' ?>
            <?php $household_id = '' ?>

            @foreach($reportArr as $household)

                @if($barangay == '' || $barangay != $household['barangay'])
                    <tr>
                        <td colspan="8" style="border-top: 1px solid #000; font-weight: bold">{{ $household['barangay'] }}</td>
                    </tr>

                    {{ $barangay = $household['barangay'] }}
                @endif


                @if($household_id == '' || $household_id != $household['household_id'])
                    <tr>
                        <td class="text-center">{{ $household['household_id'] }}</td>
                        <td>{{ $household['household'] }}</td>
                        <td colspan="5">{{ $household['family_head'] }}</td>
                    </tr>

                    {{ $household_id = $household['household_id'] }}
                @endif


                @foreach($household['member'] as $member)

                    <tr>
                        <td colspan="3"></td>
                        <td>{{ $member['member'] }}</td>
                        <td class="text-center">{{ $member['gender'] }}</td>
                        <td class="text-center">{{ $member['mobile_number'] }}</td>
                        <td class="text-center">{{ date('m/d/Y', strtotime($member['birthday'])) }}</td>
                        <td class="text-center">{{ $member['marital_status'] }}</td>
                    </tr>

                @endforeach








            @endforeach

        </tbody>
    </table>
</main>
</body>
</html>


