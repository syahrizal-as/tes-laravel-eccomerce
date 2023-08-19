@extends('layouts.admin', ['title' => 'Dahboard Admin'])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">

            <div class="card-datatable table-responsive text-nowrap">
                @can('users.create')
                    <div class="card-header">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle me-2"></i>
                            User</a>
                    </div>
                @endcan
                <table class="table table-bordered" id="table-users" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" style="text-align: center;width: 6%">NO.</th>
                            <th scope="col">NAMA USER</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">ROLE</th>
                            {{-- <th scope="col">CABANG</th> --}}
                            <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            $('#table-users').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! url()->current() !!}",
                columns: [{
                        "data": "id",
                        "name": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },

                    {
                        data: 'action',
                        name: 'action'
                    },

                ],
                columnDefs: [{
                        "targets": [0, 1, 2, 3], // your case first column
                        "className": "text-center",
                    }




                ]
            });
        });

        //ajax delete
        function Delete(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#4e73df',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then(function(isConfirm) {
                if (isConfirm.isConfirmed) {

                    //ajax delete
                    jQuery.ajax({
                        url: "/dashboard/user/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status == "success") {
                                Swal.fire({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 3000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {

                                    $('#table-users').DataTable().ajax.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    $('#table-users').DataTable().ajax.reload();

                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
    </script>
@endpush
