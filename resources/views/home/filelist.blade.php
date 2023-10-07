<div class="mt-5 box ps-3 pe-3">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Time</th>
                <th>File</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $value->created_at }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>