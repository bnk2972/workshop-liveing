<table class="table table-striped">
    <thead>
        <tr>
            <td>#</td>
            <td>NAME</td>
            <td>EMAIL</td>
            <td>CREATED AT</td>
            <td>UPDATE AT</td>
        </tr>
    </thead>
    <tbody>
        @if(isset($admins))
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->created_at }}</td>
                    <td>{{ $admin->updated_at }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">ไม่มีข้อมูล</td>
            </tr>
        @endif
        
    </tbody>
</table>