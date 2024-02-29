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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>

<body>
    <div class="container mt-5">
        <button onclick="generatePdf()" class="btn btn-primary mb-3">Download PDF</button>
        <div class="report-title">
            <h1>รายชื่อพนักงานทั้งหมด</h1>
        </div>

        <!-- Display employee details here -->
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>วันที่เข้าทำงาน</th>
                    <th>วันเกิด</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทร</th>
                    <th>แผนก</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emp as $employee)
                <tr>
                    <td>{{ $employee->emp_id }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->joining_date }}</td>
                    <td>{{ $employee->dob }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->contact_number }}</td>
                    <td>{{ $employee->department }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function generatePdf() {
            const doc = new window.jspdf.jsPDF();

            // Capture the table data
            const tableData = [];
            @foreach ($emp as $employee)
            tableData.push([
                "{{ $employee->emp_id }}",
                "{{ $employee->first_name }}",
                "{{ $employee->last_name }}",
                "{{ $employee->joining_date }}",
                "{{ $employee->dob }}",
                "{{ $employee->address }}",
                "{{ $employee->contact_number }}",
                "{{ $employee->department }}"
            ]);
            @endforeach

            doc.text('Employee Details', 10, 10);
            doc.autoTable({
                startY: 30,
                head: [
                    ["EMP ID", "FNAME", "LNAME", "START", "DOB", "Address", "Call", "DEP"]
                ],
                body: tableData,
                styles: {
                    fontSize: 10,
                    cellPadding: 4,
                },
                columnStyles: {
                    0: { cellWidth: 25 },  // Adjust the ID column width
                },
                margin: { top: 60 }
            });

            // Save the PDF document
            doc.save('employee_details_report.pdf');
        }
    </script>
</body>

</html>
