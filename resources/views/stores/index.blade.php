<a href="{{ route('stores.create') }}"> Create New store</a>

<table>
   <tr>
       <th>Name</th>
       <th>category_id</th>
       <th>Picture</th>
       <th>Description</th>
       <th>Under_price</th>
       <th>Upper_price</th>
       <th>Open_time</th>
       <th>Closed_time</th>
       <th>Postal_code</th>
       <th>Address</th>
       <th>Phone</th>
       <th>Price</th>
       <th>Closed_day</th>
       <th >Action</th>
   </tr>
   @foreach ($stores as $store)
   <tr>
       <td>{{ $store->name }}</td>
       <td>{{ $store->category ->name }}</td>
       <td>{{ $store->picture }}</td>
       <td>{{ $store->description }}</td>
       <td>{{ $store->under_price }}</td>
       <td>{{ $store->upper_price }}</td>
       <td>{{ $store->open_time }}</td>
       <td>{{ $store->closed_time }}</td>
       <td>{{ $store->postal_code }}</td>
       <td>{{ $store->address }}</td>
       <td>{{ $store->phone }}</td>
       <td>{{ $store->closed_day }}</td>
       <td>


        <form action="{{ route('stores.destroy', $store->id) }}" method="POST">
           <a href="{{ route('stores.show',$store->id) }}">Show</a>
           <a href="{{ route('stores.edit',$store->id) }}">Edit</a>
           @csrf
           @method('DELETE')
           <button type="submit">Delete</button>
</form>
       </td>
   </tr>
   @endforeach
</table>