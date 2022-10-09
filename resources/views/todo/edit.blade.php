@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">タスク編集</div>

                <form method="POST" id="destroy_form" action="{{ route('todo.destroy',$todo->id) }}">
                    @csrf
                </form>

                <div class="card-body">
                    <form method="POST" id="update_form" action="{{ route('todo.update',$todo->id) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label text-md-end">タイトル</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title',$todo->title) }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="content" class="col-md-3 col-form-label text-md-end">内容</label>

                            <div class="col-md-8">
                                <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" autocomplete="content" autofocus style="height: 200px">{{ old('content',$todo->content) }}</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inlineRadio1" class="col-md-3 col-form-label text-md-end">ステータス</label>

                            <div class="col-md-8">
                                <div class="form-check form-check-inline m-1">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" {{ old('status',$todo->status) == 0? 'checked':''; }}>
                                    <label class="form-check-label" for="inlineRadio1">未対応</label>
                                </div>
                                <div class="form-check form-check-inline m-1">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="1" {{ old('status',$todo->status) == 1? 'checked':''; }}>
                                    <label class="form-check-label" for="inlineRadio2">完了</label>
                                </div>

                                @error('due_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="datepicker" class="col-md-3 col-form-label text-md-end">期限</label>

                            <div class="col-md-8">
                                <input id="datepicker" type="text" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date',$todo->due_date->format('Y/m/d')) }}" autocomplete="due_date">

                                @error('due_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-8">
                            <button type="submit" form="destroy_form" class="btn btn-danger me-md-2">
                                削除
                            </button>
                            <button type="submit" form="update_form" class="btn btn-primary">
                                更新
                            </button>
                        </div>
                    </div>
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