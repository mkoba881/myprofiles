@extends('layouts.admin')
@section('profile_name', '登録済みニュースの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>プロフィール一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.profiles.add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.profiles.index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">プロフィール</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">プロフィール名</th>
                                <th width="40%">自己紹介</th>
                                <th width="40%">経歴</th>
                                <th width="40%">実績</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $profiles)
                                <tr>
                                    <th>{{ $profiles->id }}</th>
                                    <td>{{ Str::limit($profiles->profile_name, 100) }}</td>
                                    <td>{{ Str::limit($profiles->introduction, 250) }}</td>
                                    <td>{{ Str::limit($profiles->career, 100) }}</td>
                                    <td>{{ Str::limit($profiles->achievement, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.profiles.edit', ['id' => $profiles->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.profiles.delete', ['id' => $profiles->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection