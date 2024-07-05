<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- <link rel="stylesheet" href="{{ asset('style.css') }}"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
    /* Style for the overlay */
    #overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 9999;
      display: none; /* Hidden by default */
      /* justify-content: center; */
      /* align-items: center; */
      font-size: 24px;
    }

    form {
      padding: 10px;
      width: 500px;
      height: auto;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: rgb(255, 255, 255);
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      font-size: 16px;
    }
    
  </style>
</head>
<body>
  <div>
  <nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand text-danger">tailwebs</a>

    <a href="{{ route('logout') }}"><button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</button></a>
    </form>
</nav>

  </div>


  @if($message = Session::get('success'))
    <div class="alert alert-info">
    {{ $message }}
    </div>
    @endif

    @if($message = Session::get('fail'))
    <div class="alert alert-danger">
    {{ $message }}
    </div>
    @endif



<div class="container mt-4 mb-4">
  <div class="addstudent ">
    <button type="button" id="addstd" onclick="addStudent()" class="btn btn-primary text-center">Add Student Details</button>

    


    <div id="overlay">
      <form method="post" action="{{ url('addstudent') }}" id="studentForm">
        @csrf
        <h2 id="formTitle">Add New Student</h2>
        <input type="hidden" name="_method" id="formMethod" value="POST">
        <input type="hidden" id="studentId" name="student_id">
        
        <div class="mb-2">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
          @if($errors->has('name'))
							<span class="text-danger">{{ $errors->first('name') }}</span>
				@endif
        </div>
        <div class="mb-2">
          <label for="subject" class="form-label">Subject</label>
          <input type="text" class="form-control" name="subject" id="subject">
          @if($errors->has('subject'))
							<span class="text-danger">{{ $errors->first('subject') }}</span>
				  @endif
         </div>
        <div class="mb-2">
          <label for="mark" class="form-label">Mark</label>
          <input type="number" class="form-control" id="mark" name="mark">
          @if($errors->has('mark'))
							<span class="text-danger">{{ $errors->first('mark') }}</span>
				  @endif
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" onclick="closeForm()" class="btn btn-secondary">Close</button>
      </form>
    </div>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Subject</th>
        <th scope="col">Marks</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($students as $student)
      <tr>
        <th scope="row">{{ $student->id }}</th>
        <td>{{ $student->name }}</td>
        <td>{{ $student->subject }}</td>
        <td>{{ $student->mark }}</td>
        <td>
          <a href="#" onclick="editStudent({{ $student->id }})">
            <i class="fa-solid fa-pen-to-square"></i>
          </a> |
          <a href="#" onclick="confirmDelete('{{ url('/delete-data/'.$student->id) }}')"><i class="fa-solid fa-trash"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script>
  function confirmDelete(id){
    var confirmation = confirm("Do you really want to delete this ?");
    if(confirmation){
      window.location.href = id;
    }

  }
  function addStudent() {
   

    document.getElementById('formTitle').textContent = 'Add New Student';
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('studentForm').action = '{{ url('/addstudent/') }}';
    document.getElementById('studentForm').reset();
    document.getElementById('overlay').style.display = 'flex';
  }

  function closeForm() {
    document.getElementById('overlay').style.display = 'none';
  }

  function editStudent(id) {
    
    fetch(`/get-student-data/${id}`)
      .then(response => response.json())
      .then(data => {
        
        document.getElementById('studentId').value = data.id;
        document.getElementById('name').value = data.name;
        document.getElementById('subject').value = data.subject;
        document.getElementById('mark').value = data.mark;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('studentForm').action = `/update-data/${id}`;
        document.getElementById('formTitle').textContent = 'Edit Student';
        document.getElementById('overlay').style.display = 'flex';
      })
      .catch(error => console.error('Error:', error));
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
