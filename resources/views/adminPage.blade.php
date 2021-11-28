@extends('layout.app')

@section('title')
    Управління користувачами
@endsection

@include('inc.header')

@section('content')
    <link rel="stylesheet" href="/css/admin.css">

    <div class="page-content app-bg-dark flex content justify-center">
        <p class="admins-title">Адміністратори</p>
    </div>
    <div class="app-bg-dark flex content justify-center">
        <div id="admin_container" class="admin-container">
            @if(count($admins) > 0)
                <table class='admin-table table table-hover table-dark'>
                    <tr>
                        <th style="display: flex">Адреса електронної пошти <input id="search" type="text" class="form-control search" placeholder="Пошук"></th>
                        <th class="check-col">Чи активний</th>
                        <th class="small-col"></th>
                        <th class="small-col"></th>
                    </tr>
                    @foreach($admins as $admin)
                        <tr name="admin_row"{{--id="admin_{{ $admin['admin_id'] }}"--}}>
                            <td name="adminEmail">{{ $admin['admin_email'] }}</td>
                            <td class="check-col">
                                <input id="is_enable_{{ $admin['admin_id'] }}" type="checkbox" class="form-check" disabled @if($admin['enable']) checked @endif>
                            </td>
                            <td class="small-col">
                                @if($admin['enable'])
                                    <button id="admin_disable_{{ $admin['admin_id'] }}" class="btn btn-danger btn-table"
                                            onclick="disable({{ $admin['admin_id'] }})">Заблокувати
                                    </button>
                                    <button id="admin_enable_{{ $admin['admin_id'] }}" class="btn btn-success btn-table"
                                            style="display: none" onclick="enable({{ $admin['admin_id'] }})">
                                        Розблокувати
                                    </button>
                                @else
                                    <button id="admin_disable_{{ $admin['admin_id'] }}" class="btn btn-danger btn-table"
                                            style="display: none" onclick="disable({{ $admin['admin_id'] }})">
                                        Заблокувати
                                    </button>
                                    <button id="admin_enable_{{ $admin['admin_id'] }}" class="btn btn-success btn-table"
                                            onclick="enable({{ $admin['admin_id'] }})">Розблокувати
                                    </button>
                                @endif
                            </td>
                            <td class="small-col">
                                <button class="btn btn-danger btn-table" onclick="deleteAdminById({{ $admin['admin_id'] }})">Видалити</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="admins-not-exist">Користувачів з правами адміністратора немає. Додайте нового адміністратора
                    натиснувши кнопку "+"</h3>
            @endif


        </div>
    </div>

    <nav class="navbar fixed-bottom">
        <button type="button" class="new-admin-btn" data-toggle="modal" data-target="#newAdmin"><p>+</p></button>
    </nav>


    <!-- Modal -->
    <div class="modal" id="newAdmin" tabindex="-1" role="dialog" aria-labelledby="newAdminLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form  method="POST" action="{{route('admin.newAdmin')}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newAdminLabel">Додати адміністратора</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <label for="email" class="col-form-label-lg">Email користувача</label>
                            <input class="form-control" id="email" name="email" type="email" required value=""
                                   placeholder="Email">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label-lg">Пароль</label>
                            <input class="form-control" id="password" name="password" type="password" value=""
                                   placeholder="Пароль" required>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="confirm_password" class="col-form-label-lg">Підтвердіть пароль</label>
                            <input class="form-control" id="confirm_password" name="confirm_password" type="password"
                                   value="" placeholder="Підтвердіть пароль" required>
                            @error('confirm_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-modal btn-secondary" data-dismiss="modal">Скасувати
                        </button>
                        <button type="submit" class="btn btn-modal btn-primary">
                            Зберегти
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/js/admin.js"></script>
@endsection
