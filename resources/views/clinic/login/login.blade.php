<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Clinic Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

  <style>
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--bg);
    }
    .login-card {
      width: 100%;
      max-width: 400px;
      background-color: var(--card-bg);
      color: var(--text);
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .form-control {
      background-color: var(--bg);
      color: var(--text);
      border: 1px solid #ced4da;
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #86b7fe;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <h3 class="mb-4 text-center">Clinic Admin Login</h3>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Email</label>
          <input type="text" class="form-control" name="email" id="username" value="{{ old('email') }}"  />
          @error('email')
  <div class="text-danger mt-2">{{ $message }}</div>
@enderror

        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password"  />
          @error('password')
  <div class="text-danger mt-2">{{ $message }}</div>
@enderror

        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
  </script>
</body>
</html>
