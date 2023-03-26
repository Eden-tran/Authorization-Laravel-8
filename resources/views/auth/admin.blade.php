<h1>Admin Dashboard</h1>

@if (Auth::check())
    <h3>Đã Đăng nhập</h3>
    <p>ID: {{ $userDetail->id }}</p>
    <p>Email: {{ $userDetail->email }}</p>
    <p>Name: {{ $userDetail->name }}</p>
    <p>Phone: {{ $userDetail->username }}</p>
@endif
