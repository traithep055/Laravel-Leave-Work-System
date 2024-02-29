<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add jobs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body class="bg-light py-5">

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow">
            <div class="card-header text-center bg-primary text-white">
              <h4>Add Job Details</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('add.job.details') }}" method="POST">
                @csrf

                <div class="mb-3">
                  <label for="emp_id" class="form-label">Employee ID:</label>
                  <select class="form-select" name="emp_id" id="emp_id">
                      @foreach($employees as $employee)
                          <option value="{{ $employee->emp_id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                      @endforeach
                  </select>
                </div>

                <div class="mb-3">
                  <label for="department" class="form-label">Department:</label>
                  <input type="text" class="form-control" name="department" id="department">
                </div>

                <div class="mb-3">
                  <label for="joining_date" class="form-label">Joining Date:</label>
                  <input type="date" class="form-control" name="joining_date" id="joining_date">
                </div>

                <div class="mb-3">
                  <label for="salary" class="form-label">Salary:</label>
                  <input type="text" class="form-control" name="salary" id="salary">
                </div>

                <div class="d-grid gap-2">
                  <input type="submit" value="Add Details" class="btn btn-primary">
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
