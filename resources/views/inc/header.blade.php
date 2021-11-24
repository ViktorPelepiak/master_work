@section('header')
    <input id="contextPath" hidden type="text" value="{{ $root_path }}">
    <input id="loggedUserId" hidden type="text" value="{{ \Illuminate\Support\Facades\Auth::id() }}">

    <div class="navbar fixed-top navbar-dark app-bg-gray">
        <a href="{{route('root')}}"><img class="logo" src="/images/ChNU_Small_Logo.png" alt="Logo"></a>

        @if(\Illuminate\Support\Facades\Auth::check())
            <div style="display: flex">
                <button class="btn btn-primary btn-my-voting" onclick="mySurveys()">Мої голосування</button>
                <button class="btn btn-danger" onclick="logout()">Вийти</button>
            </div>
        @else
            <button class="btn btn-primary" onclick="login()">Увійти</button>
        @endif
    </div>

    <script src="/js/header.js"/>"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@endsection
