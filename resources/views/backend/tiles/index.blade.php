@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Tiles')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Tiles <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.tiles.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Updated at</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tiles as $tile)
                            <tr>
                                <td>{{ $tile->id }}</td>
                                <td>{{ $tile->name }}</td>
                                <td>{{ $tile->updated_at }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('admin.tiles.edit', $tile) }}"></a>
                                    <a class="btn btn-danger delete_btn" href="{{ route('admin.tiles.delete', ['tile' => $tile->id]) }}"></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
    <script>
        $(function () {
            $('.delete_btn').click(function (event) {
                event.preventDefault();
                let url = $(this).attr('href');
                console.log(url);
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function () {
                        location.reload();
                    },
                    error: function () {

                    }
                })
            })
        })
    </script>
@endpush
