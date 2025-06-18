<table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>City</th>
            <th>Country</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->city }}</td>
            <td>{{ $user->country }}</td>
            <td>{{ $user->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
