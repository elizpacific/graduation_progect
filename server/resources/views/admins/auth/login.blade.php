<!Doctype html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<x-registration-auth-layout>
    <x-slot name="title">Admin login</x-slot>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label>
            <input type="text" name="email" placeholder="Email"/>
        </label>
        <label>
            <input type="password" name="password" placeholder="Password"/>
        </label>
        <button type="submit">Login</button>
    </form>
</x-registration-auth-layout>

