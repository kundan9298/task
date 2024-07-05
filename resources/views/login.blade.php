<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
   
  <title>Document</title>
</head>
<body>


  <div class="techerlogin">
    <h3>tailwebs</h3>
    @if($message = Session::get('success'))
    <div class="alert alert-info">
    {{ $message }}
    </div>
    @endif

    <form action="{{ url('/loginData') }}" method="POST" enctype="multipart/form-data">
      
       @csrf
      <div class="form-group">
        <label for="email">Email </label>
        <input type="email" name="email" id="email" placeholder="Email ID" required>
        <div>
        @if($errors->has('email'))
							<span class="text-danger">{{ $errors->first('email') }}</span>
				@endif
        </div>
       
      </div>
     
      <div class="form-group">
        <label for="password">Password</label>
        
        <input type="password" id="password" placeholder="Password" name="password" required>
        <div>
          @if($errors->has('password'))
							<span class="text-danger">{{ $errors->first('password') }}</span>
						@endif
        </div>

        <div>
        @if (session('fail'))
          <div class="alert alert-danger">
              {{ session('fail') }}
          </div>  
        @endif
        </div>
          
      </div>

      <button type="submit" class="btn btn-primary name="login">LogIn</button>
    </form>

    
  </div>
 



  
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</html>