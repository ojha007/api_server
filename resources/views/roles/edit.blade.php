@extends('roles.edit_index')
@section('roles-edit')
    {{ Form::hidden('guard_name', 'web') }}
    @include('permissions.backend-permissions')
@endsection

