@extends('layouts.admin2')

@section('content')

    <div class="container">

        <h1>Cashers:</h1>

        <br/>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>

                <th>name</th>

                <th>email</th>

                <th>salary</th>


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
                ajax: "{{ route('admin.cashers') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'salary', name: 'salary'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
        function update(id) {
            window.location.href = 'casher/'+id+'/edit';
        }
        function del(id) {

            $.ajax({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },
                type:'POST',

                url:'{{ route("admin.delete.casher") }}',

                data:{id:id},

                success:function(data){
                    $('.data-table').DataTable().ajax.reload();
                    alert("deleted");

                }

            });
        }
    </script>


@endsection
