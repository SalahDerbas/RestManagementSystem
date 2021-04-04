@extends('layouts.casher2')

@section('content')

    <div class="container">

        <h1>Reservations:</h1>

        <br/>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>
                <th>user name</th>

                <th>date</th>


                <th>persons number</th>



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
                ajax: "{{ route('casher.reservations') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        "name": "user",
                        "data": "user",
                        "render": function (data, type, full, meta) {
                            data  = data == null ? 'Casher':data.name;
                            return data;
                        },
                        "title": "user name",
                        "orderable": true,
                        "searchable": true
                    },

                    {data: 'date', name: 'date'},
                    {data: 'number', name: 'number'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
        function update(id) {
            window.location.href = '/casher/reservation/'+id+'/edit';
        }

        function order(id) {
            window.location.href = 'reservation/'+id+'/order';
        }

        function orders(id) {
            window.location.href = 'reservation/'+id+'/orders';
        }

        function del(id) {

            $.ajax({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },
                type:'POST',

                url:'{{ route("casher.delete.reservation") }}',

                data:{id:id},

                success:function(data){
                    $('.data-table').DataTable().ajax.reload();
                    alert("deleted");

                }

            });
        }
    </script>


@endsection
