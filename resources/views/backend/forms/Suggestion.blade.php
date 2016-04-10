
@extends('backend.layouts.master')

@section('page-header')
    <h1>
        {!! app_name() !!}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('strings.backend.dashboard.welcome') }} {!! access()->user()->name !!}!</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->

        <div id="temp"></div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Area Name</th>
                        <th>Add Date</th>
                        <th>Approve Date</th>
                        <th>User Name</th>
                        <th>DisasterType</th>
                        <th>Status</th>
                        <th>User Location</th>
                        <th>Option</th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td ><div id="area"></div></td>
                            <td><div id="adddate"></div></td>
                            <td><div id="approve"></div></td>
                            <td><div id="user"></div></td>
                            <td><div id="disaster"></div></td>
                            <td><div id="status"></div></td>
                            <td><div id="location"></div></td>
                            <td><div id="btn"></div></td>
                        </tr>
                    {{--@endforeach--}}
                    </tbody>
                </table>
            </div>
    </div><!--box box-success-->


@endsection
@include('backend.includes.script')
<script>
    $(document).ready(function () {
        $.ajax({
            dataType: 'json',
            url: "../../admin/access/sugg",
            type: "GET",
            success: function (e) {
                $.each(e, function (e, t) {
                    $("#adddate").append(t.SaddDate);
                    $("#approve").append(t.SapproveDate);
                    $("#status").append(t.Sstatus);
                    $("#location").append(t.SuserLocation);
                    $("#btn").append('<a class="btn btn-default" href="../../admin/access/approve/'+t.S_id+'" role="button">Approve</a>');
                })
            },

            error: function (e) {
                console.log("error_sub_load!", e.responseJSON)
            }
        })

        $.ajax({
            dataType: 'json',
            url: "../../admin/access/area",
            type: "GET",
            success: function (e) {
                $.each(e, function (e, t) {
                    $("#area").append(t.Area_name);
                })
            },

            error: function (e) {
                console.log("error_sub_load!", e.responseJSON)
            }
        })

        $.ajax({
            dataType: 'json',
            url: "../../admin/access/disaster",
            type: "GET",
            success: function (e) {
                $.each(e, function (e, t) {
                    $("#disaster").append(t.Disaster_Name);
                })
            },

            error: function (e) {
                console.log("error_sub_load!", e.responseJSON)
            }
        })

        $.ajax({
            dataType: 'json',
            url: "../../admin/access/user",
            type: "GET",
            success: function (e) {
                $.each(e, function (e, t) {
                    $("#user").append(t.Uname);
                })
            },

            error: function (e) {
                console.log("error_sub_load!", e.responseJSON)
            }
        })
    })
</script>