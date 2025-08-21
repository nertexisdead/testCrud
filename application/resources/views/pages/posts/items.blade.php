<div class="container mt-4">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title (RU)</th>
            <th>Title (UZ)</th>
            <th>Content (RU)</th>
            <th>Content (UZ)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->getTitle('ru') }}</td>
                <td>{{ $item->getTitle('uz') }}</td>
                <td>{{ $item->getContent('ru') }}</td>
                <td>{{ $item->getContent('uz') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
