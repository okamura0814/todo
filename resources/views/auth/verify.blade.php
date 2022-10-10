@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メール認証</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                        メール認証リンクがあなたのメールアドレス宛に送信されました。
                        </div>
                    @endif

                    メールを送信しました。メールからメールアドレスの認証をお願いします。<br>
                    メールが届いていない場合は
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">こちらをクリックしてください。再送信いたします。</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
