@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> القضايا</h3>
                <h3 class="card-title float-sm-left">
                    @can('cases-create')
                    <a class="btn btn-success" href="{{ route('cases.create') }}">إضافة</a>
                    @endcan
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                @hasrole('Admin')
                <div class="col-sm-3 mt-5">
<input type="hidden" name="admin_id" value="{{Auth::user()->id}}" >
                    <button id="send_data_admin" type="button" class="btn btn-primary" data-dismiss="modal">قضايا الادمن</button>
                </div>
                @endhasrole
                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <br />
                            <label for="">الفرع </label>
                            <select class="custom-select dynamic" name="branch_id" data-dependent="users" id="branch_id">
                                <option value="">اختر </option>

              @foreach ($branches as $branch)
              <option {{old('branch_id') ==$branch->id ? 'selected' : ""}} value="{{ $branch->id }}">
                  {{ $branch->name }}</option>
          @endforeach

          </select>
                        </div>
                    </div>
                    @hasrole('Admin')
                    <div class="col-sm-3">
                        <div class="form-group">
                            <br />
                            <label for="">قضايا المكتب</label>

                            <select class="custom-select  dynamix" id="users">
                            <option value="">اختر </option>

          </select>
                        </div>
                    </div>
                    <div class="col-sm-1 mt-5 ">
                        <div class="form-check mt-1">
                            <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                              الكل
                            </label>
                        </div>
                    </div>
                    @endhasrole
                    <div class="col-sm-3 mt-5">

                        <button id="send_data" type="button" class="btn btn-primary" data-dismiss="modal">بحث</button>
                    </div>
                </div>


                <div class="card-body" id="preIndex">
                    @include('cases.preIndex')
                    {{$data->render()}}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        @endsection
        @section('scripts')
        <script>
            $(document).ready(function() {

$('.dynamic').change(function() {

    // if ($(this).val() != '') {
        var value = $(this).val();

        $.ajax({
            url: "{{route('dynamicBranch.fetch')}}",
            method: "get",
            data: {
                value: value,
            },
            success: function(result) {

                $('#users').html(result);
            }

        })
    // }
});
// end dynamic

$( '#send_data' ).click( function() {

        let branch = $('#branch_id option:selected').val();
        let user = $('#users option:selected').val();
        let all=$("input[type='checkbox']:checked").val();

     $.ajax({
                url:"{{route('dynamicCases.search')}}",

                method: "get",
                data:
	{

        branch:branch,
        user:user,
        all:all,
    },
                success: function(result) {

                    $('#preIndex').html(result);


                }
            });


   });
   $( '#send_data_admin' ).click( function() {

let user = $('#admin_id').val();

$.ajax({
        url:"{{route('dynamicCasesAdmin.searchAdmin')}}",

        method: "get",
        data:
{

user:user,
},
        success: function(result) {

            $('#preIndex').html(result);


        }
    });


});

            });
            // end ready
        </script>
        @endsection
