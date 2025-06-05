@extends('layouts.app')

@section('content')

    <div class="card card-success mt-4">
        <div class="card-header">
            <div class="row justify-content-between align-items-center">
                <div class="col-6">
                    <h3 class="card-title">{{__('Search')}}</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Искать</label>
                <input type="text" class="form-control" placeholder="Введите наименование" oninput="search(this.value)">
            </div>
        </div>
    </div>

    <script>
        function search(value) {
            $.ajax({
                url: "/search",
                method: 'POST',
                data: {
                    q: value,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Response:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Search error:', error);
                }
            });
        }
    </script>

@endsection
