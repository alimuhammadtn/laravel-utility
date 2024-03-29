@extends('inc.main')
@section('content')  
<div class="row m-0">
        <div class="col-sm-12">
                <div class="white-box">
                    @if(session()->has('success'))
                        <div class="alert alert-success fade in">
                        {{ session()->get('success') }}
                        </div>
                    @endif
                    <h3 class="box-title m-b-0">Users</h3>
                    <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                    <div class="table-responsive">
                        <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>SI#</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Description</th>                                    
                                    <th>Action</th>                                  
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>SI#</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Description</th>                                    
                                    <th>Action</th>       
                                </tr>
                            </tfoot>
                            <tbody>

                                @foreach ($transactions as $key => $transaction)
                                <tr>
                                <td>{{ ++$i }}</td>
                                    <td>{{ date('d-m-Y', strtotime($transaction->created_at)) }}</td>
                                    <td>{{ $transaction->title }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ $transaction->description }}</td>                                    
                                    <td>
                                        <a class="btn btn-info showBtn" data-id="{{ $transaction->id }}" >Show</a>
                                        <a class="btn btn-primary" href="{{ route('transactions.edit',$transaction->id) }}">Edit</a>

                                        <form action="{{ url('admin/transactions/'.$transaction->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $transaction->id }}" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>      
       </div>
        <div class="modal fade" id="ajaxModel" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <table class="table color-table info-table text-center">
                            <thead>
                                <tr>  
                                    <th class="text-center">SI#</th>                                 
                                    <th class="text-center">USER</th>
                                    <th class="text-center">AMOUNT</th>                                                                     
                                </tr>
                            </thead>
                            <tbody class="userTbody">

                            </tbody>                            
                        </table>                                         
                    </div>
                </div>    
            </div>
        </div>    
@endsection  
@section('scripts')
    <script>
        $(function(){
            
            $('.showBtn').on('click',function(){

                var transaction_id = $(this).data('id');  
               
                $.get("{{ route('transactions.index') }}" +'/' + transaction_id , function (data) { console.log(JSON.stringify(data)); 
                  
                    $('#modelHeading').html("Members");

                    $('#ajaxModel').modal('show'); 

                    $('.userTbody').html('');
                
                    $.each(data,function(index,value){ 

                        $(".userTbody").append('<tr><td>'+(index+1)+'</td><td>'+value.user.name+'</td><td>'+value.amount+'</td></tr>');                      

                    });               


                })

            })
        })
    </script>
@stop          
