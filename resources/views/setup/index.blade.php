<form action="{{ route('setup.store') }}" method="POST">
    {{ csrf_field() }}

    <input type="text" name="name">
    <input type="text" name="email">
    <input type="password" name="password">
    <input type="submit" value="Save">
</form>