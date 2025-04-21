<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Employee Dashboard – Coming Soon</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      height: 100vh;
      background: linear-gradient(to right, #667eea, #764ba2);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
    }

    .container {
      text-align: center;
      background: rgba(255, 255, 255, 0.1);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 15px;
    }

    p {
      font-size: 1.2rem;
      opacity: 0.9;
    }

    .loader {
      margin: 30px auto 0;
      border: 6px solid rgba(255, 255, 255, 0.3);
      border-top: 6px solid #fff;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Employee Dashboard Coming Soon</h1>
    <p>We're working hard to bring you something awesome!</p>
    <div class="loader"></div><br>
    <a href="{{ route('logout') }}" class="btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        Logout
    </a>

  </div>
</body>
</html>
