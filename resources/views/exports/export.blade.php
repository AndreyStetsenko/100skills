<table>
  <thead>
  <tr>
      <th>Name</th>
      <th>Email</th>
  </tr>
  </thead>
  <tbody>
  @foreach($users as $item)
      <tr>
          <td>{{ $item->name }}</td>
          <td>{{ $item->email }}</td>
      </tr>
  @endforeach
  </tbody>
</table>