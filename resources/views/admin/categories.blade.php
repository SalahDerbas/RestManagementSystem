@extends('layouts.admin2')

@section('content')

    <div class="container">

        <h1>Categories:</h1>

        <br/>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>

                <th>image</th>

                <th>name</th>

                <th width="100px">Action</th>

            </tr>

            </thead>

            <tbody>

            </tbody>

        </table>

    </div>

    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.categories') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        "name": "image",
                        "data": "image",
                        "render": function (data, type, full, meta) {
                            return "<img src=\"/storage/" + data + "\" height=\"60\" />";
                        },
                        "title": "Image",
                        "orderable": true,
                        "searchable": true
                    },
                    {data: 'name', name: 'name'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
        function update(id) {
            window.location.href = 'category/'+id+'/edit';
        }
        function del(id) {

            $.ajax({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },
                type:'POST',

                url:'{{ route("admin.delete.category") }}',

                data:{id:id},

                success:function(data){
                    $('.data-table').DataTable().ajax.reload();
                    alert("deleted");

                }

            });
        }
    </script>


@endsection
