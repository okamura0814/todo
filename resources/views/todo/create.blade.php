@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">タスク登録</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('todo.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">タイトル</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="content" class="col-md-4 col-form-label text-md-end">内容</label>

                            <div class="col-md-6">
                                <input id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" autocomplete="content" autofocus>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="datepicker" class="col-md-4 col-form-label text-md-end">期限</label>

                            <div class="col-md-6">
                                <input id="datepicker" type="text" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}" autocomplete="due_date">

                                @error('due_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    追加
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="status" value="0">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#datepicker').datepicker({
        dateFormat: 'yy/mm/dd',
    });
</script>
@endsection