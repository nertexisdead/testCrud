@extends('layouts.app')

@section('content')

    <div class="card card-success mt-4">
        <div class="card-header">
            <div class="row justify-content-between align-items-center">
                <div class="col-6">
                    <h3 class="card-title">{{ __('Search') }}</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Искать</label>
                <input type="text" class="form-control" placeholder="Введите наименование" oninput="search(this.value)">
            </div>

            <!-- Спиннер -->
            <div id="spinner" class="text-center my-4 d-none">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Загрузка...</span>
                </div>
            </div>

            <!-- Контейнер для результатов -->
            <div id="search-results" class="mt-4"></div>
        </div>
    </div>

    <script>
        function search(value) {
            $('#spinner').removeClass('d-none'); // Показать спиннер
            $.ajax({
                url: "/search",
                method: 'POST',
                data: {
                    q: value,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#spinner').addClass('d-none'); // Скрыть спиннер
                    if (response.success) {
                        $('#search-results').html(response.view);
                    }
                },
                error: function (xhr, status, error) {
                    $('#spinner').addClass('d-none'); // Скрыть спиннер
                    console.error('Search error:', error);
                }
            });
        }
    </script>

@endsection
