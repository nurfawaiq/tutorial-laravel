@extends('main')

@section('title', 'Program')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Program</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Program</a></li>
                    <li class="active">Data</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content mt-3">

    <div class="animated fadeIn">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Data Program</strong>
                </div>
                <div class="pull-right">
                    <a href="{{ url('programs/trash') }}" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> Trash
                    </a>
                    <a href="{{ url('programs/create') }}" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i> Add
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Program</th>
                            <th>Edu Level</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programs as $key => $item)
                            <tr>
                                <td>{{ $programs->firstItem() + $key }}</td>
                                <td>{{ $item->edulevel->name }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">
                                    <a href="{{ url('programs/'.$item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ url('programs/'.$item->id.'/edit') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ url('programs/'.$item->id) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-left">
                    Showing
                    {{ $programs->firstItem() }}
                    to
                    {{ $programs->lastItem() }}
                    of
                    {{ $programs->total() }}
                    entries
                </div>
                <div class="pull-right">
                    {{ $programs->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>      

    </div>

</div>
@endsection