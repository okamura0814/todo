@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">タスク一覧</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- 検索フォーム -->
                    <form method="get" action="{{ route('home') }}">
                        <div class="row m-3">
                            <div class="col-auto col-md-6">
                                <input class="form-control" id="keyword" type="text" name="keyword" value="{{ request()->keyword }}">
                            </div>
                            <div class="col-auto">
                                <input type="submit" value="検索" class="btn btn-primary">
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-auto form-check m-1">
                                <input class="form-check-input" type="checkbox" id="expired" name="expired" value="1" {{ !empty(request()->expired)?'checked':''; }}>
                                <label class="form-check-label" for="expired">期限超過のみ</label>
                            </div>
                            <div class="col-auto form-check m-1">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ !empty(request()->status)?'checked':''; }}>
                                <label class="form-check-label" for="status">完了済を表示</label>
                            </div>
                            <div class="col-auto" style="margin-left:auto;">
                                <a href="{{ route('todo.create') }}" class="btn btn-primary m-2">＋タスク追加</a>
                            </div>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <th>ユーザID</th>
                            <th>タスク</th>
                            <th>期日</th>
                        </thead>
                        <tbody>
                            @foreach ($todos as $todo)
                                <tr class="todo_tr" data-href="{{ route('todo.edit',$todo->id) }}">
                                    <td>{{$todo->user->nickname}}</td>
                                    <td>{{$todo->title}}</td>
                                    <td>{{empty($todo->due_date) ? '-':$todo->due_date->format('Y/m/d')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $todos->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
	tr.todo_tr:hover {
		background: aliceblue;
        cursor: pointer;
	}
</style>
<script>
    $('tr[data-href]').click(function () {
        window.location = $(this).data('href');
    });
</script>
@endsection