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
            margin: 10px 30px 30px 30px;
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
            font-size: 8px;
            border: 1px solid #000;
        }

        main table thead tr th:first-child {
            padding-left: 10px;
        }

        main table thead tr th:last-child {
            padding-right: 10px;
        }

        main table tbody tr td {
            padding: 10px 0px;
            font-size: 10px;
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
            <th class="report-title">Voter's Count Per Barangay</th>
            <th class="datetime">{{ date('m/d/Y h:i:s A') }}</th>
        </tr>
    </table>
</header>

<main>

    <table style="width: 100%">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">Barangay</th>
                <th rowspan="2" class="text-center">Voter's Count</th>
                <th colspan="3" class="text-center">Age Bracket</th>
                <th colspan="4" class="text-center">Gender</th>
                <th colspan="6" class="text-center">Marital Status</th>
                <th colspan="7" class="text-center">Sectoral Group</th>
                <th colspan="2" class="text-center">Nationality</th>
                <th colspan="5" class="text-center">Engaged Business</th>
                <th colspan="2" class="text-center">Pandi Voter</th>
                <th colspan="7" class="text-center">Religious Affiliation</th>
            </tr>
            <tr>

                <th class="text-center">Adult</th>
                <th class="text-center">Mid-Age</th>
                <th class="text-center">Senior</th>
                <th class="text-center">Male</th>
                <th class="text-center">Female</th>
                <th class="text-center">Preferred not to say</th>
                <th class="text-center">Other Gender</th>
                <th class="text-center">SING</th>
                <th class="text-center">MAR</th>
                <th class="text-center">WID</th>
                <th class="text-center">DIV</th>
                <th class="text-center">COM LAW</th>
                <th class="text-center">OTH</th>
                <th class="text-center">SENIOR</th>
                <th class="text-center">DISA</th>
                <th class="text-center">SOLO</th>
                <th class="text-center">PREG</th>
                <th class="text-center">LAC</th>
                <th class="text-center">HOMLES</th>
                <th class="text-center">NONE</th>
                <th class="text-center">FIL</th>
                <th class="text-center">OTH</th>
                <th class="text-center">OWN</th>
                <th class="text-center">CO-OWN</th>
                <th class="text-center">INVEST</th>
                <th class="text-center">OTH</th>
                <th class="text-center">NO</th>
                <th class="text-center">YES</th>
                <th class="text-center">NO</th>
                <th class="text-center">CATH</th>
                <th class="text-center">BORN</th>
                <th class="text-center">BAP</th>
                <th class="text-center">INC</th>
                <th class="text-center">JEHO</th>
                <th class="text-center">ADV</th>
                <th class="text-center">Other</th>
            </tr>
        </thead>
        <tbody>
        <?php $barangay = '' ?>

            @foreach($reportArr as $report)

                    @if($barangay == '' || $barangay != $report['barangay'])
                        <tr>
                            <td colspan="38" style="border-top: 1px solid #000; font-weight: bold">{{ $report['barangay'] }}</td>
                        </tr>

                        {{ $barangay = $report['barangay'] }}
                    @endif

                        <tr>
                            <td class="text-center"></td>
                            <td class="text-center">{{ $report['voter_count'] }}</td>
                            <td class="text-center">{{ $report['adult'] }}</td>
                            <td class="text-center">{{ $report['midage'] }}</td>
                            <td class="text-center">{{ $report['senior'] }}</td>
                            <td class="text-center">{{ $report['male'] }}</td>
                            <td class="text-center">{{ $report['female'] }}</td>
                            <td class="text-center">{{ $report['no_gender'] }}</td>
                            <td class="text-center">{{ $report['other_gender'] }}</td>

                            <td class="text-center">{{ $report['single'] }}</td>
                            <td class="text-center">{{ $report['married'] }}</td>
                            <td class="text-center">{{ $report['widowed'] }}</td>
                            <td class="text-center">{{ $report['divorce'] }}</td>
                            <td class="text-center">{{ $report['common_law'] }}</td>
                            <td class="text-center">{{ $report['other_marital'] }}</td>

                            <td class="text-center">{{ $report['senior_citizen']}}</td>
                            <td class="text-center">{{ $report['disability']}}</td>
                            <td class="text-center">{{ $report['solo_parent']}}</td>
                            <td class="text-center">{{ $report['pregnant']}}</td>
                            <td class="text-center">{{ $report['lactating_mother']}}</td>
                            <td class="text-center">{{ $report['homeless']}}</td>
                            <td class="text-center">{{ $report['none']}}</td>

                            <td class="text-center">{{ $report['filipino'] }}</td>
                            <td class="text-center">{{ $report['nationality_other'] }}</td>

                            <td class="text-center">{{ $report['business_owner'] }}</td>
                            <td class="text-center">{{ $report['business_co_owner'] }}</td>
                            <td class="text-center">{{ $report['investor'] }}</td>
                            <td class="text-center">{{ $report['business_other'] }}</td>
                            <td class="text-center">{{ $report['business_no'] }}</td>


                            <td class="text-center">{{ $report['voter_yes'] }}</td>
                            <td class="text-center">{{ $report['voter_no'] }}</td>

                            <td class="text-center">{{ $report['catholic'] }}</td>
                            <td class="text-center">{{ $report['born_again'] }}</td>
                            <td class="text-center">{{ $report['baptist'] }}</td>
                            <td class="text-center">{{ $report['inc'] }}</td>
                            <td class="text-center">{{ $report['jehova'] }}</td>
                            <td class="text-center">{{ $report['adventist'] }}</td>
                            <td class="text-center">{{ $report['other_religion'] }}</td>
                        </tr>

            @endforeach
        </tbody>
    </table>
</main>
</body>
</html>


