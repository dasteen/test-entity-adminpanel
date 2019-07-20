@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">Tiles</div>
                <div class="card-body">
                    <div class="row" id="tiles_container">
                        <script type="text/template" id="tile_container">
                            <div class="col-md-4">
                                <div class="tile">
                                    {!tile_name!}
                                </div>
                            </div>
                        </script>
                    </div>
                    <a href="#" class="btn btn-primary" id="show_more_btn">Показать еще</a>
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection

@push('after-styles')
    <style>
        .tile {
            padding: 10px;
            margin: 20px;
            background: yellowgreen;
            height: 100px;
        }
    </style>
@endpush

@push('after-scripts')
    <script>
        $(function () {
            let page = 1;

            let getTiles = function(page) {
                $.ajax({
                    url: '{{ route('frontend.tiles.index') }}',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        page: page,
                    },
                    success: function (response) {
                        let html = '';
                        let tile_container = '';
                        $.each(response.data.tiles.data, function (index, value) {
                            tile_container = $('#tile_container').html();
                            tile_container = tile_container.replace(new RegExp('{!tile_name!}', 'g'), value.name);
                            $('#tiles_container').append(tile_container);

                            if(page < response.data.tiles.last_page) {
                                $('#show_more_btn').removeClass('disabled');
                            }
                        });
                    },
                    errors: function () {

                    }
                });
            }

            $('#show_more_btn').click(function () {
                $(this).addClass('disabled');
                getTiles(page);
                page++;
            });

            $('#show_more_btn').click();
        });
    </script>
@endpush
