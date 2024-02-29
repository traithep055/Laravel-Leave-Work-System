<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
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
    <<div class="container mt-5">
        <button onclick="generatePdf()" class="btn btn-primary mb-3">Download PDF</button>

        <div class="container">
            <div class="report-title">
                <br><br>
                <h1>Attendance</h1>
                <!-- Optional: Place for logo or institution name -->
            </div>

            <!-- Display attendance details here -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Field</th>
                        <th>date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendanceDetails as $attendance)
                        <tr>
                            <td>{{ $attendance->emp_id }}</td>
                            <td>{{ $attendance->first_name }}</td>
                            <td>{{ $attendance->last_name }}</td>
                            <td>{{ $attendance->department }}</td>
                            <td>{{ $attendance->date }}</td>
                            <td>{{ $attendance->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Additional content and styling as needed -->

        </div>


        <script>
            function generatePdf() {
                const doc = new window.jspdf.jsPDF();

                // Capture the table data
                const tableData = [];
                @foreach ($attendanceDetails as $attendance)
                    tableData.push([
                        "{{ $attendance->emp_id }}",
                        "{{ $attendance->first_name }}",
                        "{{ $attendance->last_name }}",
                        "{{ $attendance->department }}",
                        "{{ $attendance->date }}",
                        "{{ $attendance->status }}"
                    ]);
                @endforeach

                doc.text('Attendance', 10, 10);
                doc.autoTable({
                    startY: 30,
                    head: [
                        ["ID", "Name", "Lastname", "Field", "Date", "Status"]
                    ],
                    body: tableData,
                    styles: {
                        fillColor: [220, 220, 220],
                        textColor: 50,
                        fontSize: 10
                    },
                    columnStyles: {
                        0: {
                            cellWidth: 20
                        },
                        4: {
                            cellWidth: 'wrap'
                        },
                        5: {
                            cellWidth: 'wrap'
                        }
                    },
                    margin: {
                        top: 60
                    }
                });

                doc.save('attendance_report.pdf');
            }
        </script>


</body>

</html>
