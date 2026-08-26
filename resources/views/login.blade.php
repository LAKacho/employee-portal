<!DOCTYPE html>
<form action="/login" method="POST">
    @csrf
    <input type="text" name="email" placeholder="email">
    <input type="password" name="password" placeholder="Пароль">
    <button type="submit">Login</button>
</form>