@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-2">
                <a href="{{ route('home') }}">回爬蟲紀錄</a>
            </div>
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-header">網頁爬蟲紀錄 - {{ $crawlerRecord->title }}</div>

                    <div class="card-body" style="overflow: scroll;">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-striped">
                            
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        Screenshot
                                    </th>
                                    <td>
                                        <img style="width: 500px" src="{{ $crawlerRecord->screenshot }}" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Title
                                    </th>
                                    <td>
                                        <a href="{{ $crawlerRecord->url }}" target="_blank">{{ $crawlerRecord->title }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Description
                                    </th>
                                    <td>
                                        {{ $crawlerRecord->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Body
                                    </th>
                                    <td>
                                        {{ $crawlerRecord->body }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Created At
                                    </th>
                                    <td>
                                        {{ $crawlerRecord->created_at }}
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
