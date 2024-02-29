<!DOCTYPE html>
<html>

<head>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>


    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f6f6f6;
            margin-top: 40px;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .report-title h1 {
            text-align: center;
            margin-top: 0;
        }

        button {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <button onclick="generatePdf()" class="btn btn-primary mb-3">Download PDF</button>

        <div class="report-title">
            <br><br>
            <h1>Leave Application</h1>
            <!-- Optional: Place for logo or institution name -->
        </div>
        <!-- Display leave applications details here -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>NAME</th>
                    <th>LASTNAME</th>
                    <th>START DATE</th>
                    <th>END DATE</th>
                    <th>REASON</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leavework as $leave)
                <tr>
                    <td>{{ $leave->emp_id }}</td>
                    <td>{{ $leave->first_name }}</td>
                    <td>{{ $leave->last_name }}</td>
                    <td>{{ $leave->from_date }}</td>
                    <td>{{ $leave->to_date }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td style="{{ $leave->status == 'อนุมัติ' ? 'color: green;' : ($leave->status == 'ปฏิเสธ' ? 'color: red;' : '') }}">
                        {{ $leave->status }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function generatePdf() {
            const doc = new window.jspdf.jsPDF();
doc.text('Leave Applications', 10, 10);



            // Capture the table data
            const tableData = [];
            @foreach ($leavework as $leave)
            tableData.push([
                "{{ $leave->emp_id }}",
                "{{ $leave->first_name }}",
                "{{ $leave->last_name }}",
                "{{ $leave->from_date }}",
                "{{ $leave->to_date }}",
                "{{ $leave->reason }}",
                "{{ $leave->status }}"
            ]);
            @endforeach

            doc.text('Leave Applications', 10, 10);
            doc.autoTable({
                startY: 30,
                head: [
                    ["EMP ID", "NAME", "LASTNAME", "START DATE", "END DATE", "REASON", "STATUS"]
                ],
                body: tableData,
                styles: {
                    fillColor: [220, 220, 220],
                    textColor: 50,
                    fontSize: 10
                },
                columnStyles: {
                    0: { cellWidth: 30 },  // Adjust the ID column width
                    4: { cellWidth: 'wrap' },
                    5: { cellWidth: 'wrap' },
                    6: { cellWidth: 30 }   // Adjust the Status column width
                },
                margin: { top: 60 }
            });

            // Save the PDF document
            doc.save('leave_applications_report.pdf');
        }
    </script>
</body>

</html>
