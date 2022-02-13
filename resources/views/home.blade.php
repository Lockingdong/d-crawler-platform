@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-2">
                <a href="/">回首頁</a>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">網頁爬蟲紀錄</div>

                    <div class="card-body" style="overflow: scroll;">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 120px;" scope="col">Screenshot</th>
                                    <th style="width: 120px;" scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($crawlerRecords as $record)
                                <tr>
                                    <th scope="row">
                                        <img style="width: 100%;" src="{{ $record->screenshot }}" alt="">
                                    </th>
                                    <td>
                                        <a style="width: 120px;display: block;" href="{{ route('home.showCrawlerRecord', $record->id) }}">{{ $record->title }}</a>
                                    </td>
                                    <td>
                                        <div style="width: 150px;">
                                            {{ $record->description }}
                                        </div>
                                    </td>
                                    <td>{{ $record->created_at }}</td>
                                    <td>
                                        <form onSubmit="if(!confirm('確定要刪除嗎?')){return false;}" method="POST" action="{{ route('home.deleteCrawlerRecord', $record->id) }}">
                                            @csrf
                                            {{-- @method('delete')    --}}
                                            <button type="submit" class="btn btn-sm btn-danger"><b>X</b></button>                             
                                        </form>
                                    </td>
                                </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                        {{ $crawlerRecords->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
