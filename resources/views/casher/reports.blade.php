@extends('layouts.casher2')

@section('content')

    <div class="container">

        <h1>Reports:</h1>

        <br/>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>
                <th>income</th>
                <th>Food outcome </th>
                <th>Drink outcome</th>
                <th>Other outcome</th>
                <th>days </th>
                <th>notes</th>




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
                ajax: "{{ route('casher.reports')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'income', name: 'income'},
                    {data: 'outcome', name: 'outcome'},
                    {data: 'store_outcome', name: 'store_outcome'},
                    {data: 'out_store_outcome', name: 'out_store_outcome'},
                    {data: 'days_off', name: 'days_off'},
                    {data: 'content', name: 'content'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
        function update(id) {
            window.location.href = '/casher/report/'+id+'/edit';
        }



        function del(id) {

            $.ajax({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },
                type:'POST',

                url:'{{ route("casher.delete.report") }}',

                data:{id:id},

                success:function(data){
                    $('.data-table').DataTable().ajax.reload();
                    alert("deleted");

                }

            });
        }
    </script>


@endsection
