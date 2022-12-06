@extends('layouts.master')
@section('content')
<style>
</style>
<div id="app">

    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="display: none;">id</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        @if(Auth::user()->role == "super_admin")
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                        <td class="user_id" style="display: none;">{{$user->id}}</td>
                        <td>{{$user->full_name}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->status == 1? "Active": "Blocked"}}</td>
                        @if(Auth::user()->role == "super_admin")
                        @if($user->status == 1)
                        <td><i title="Block User" style="font-size:25px;color:red;" class="status  fa fa-ban"></i></td>
                        @else
                        <td><i title="Active User" style="font-size:25px;color:green;" class="status fa fa-check"></i></td>
                        @endif
                        @endif
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection


@section('script')

<!-- DataTables  & Plugins -->

<script src="{{asset('theme/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('theme/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('theme/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('theme/js/responsive.bootstrap4.min.js')}}"></script>
<!-- <script src="{{asset('theme/js/')}}"></script> -->

<script>
    $(function() {
        $("#example1").DataTable();
    });
    $('.status').on('click', function() {
        var user_id = $(this).closest('tr').find('.user_id').text();

        $.ajax({
            type: "post",
            url: "{{url('/admin/update-user-status')}}",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: user_id
            },
            dataType: 'json',

            complete: function(data) {
                window.location.reload();
            }

        });
    });
</script>
@endsection