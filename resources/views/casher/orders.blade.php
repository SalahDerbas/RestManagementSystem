@extends('layouts.casher2')

@section('content')

    <div class="container">

        <h1>Orders:</h1>

        <br/>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>
                <th>reservation id</th>
                <th>meal</th>
                <th>casher id</th>
                <th>quantity</th>
                <th>tot_price</th>



                <th width="100px">Action</th>

            </tr>

            </thead>

            <tbody>

            </tbody>

            <tfoot>
            <tr>
                <th colspan="5"></th>
                <th colspan="">Total</th>
                <th id="total_order" >{{ $total }}</th>


            </tr>
            </tfoot>

        </table>

    </div>

    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('casher.orders',$reservation) }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'reservation_id', name: 'reservation_id'},
                    {
                        "name": "meal",
                        "data": "meal",
                        "render": function (data, type, full, meta) {
                            data  = data == null ? 'deleted':data.name;
                            return data;
                        },
                        "title": "meal",
                        "orderable": true,
                        "searchable": true
                    },
                    {data: 'casher_id', name: 'casher_id'},

                    {data: 'quantity', name: 'quantity'},
                    {data: 'tot_price', name: 'tot_price'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
        function update(id) {
            window.location.href = '/casher/order/'+id+'/edit';
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

                url:'{{ route("casher.delete.order") }}',

                data:{id:id},

                success:function(data){
                    $('.data-table').DataTable().ajax.reload();
                    alert("deleted");

                }

            });
        }
    </script>


@endsection
