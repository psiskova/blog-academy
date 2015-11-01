@extends('layouts.master')

{{ $user->name }}<br>
{{ $user->surname }}<br>
{{ $user->fullname }}<br>
{{ $user->email }}<br>
{!! $user->email !!}<br>